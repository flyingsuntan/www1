<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model 
{
	// 添加时调用create方法允许接收的字段
	protected $insertFields = 'goods_name,market_price,shop_price,is_on_sale,goods_desc,brand_id,cat_id,type_id,promote_price,promote_start_date,promote_end_date,is_hot,is_best,is_new,sort_num,is_floor';
	// 修改时调用create方法允许接收的字段
	protected $updateFields = 'id,goods_name,market_price,shop_price,is_on_sale,goods_desc,brand_id,cat_id,type_id,promote_price,promote_start_date,promote_end_date,is_hot,is_best,is_new,sort_num,is_floor';
	//定义验证规则
	protected $_validate = array(
        array('cat_id', 'require', '分类不能为空！', 1),
		array('goods_name', 'require', '商品名称不能为空！', 1),
		array('market_price', 'currency', '市场价格必须是货币类型！', 1),
		array('shop_price', 'currency', '本店价格必须是货币类型！', 1),
	);
	
	// 这个方法在添加之前会自动被调用 --》 钩子方法
	// 第一个参数：表单中即将要插入到数据库中的数据->数组
	// &按引用传递：函数内部要修改函数外部传进来的变量必须按钮引用传递，除非传递的是一个对象,因为对象默认是按引用传递的
	protected function _before_insert(&$data, $option)
	{
		/**************** 处理LOGO *******************/
		// 判断有没有选择图片
		if($_FILES['logo']['error'] == 0)
		{
			$ret = uploadOne('logo', 'Goods', array(
				array(700, 700),
				array(350, 350),
				array(130, 130),
				array(50, 50),
			));
			$data['logo'] = $ret['images'][0];
			$data['mbig_logo'] = $ret['images'][1];
			$data['big_logo'] = $ret['images'][2];
			$data['mid_logo'] = $ret['images'][3];
			$data['sm_logo'] = $ret['images'][4];
		}
		// 获取当前时间并添加到表单中这样就会插入到数据库中
		$data['addtime'] = date('Y-m-d H:i:s', time());
		// 我们自己来过滤这个字段
		$data['goods_desc'] = removeXSS($_POST['goods_desc']);
	}
	
	protected function _before_update(&$data, $option)
	{
        $id = $option['where']['id'];  // 要修改的商品的ID
	    //标记商品修改了，需要重新创建索引
	    $data['is_updated'] = 1;
	    //设置sphinx中的这条记录is_updated属性为1
        require ('./sphinxapi.php');
        $sph = new \sphinxClient();
        $sph->SetServer('127.0.0.1',9312);
        $sph->UpdateAttributes('goods',array('is_updated'),array($id => array(1)) );


        /*****************修改商品属性****************/
        $gaId = I('post.goods_attr_id');
        $attrValue = I('post.attr_value');
        $gaModel = D('goods_attr');
        $_i = 0; //循环次数
        foreach ($attrValue as $k => $v){
            foreach ($v as $k1 => $v1) {
                //if(empty($v1))
                    //continue;
               // echo 'REPLACE INTO p39_goods_attr VALUES ("'.$gaId['$_i'].'","'.$v1.'","'.$k.'","'.$id.'")';die;
                //$gaModel->execute('REPLACE INTO p39_goods_attr VALUES ("'.$gaId[$_i].'","'.$v1.'","'.$k.'","'.$id.'")');

                //照这个属性值是否有ID

                if($gaId[$_i] == '') {

                    if($v1 == '')
                        continue;
                    $gaModel->add(array(
                        'goods_id'=> $id,
                        'attr_id' => $k,
                        'attr_value' => $v1
                    ));
                }else{
                    $gaModel->where(array(
                        'id' => array('eq',$gaId[$_i]),
                    ))->setField('attr_value',$v1);
                }
                $_i++;

            }
        }
        /****************更新商品扩展分类表**************/
        //var_dump($_POST);die;
        $cat_id = I('post.ext_cat_id');
        $goods_cat_Model = D('goods_cat');
        $goods_cat_Model->where(array(
            'goods_id' => $id,
        ))->delete();
        if($cat_id) {
            foreach ($cat_id as $k => $v) {
                if(empty($v))
                    continue;
                $goods_cat_Model->add(
                    array(
                        'cat_id' => $v,
                        'goods_id' => $id,
                    )
                );
            }
        }
		/**************** 处理LOGO *******************/
		// 判断有没有选择图片
		if($_FILES['logo']['error'] == 0)
		{
			$ret = uploadOne('logo', 'Goods', array(
				array(700, 700),
				array(350, 350),
				array(130, 130),
				array(50, 50),
			));
			$data['logo'] = $ret['images'][0];
			$data['mbig_logo'] = $ret['images'][1];
			$data['big_logo'] = $ret['images'][2];
			$data['mid_logo'] = $ret['images'][3];
			$data['sm_logo'] = $ret['images'][4];
			/*************** 删除原来的图片 *******************/
		    	// 先查询出原来图片的路径
			$oldLogo = $this->field('logo,mbig_logo,big_logo,mid_logo,sm_logo')->find($id);
			deleteImage($oldLogo);
		}
        /************ 处理相册图片 *****************/
        if(isset($_FILES['pic']))
        {
            $pics = array();
            foreach ($_FILES['pic']['name'] as $k => $v)
            {
                $pics[] = array(
                    'name' => $v,
                    'type' => $_FILES['pic']['type'][$k],
                    'tmp_name' => $_FILES['pic']['tmp_name'][$k],
                    'error' => $_FILES['pic']['error'][$k],
                    'size' => $_FILES['pic']['size'][$k],
                );
            }
            $_FILES = $pics;  // 把处理好的数组赋给$_FILES，因为uploadOne函数是到$_FILES中找图片
            $gpModel = D('goods_pic');
            // 循环每个上传
            foreach ($pics as $k => $v)
            {
                if($v['error'] == 0)
                {
                    $ret = uploadOne($k, 'Goods', array(
                        array(650, 650),
                        array(350, 350),
                        array(50, 50),
                    ));
                    if($ret['ok'] == 1)
                    {
                        $gpModel->add(array(
                            'pic' => $ret['images'][0],
                            'big_pic' => $ret['images'][1],
                            'mid_pic' => $ret['images'][2],
                            'sm_pic' => $ret['images'][3],
                            'goods_id' => $id,
                        ));
                    }
                }
            }
        }
        /************ 处理会员价格 ****************/
        $mp = I('post.member_price');
        $mpModel = D('member_price');
        // 先删除原来的会员价格
        $mpModel->where(array(
            'goods_id' => array('eq', $id),
        ))->delete();
        foreach ($mp as $k => $v)
        {
            $_v = (float)$v;
            // 如果设置了会员价格就插入到表中
            if($_v > 0)
            {
                $mpModel->add(array(
                    'price' => $_v,
                    'level_id' => $k,
                    'goods_id' => $id,
                ));
            }
        }

        // 我们自己来过滤这个字段
		$data['goods_desc'] = removeXSS($_POST['goods_desc']);
	}
	
	protected function _before_delete($option)
	{
		$id = $option['where']['id'];   // 要删除的商品的ID
        /**************先删商品库存量**********************/
        $gnModel = D('goods_number');
        $gnModel->where(array(
            'goods_id' => array('eq',$id)
        ))->delete();
		/*************** 删除原来的图片 *******************/
		// 先查询出原来图片的路径
		$oldLogo = $this->field('logo,mbig_logo,big_logo,mid_logo,sm_logo')->find($id);
		deleteImage($oldLogo);
		/***************删除会员价格*************************/
		$mpModel = d('member_price');
		$mpModel->where(array(
		    'goods_id' =>array( 'eq',$id)
        ))->delete();
        /***************删除扩展分类*********************/
        $gcModel = d('goods_cat');
        $gcModel->where(array(
            'goods_id' =>array( 'eq',$id)
        ))->delete();
        /***************删除商品属性*********************/
        $gcModel = d('goods_attr');
        $gcModel->where(array(
            'goods_id' =>array( 'eq',$id)
        ))->delete();
	}
	
	/**
	 * 实现翻页、搜索、排序
	 *
	 */
	public function search($perPage = 5)
	{
		/*************** 搜索 ******************/
		$where = array();  // 空的where条件
		// 商品名称
		$gn = I('get.gn');
		if($gn)
			$where['goods_name'] = array('like', "%$gn%");  // WHERE goods_name LIKE '%$gn%'
		// 价格
		$fp = I('get.fp');
		$tp = I('get.tp');
		if($fp && $tp)
			$where['shop_price'] = array('between', array($fp, $tp)); // WHERE shop_price BETWEEN $fp AND $tp
		elseif ($fp)
			$where['shop_price'] = array('egt', $fp);   // WHERE shop_price >= $fp
		elseif ($tp)
			$where['shop_price'] = array('elt', $tp);   // WHERE shop_price <= $fp
        //商品品牌
        $brand_id = I('get.brand_id');
        if($brand_id)
            $where['a.brand_id'] = array('eq',$brand_id);
        //商品主分类
        $cat_id = I('get.cid');
        if($cat_id){
            $gids = $this->getGoodsIdByCatId($cat_id);
            $where['a.id'] = array('in',$gids);
        }
		// 是否上架
		$ios = I('get.ios');
		if($ios)
			$where['is_on_sale'] = array('eq', $ios);  // WHERE is_on_sale = $ios
		// 添加时间
		$fa = I('get.fa');
		$ta = I('get.ta');
		if($fa && $ta)
			$where['addtime'] = array('between', array($fa, $ta)); // WHERE shop_price BETWEEN $fp AND $tp
		elseif ($fa)
			$where['addtime'] = array('egt', $fa);   // WHERE shop_price >= $fp
		elseif ($ta)
			$where['addtime'] = array('elt', $ta);   // WHERE shop_price <= $fp
		
		
		/*************** 翻页 ****************/
		// 取出总的记录数
		$count = $this->where($where)->count();
		// 生成翻页类的对象
		$pageObj = new \Think\Page($count, $perPage);
		// 设置样式
		$pageObj->setConfig('next', '下一页');
		$pageObj->setConfig('prev', '上一页');
		// 生成页面下面显示的上一页、下一页的字符串
		$pageString = $pageObj->show();
		
		/***************** 排序 *****************/
		$orderby = 'a.id';      // 默认的排序字段
		$orderway = 'desc';   // 默认的排序方式
		$odby = I('get.odby');
		if($odby)
		{
			if($odby == 'id_asc')
				$orderway = 'asc';
			elseif ($odby == 'price_desc')
				$orderby = 'shop_price';
			elseif ($odby == 'price_asc')
			{
				$orderby = 'shop_price';
				$orderway = 'asc';
			}
		}
		
		/************** 取某一页的数据 ***************/
		/*
		 * select a.*,b.brand_name from p39_goods a left join p39_brand b on a.brand_id = b.id
		 */
		$data = $this->order("$orderby $orderway")// 排序
        ->field('a.*,b.brand_name,c.cat_name,GROUP_CONCAT(e.cat_name SEPARATOR "<br/>") ext_cat_name')
        ->alias('a')
        ->join('LEFT JOIN __BRAND__ b ON a.brand_id=b.id 
                LEFT JOIN __CATEGORY__ c ON a.cat_id=c.id 
                LEFT JOIN __GOODS_CAT__ d ON a.id=d.goods_id
                LEFT JOIN __CATEGORY__ e ON d.cat_id=e.id'
        )
		->where($where)                                               // 搜索
		->limit($pageObj->firstRow.','.$pageObj->listRows)            // 翻页
        ->group('a.id')
		->select();
		
		/************** 返回数据 ******************/
		return array(
			'data' => $data,  // 数据
			'page' => $pageString,  // 翻页字符串
		);
	}
	//商品插入之后
	public function _after_insert($data,$option){
	    /********************处理商品属性*********************/
	    $attrValue = I('post.attr_value');
	    $goods_attr_Model = D('goods_attr');
	    if($attrValue) {
            foreach ($attrValue as $k => $v) {
                //把属性值的数组去重
                $v = array_unique($v);
                foreach ($v as $k1 => $v1) {
                    if(empty($v1))
                        continue;
                    $goods_attr_Model->add(
                        array(
                            'goods_id' => $data['id'],
                            'attr_id' => $k,
                            'attr_value'=> $v1,
                        )
                    );
                }
            }
        }
	    /*************处理会员价*******************/
	    $mp = I('post.member_price');
        $mpModel = D('member_price');
        static $i=0;
	    foreach ($mp as $k => $v){
            $mpModel->add(array(
                    'price' => $v,
                    'level_id' => $k,
                    'goods_id' => $data['id'],
            ));
            //echo $i++;

        }
        /************处理扩展分类*****************/
        $cat_id = I('post.ext_cat_id');
	    $goods_cat_Model = D('goods_cat');
	    if($cat_id) {
            foreach ($cat_id as $k => $v) {
                if(empty($v))
                    continue;
                $goods_cat_Model->add(
                    array(
                        'cat_id' => $v,
                        'goods_id' => $data['id'],
                    )
                );
            }
        }
        /************ 处理相册图片 *****************/
        if(isset($_FILES['pic']))
        {
            $pics = array();
            foreach ($_FILES['pic']['name'] as $k => $v)
            {
                $pics[] = array(
                    'name' => $v,
                    'type' => $_FILES['pic']['type'][$k],
                    'tmp_name' => $_FILES['pic']['tmp_name'][$k],
                    'error' => $_FILES['pic']['error'][$k],
                    'size' => $_FILES['pic']['size'][$k],
                );
            }
            $_FILES = $pics;  // 把处理好的数组赋给$_FILES，因为uploadOne函数是到$_FILES中找图片
            $gpModel = D('goods_pic');
            // 循环每个上传
            foreach ($pics as $k => $v)
            {
                if($v['error'] == 0)
                {
                    $ret = uploadOne($k, 'Goods', array(
                        array(650, 650),
                        array(350, 350),
                        array(50, 50),
                    ));
                    if($ret['ok'] == 1)
                    {
                        $gpModel->add(array(
                            'pic' => $ret['images'][0],
                            'big_pic' => $ret['images'][1],
                            'mid_pic' => $ret['images'][2],
                            'sm_pic' => $ret['images'][3],
                            'goods_id' => $data['id'],
                        ));
                    }
                }
            }
        }


    }
    /****************取出一个分类下所有商品的ID*********************/
    public function getGoodsIdByCatId($cat_id){
        //先去出所有子分类的ID
        $catsModel = D('Admin/category');
        $children = $catsModel->getChildren($cat_id);
        $children[] = $cat_id;
        /**********************取出主分类或者扩展分类在这些分类中的商品**********************/
        //取出主分类下的商品ID
        if(
        empty($gids = $this->field('id') -> where(array(
            'cat_id' => array('in',$children),
        ))->select())){

             $gids = array();
        }
       // var_dump($gids);
        //这些扩展分类下的商品的ID
        $gcModel = D('goods_cat');
        if(empty(
        $gids1 = $gcModel->field('DISTINCT goods_id id')->where(array(
            'cat_id' =>array(
                'IN',$children
            )
        ))->select())){
            $gids1 = array();
        }
        //var_dump($gids1);
        //把主分类的ID和扩展分类的商品ID合并成一个二维数组
         $gids= array_merge($gids,$gids1);
         //var_dump($gids);die;
         //二维转一维
        $id =array();
        foreach ($gids as $k => $v){
            if(!in_array($v['id'],$id)){
                $id[] = $v['id'];
            }
        }
        //var_dump($id);die;
        return $id;

    }
    //取出当前正在促销的商品
    public function getPromoteGoods($limit = 5){
        //获取当前的时间
        $today = date('Y-m-d H:i:s');
        return $this->field('id,goods_name,mid_logo,promote_price')
        ->where(array(
            'is_on_sale' => array('eq','yes'),
            'promote_price' => array('gt',0),
            'promote_start_date' => array('elt',$today),
            'promote_end_date' => array('egt',$today),

        ))
        ->order('sort_num ASC')
        ->limit($limit)
        ->select();
    }
    //取出三种推荐的商品
    public function getRecGoods($recType,$limit = 5){
        //获取当前的时间
        $today = date('Y-m-d H:i:s');
        return $this->field('id,goods_name,mid_logo,shop_price')
            ->where(array(
                'is_on_sale' => array('eq','yes'),
                "$recType" => array('eq','yes'),
            ))
            ->order('sort_num ASC')
            ->limit($limit)
            ->select();
    }
    public function getMemberPrice($goodsId){
        /***********获取当前会员的级别ID****************/
        $today = date('Y-m-d H:i:s');
        $levelId = session('level_id');
        //取出商品的促销价格
        $promotePrice = $this->field('promote_price')
        ->where(array(
            'promote_price' => array('gt',0),
            'promote_start_date' => array('elt',$today),
            'promote_end_date' => array('egt',$today),
         ))->find($goodsId);
//echo $promotePrice['promote_price'];
        //判断会员有没有登录
        if($levelId) {
            $mpModel = D('member_price');
            $mpData = $mpModel->field('price')->where(array(
                'goods_id' => array('eq', $goodsId),
                'level_id' => array('eq', $levelId)
            ))->find();
            //echo $mpData['price'];die;
            //这个级别有没有会员价格
            if($mpData['price']) {
                if($promotePrice['promote_price']) {
                    return min($promotePrice['promote_price'], $mpData['price']);
                }else {
                    return $mpData['price'];
                }
            }
            else {
                $p = $this->field('shop_price')
                    ->find($goodsId);
                if($promotePrice['promote_price']) {
                    return min($promotePrice['promote_price'], $p['shop_price']);
                }else {
                    return $p['shop_price'];
                }
            }
        }else {
            $p = $this->field('shop_price')
                ->find($goodsId);
            if($promotePrice['promote_price']) {
                return min($promotePrice['promote_price'], $p['shop_price']);
            }else {
                return $p['shop_price'];
            }
        }
    }
    public function cat_search($catId,$perPage = 60){
        /**********************搜索*********************/
        //根据分类ID搜索出这个分类下的商品ID
        $goodsId = $this->getGoodsIdByCatId($catId);
        $where['a.id'] = array('in',$goodsId);
        //品牌
        $brandId = I('get.brand_id');
        if($brandId){
            $where['a.brand_id'] = array('eq',(int)$brandId);   //3-小米
        }
        //价格
        $price = I('get.price');
        if($price){
            $price = explode('-',$price);
            $where['a.shop_price'] = array('between',$price);
        }
        /******************************************* 商品搜索开始 ************************************************/
        $gaModel = D('goods_attr');
        $attrGoodsId = NULL;  // 根据每个属性搜索出来的商品的ID
        // 根据属性搜索 : 循环所有的参数找出属性的参数进行查询
        foreach ($_GET as $k => $v)
        {
            // 如果变量是以attr_开头的说明是一个属性的查询, 格式：attr_1/黑色-颜色
            if(strpos($k, 'attr_') === 0)
            {
                // 先解析出属性ID和属性值
                $attrId = str_replace('attr_', '', $k); // 属性id
                // 先取出最后一个-往后的字符串
                $attrName = strrchr($v, '-');
                $attrValue = str_replace($attrName, '', $v);
                // 根据属性ID和属性值搜索出这个属性值下的商品id：并返回一个字符串格式：1,2,3,4,5,6,7
                $gids = $gaModel->field('GROUP_CONCAT(goods_id) gids')->where(array(
                    'attr_id' => array('eq', $attrId),
                    'attr_value' => array('eq', $attrValue),
                ))->find();
                // 判断是有商品
                if($gids['gids'])
                {
                    $gids['gids'] = explode(',', $gids['gids']);
                    // 说明是搜索的第一个属性
                    if($attrGoodsId === NULL)
                        $attrGoodsId = $gids['gids'];  // 先暂存起来
                    else
                    {
                        // 和上一个属性搜索出来的结果求集
                        $attrGoodsId = array_intersect($attrGoodsId, $gids['gids']);
                        // 如果已经没有商品满足条件就不用再考虑下一个属性了
                        if(empty($attrGoodsId))
                        {
                            $where['a.id'] = array('eq', 0);
                            break;
                        }
                    }
                }
                else
                {
                    // 前几次的交集结果清空
                    $attrGoodsId = array();
                    // 如果这个属性下没有商品就应该向where中添加一个不可能满足的条件，这样后面取商品时就取不出来了！
                    $where['a.id'] = array('eq', 0);
                    // 取出循环，不用再查询下一个属性了
                    break;
                }
            }
        }
        // 判断如果循环求次之后这个数组还不为空说明这些就是满足所有条件的商品id
        if($attrGoodsId)
            $where['a.id'] = array('IN', $attrGoodsId);
        /******************************************* 商品搜索结束 ************************************************/


        /*********************翻页*****************/
        //取出总的记录数，以及所有的商品ID的字符串
        $count = $this->alias('a')->field('COUNT(a.id) goods_count,GROUP_CONCAT(a.id) goods_id ')->where($where)->find();
        //把商品ID返回
        $data['goods_id'] = explode(',',$count['goods_id']);
        // 生成翻页类的对象
        $pageObj = new \Think\Page($count['goods_count'], $perPage);
        // 设置样式
        $pageObj->setConfig('next', '下一页');
        $pageObj->setConfig('prev', '上一页');
        // 生成页面下面显示的上一页、下一页的字符串
        $data['page'] = $pageObj->show();

        /********************排序*******************/
        $oderby = 'xl';
        $oderway = 'desc';
        $odby = I('get.odby');
        if($odby){
            if($odby =='addtime'){
                $oderby = 'a.addtime';
            }
            if( strpos($odby,'price_')===0){
                $oderby = 'a.shop_price';
                if($odby == 'price_asc'){
                    $oderway = 'asc';
                }
            }


        }
        /******************取数据********************/
        $data['data'] = $this->alias('a')
            ->field('a.id,a.goods_name,a.mid_logo,a.shop_price,SUM(b.goods_number) xl')
            ->join('LEFT JOIN __ORDER_GOODS__ b 
				 ON (a.id=b.goods_id 
				      AND 
				     b.order_id IN(SELECT id FROM __ORDER__ WHERE pay_status="yes"))')
            ->where($where)
            ->group('a.id')
            ->limit($pageObj->firstRow.','.$pageObj->listRows)
            ->order("$oderby $oderway")
            ->select();

        return $data;
    }

//获取某个关键字下的某一页的商品
    public function key_search($key,$perPage = 60){
        /**********************搜索*********************/
        //根据关键字【商品名称、商品描述、商品属性】取出商品ID
        $goodsId = $this->alias('a')
        ->field('GROUP_CONCAT(a.id) gids,GROUP_CONCAT(b.attr_value) attr_value')
            ->join('LEFT JOIN __GOODS_ATTR__ b on a.id=b.goods_id')
            ->where(array(
            'is_on_sale' => array('eq','yes'),
            'goods_name' => array('exp',"LIKE '%$key%' OR goods_desc LIKE '%$key%' OR attr_value LIKE '%$key%'"),
        ))
            ->find();
        $goodsId = explode(',',$goodsId['gids']);

        $where['a.id'] = array('in',$goodsId);
        //品牌
        $brandId = I('get.brand_id');
        if($brandId){
            $where['a.brand_id'] = array('eq',(int)$brandId);   //3-小米
        }
        //价格
        $price = I('get.price');
        if($price){
            $price = explode('-',$price);
            $where['a.shop_price'] = array('between',$price);
        }
        /******************************************* 商品搜索开始 ************************************************/
        $gaModel = D('goods_attr');
        $attrGoodsId = NULL;  // 根据每个属性搜索出来的商品的ID
        // 根据属性搜索 : 循环所有的参数找出属性的参数进行查询
        foreach ($_GET as $k => $v)
        {
            // 如果变量是以attr_开头的说明是一个属性的查询, 格式：attr_1/黑色-颜色
            if(strpos($k, 'attr_') === 0)
            {
                // 先解析出属性ID和属性值
                $attrId = str_replace('attr_', '', $k); // 属性id
                // 先取出最后一个-往后的字符串
                $attrName = strrchr($v, '-');
                $attrValue = str_replace($attrName, '', $v);
                // 根据属性ID和属性值搜索出这个属性值下的商品id：并返回一个字符串格式：1,2,3,4,5,6,7
                $gids = $gaModel->field('GROUP_CONCAT(goods_id) gids')->where(array(
                    'attr_id' => array('eq', $attrId),
                    'attr_value' => array('eq', $attrValue),
                ))->find();
                // 判断是有商品
                if($gids['gids'])
                {
                    $gids['gids'] = explode(',', $gids['gids']);
                    // 说明是搜索的第一个属性
                    if($attrGoodsId === NULL)
                        $attrGoodsId = $gids['gids'];  // 先暂存起来
                    else
                    {
                        // 和上一个属性搜索出来的结果求集
                        $attrGoodsId = array_intersect($attrGoodsId, $gids['gids']);
                        // 如果已经没有商品满足条件就不用再考虑下一个属性了
                        if(empty($attrGoodsId))
                        {
                            $where['a.id'] = array('eq', 0);
                            break;
                        }
                    }
                }
                else
                {
                    // 前几次的交集结果清空
                    $attrGoodsId = array();
                    // 如果这个属性下没有商品就应该向where中添加一个不可能满足的条件，这样后面取商品时就取不出来了！
                    $where['a.id'] = array('eq', 0);
                    // 取出循环，不用再查询下一个属性了
                    break;
                }
            }
        }
        // 判断如果循环求次之后这个数组还不为空说明这些就是满足所有条件的商品id
        if($attrGoodsId)
            $where['a.id'] = array('IN', $attrGoodsId);
        /******************************************* 商品搜索结束 ************************************************/


        /*********************翻页*****************/
        //取出总的记录数，以及所有的商品ID的字符串
        $count = $this->alias('a')->field('COUNT(a.id) goods_count,GROUP_CONCAT(a.id) goods_id ')->where($where)->find();
        //把商品ID返回
        $data['goods_id'] = explode(',',$count['goods_id']);
        // 生成翻页类的对象
        $pageObj = new \Think\Page($count['goods_count'], $perPage);
        // 设置样式
        $pageObj->setConfig('next', '下一页');
        $pageObj->setConfig('prev', '上一页');
        // 生成页面下面显示的上一页、下一页的字符串
        $data['page'] = $pageObj->show();

        /********************排序*******************/
        $oderby = 'xl';
        $oderway = 'desc';
        $odby = I('get.odby');
        if($odby){
            if($odby =='addtime'){
                $oderby = 'a.addtime';
            }
            if( strpos($odby,'price_')===0){
                $oderby = 'a.shop_price';
                if($odby == 'price_asc'){
                    $oderway = 'asc';
                }
            }


        }
        /******************取数据********************/
        $data['data'] = $this->alias('a')
            ->field('a.id,a.goods_name,a.mid_logo,a.shop_price,SUM(b.goods_number) xl')
            ->join('LEFT JOIN __ORDER_GOODS__ b 
				 ON (a.id=b.goods_id 
				      AND 
				     b.order_id IN(SELECT id FROM __ORDER__ WHERE pay_status="yes"))')
            ->where($where)
            ->group('a.id')
            ->limit($pageObj->firstRow.','.$pageObj->listRows)
            ->order("$oderby $oderway")
            ->select();

        return $data;
    }
}












