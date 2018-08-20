<?php
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model
{
    protected $insertFields = array('cat_name', 'parent_id','is_floor');
    protected $updateFields = array('id','cat_name', 'parent_id','is_floor');
    protected $_validate = array(
        array('cat_name', 'require', '分类名称不能为空！', 1, 'regex', 3),
    );
    //找一个分类所有子分类的ID
    public function getChildren($cat_id){
        //取出所有的分类
        $data = $this->select();
        //递归从所有的分类中跳出分类的ID
        return $this->_getChildren($data,$cat_id,true);
    }
    //递归从数据中找子分类
    private function _getChildren($data,$cat_id,$isClear = false){
        static $res = array();
        if($isClear){
            $res = array();
        }
        //循环所有的分类找子分类
        foreach ($data as $k => $v){
            if($v['parent_id'] == $cat_id){
                $res[] = $v['id'];
                //在找这个$v的子分类
                $this->_getChildren($data,$v['id']);
            }
        }
        return $res;
    }
    public function getTree(){
        //取出所有的分类
        $data = $this->select();
        return $this-> _getTree($data);

    }
    public function _getTree($data,$parent_id=0,$level=0){
        static $res = array();
        foreach ($data as $k => $v){
            if($v['parent_id'] == $parent_id){
                $v['level'] = $level;
                $res[] = $v;
                $this->_getTree($data,$v['id'],$level+1);
            }
        }
        return $res;
    }
    public function _before_insert()
    {
         $cats = $this->getTree();

    }
    public function _before_delete(&$option){
        $children = $this->getChildren($option['where']['id']);
        $children[] = $option['where']['id'];
        $option['where']['id'] = array(
            0 => 'IN',
            1 => implode(',',$children),
        );





        /*
        //删除这些子分类
        if($ids) {
            $children = implode(',',$ids);
            //删除这些子分类
            //说明这里必须生成父类模型然后调用delete函数。因为如果使用$this
            //调用delete那么在delete之前优惠调用$this->_before_delete这样就死循环了
            //。用了父类的delete就会在delete之前调用父类的_before_delete和这个_before_delete没关系。就不会死循环了！！！！！
            $model = \Think\Model();
            $model->table('__CATEGORY__')->delete($children);

        }
        */
    }
    //获取导航条的数据
    public function getNavData(){
        $catData = S('catData');
        if($catData){
            return $catData;
        }else {
            //取出所有的分类
            $all = $this->select();
            //循环所有的分类找出顶级分类
            $ret = array();
            foreach ($all as $k => $v) {
                if ($v['parent_id'] == 0) {
                    //循环所有的分类找出这个顶级分类的子分类
                    foreach ($all as $k1 => $v1) {
                        if ($v1['parent_id'] == $v['id']) {
                            //循环所有的分类找出这个二级分类的子分类
                            foreach ($all as $k2 => $v2) {
                                if ($v2['parent_id'] == $v1['id']) {
                                    $v1['children'][] = $v2;
                                }
                            }
                            $v['children'][] = $v1;
                        }
                    }
                    $ret[] = $v;
                }
            }
            S('catData',$ret,86400);
            return $ret;
        }
    }

    //获取首页楼层中的数据
    public function floorData(){
        $floorData = S('floorData');
        /**********先取出推荐到楼层的顶级分类**********/
        if(!$floorData) {
            $ret = $this->where(array(
                'parent_id' => array('eq', 0),
                'is_floor' => array('eq', 'yes')
            ))->select();
            $goodsModel = D('Admin/goods');
            /*************循环每个楼层取出楼层中的数据*************/
            foreach ($ret as $k => $v) {
                /*******这个楼层中的品牌数据************/
                //思路：先去出这个楼层下所有的商品ID
                $goodsId = $goodsModel->getGoodsIdByCatId($v['id']);
                //再取出这些商品所用到的品牌
                $ret[$k]['brand'] = $goodsModel->alias('a')
                    ->field('DISTINCT brand_id,b.brand_name,b.logo')
                    ->join('left join __BRAND__ b on a.brand_id=b.id')
                    ->where(array(
                        'a.id' => array('in', $goodsId),
                        'a.brand_id' => array('neq', 0),
                    ))->limit(9)->select();

                /****取出未推荐的二级分类并保存到这个顶级分类的children字段中**/
                $ret[$k]['children'] = $this->where(array(
                    'parent_id' => array('eq', $v['id']),
                    'is_floor' => array('eq', 'no')
                ))->select();

                /*****取出推荐的二级分类并保存到这个顶级分类的children字段中****/
                $ret[$k]['recchildren'] = $this->where(array(
                    'parent_id' => array('eq', $v['id']),
                    'is_floor' => array('eq', 'yes')
                ))->select();
                /**********循环每个推荐的二级分类取出分类下的8件被推荐到楼层的商品*******/
                foreach ($ret[$k]['recchildren'] as $k1 => $v1) {
                    //取出这个分类下所有的商品的ID并返回一维数组
                    $gids = $goodsModel->getGoodsIdByCatId($v['id']);
                    //再根据商品ID取出商品的详细信息
                    $ret[$k]['recchildren'][k1]['goods'] = $goodsModel->field('id,mid_logo,goods_name,shop_price')->where(array(
                        'is_on_sale' => array('eq', 'yes'),
                        'is_floor' => array('eq', 'yes'),
                        'id' => array('in', $gids),
                    ))->order('sort_num ASC')->limit(8)->select();

                }
            }
            S('floorData',$ret,86400);
            return $ret;
        }else{
            return $floorData;
        }
    }
    /*
     * 取出一个分类所有上级分类
     */
    public function parentPath($catId){
        static $ret = array();
        $info = $this->field('id,cat_name,parent_id')->find($catId);
        $ret[] = $info;
        if($info['parent_id'] > 0)
            $this->parentPath($info['parent_id']);
        return $ret;
    }
    //根据当前搜索出来的商品计算筛选条件
    public function getSearchConditionByGoodsId($goodsId){
        $ret = array();
        $goodsModel = D('Admin/goods');
        //取出这个分类下所有商品的ID
        //$goodsId = $goodsModel->getGoodsIdByCatId($catId);
        /********************品牌*********************/

        //再取出这些商品所用到的品牌
        $ret['brand'] = $goodsModel->alias('a')
        ->field('DISTINCT brand_id,b.brand_name,b.logo')
        ->join('left join __BRAND__ b on a.brand_id=b.id')
        ->where(array(
                'a.id' => array('in', $goodsId),
                'a.brand_id' => array('neq', 0),
        ))->select();
        /****************价格区间********************/
        $sectionCount = 1; //默认分6段
        //取出这个分类下最大和最小的价格
        $priceInfo = $goodsModel->field('MAX(shop_price) max_price,MIN(shop_price) min_price')
            ->where(array(
                'id' => array('in', $goodsId),
        ))->select();
        //最大价和最小价的区间
        $priceSection = $priceInfo[0]['max_price'] - $priceInfo[0]['min_price'];
        //分类下商品的数量
        $goodsCount = count($goodsId);
        //只有商品数量有这些时价格才分段
        if($goodsCount > 5){
            //根据最大价和最小价的差值计算分几段
            if($priceSection < 100){
                $sectionCount = 1;
            }else if($priceSection < 1000){
                $sectionCount = 4;
            }else if($priceSection < 10000){
                $sectionCount = 6;
            }else{
                $sectionCount = 7;
            }
            //根据段数分段
            $pricePerSection = ceil($priceSection /$sectionCount); //每段的范围
            $price = array(); //存放最终的分段数据
            $firstPrice = $priceInfo[0]['min_price'];//段中第一个价格
            //循环放每个段
            for($i=0;$i<$sectionCount;$i++){
                $price[] = $firstPrice.'-'.($firstPrice+$pricePerSection) ;
                //计算下一个的第一个是几
                $firstPrice = $firstPrice+$pricePerSection+1;
            }
            //放到返回的数组中
            $ret['price'] = $price;
        }

        /*******************商品属性*******************/
        $gaModel = D('goods_attr');
        $gaData = $gaModel->alias('a')
        ->field('DISTINCT a.attr_id,a.attr_value,b.attr_name')
        ->join('LEFT JOIN __ATTRIBUTE__ b on a.attr_id=b.id')
        ->where(array(
            'a.goods_id' => array('in',$goodsId),
            'a.attr_value' => array('neq',''),
        ))->select();
        //处理这个属性数组：把相同属性的放到一起用属性名称作为下标->2维转3维
        $_gaData = array();
        foreach ($gaData as $k => $v){
            $_gaData[$v['attr_name']][] = $v;
        }
        //放到返回数组中
        $ret['gaData'] = $_gaData;
        //返回数组
        return $ret;
    }
}
