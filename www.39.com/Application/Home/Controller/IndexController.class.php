<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends NavController {
    public function index(){
        //$this->show('<style type="__PUBLIC__/home/text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');

        //取出疯狂抢购的商品
        $goodsModel = D('Admin/goods');
        $goods1 = $goodsModel->getPromoteGoods();
        $newgoods = $goodsModel->getRecGoods('is_new');
        $hotgoods = $goodsModel->getRecGoods('is_hot');
        $bestgoods = $goodsModel->getRecGoods('is_best');

        //取出首页楼层的数据
        $catModel = D('Admin/category');
        $floorData = $catModel->floorData();
//var_dump($floorData);die();
        //var_dump($newgoods);
        //var_dump($bestgoods);die;
        //var_dump($goods1);die;
        $this->assign(array(
            'goods1' => $goods1,
            'hotgoods' => $hotgoods,
            'newgoods' => $newgoods,
            'bestgoods' => $bestgoods,
            'floorData' => $floorData,

        ));

        //设置页面信息
        $this->assign(array(
            '_page_title' => '首页',
            '_show_nav' => 1,
            '_page_keywords' => '首页',
            '_page_description' => '首页',
        ));
        $this->display();
    }
    /*****************商品详情页********************/
    public function goods(){
        //接收商品的ID
        $id = I('get.id');
        //根据ID取出商品的详细信息
        $goodsModel = D('goods');
        $info = $goodsModel->find($id);
        //在根据主分类ID找出这个分类的所有上级分类
        $catModel = D('Admin/category');
        $catPath = $catModel->parentPath($info['cat_id']);
        //取出商品的相册
        $gpModel = D('goods_pic');
        $gpData = $gpModel->where(array(
            'goods_id' => array('eq',$id),
        ))->select();
        //var_dump($gpData);die;
        //取出这件商品的所有属性值
        $gaModel = D('goods_attr');
        $gaData = $gaModel->alias('a')
            ->field('a.*,b.attr_name,b.attr_type')
            ->join('left join __ATTRIBUTE__ b on a.attr_id=b.id')
            ->where (array(
                'a.goods_id' => array('eq',$id)
            ))->select();
        //整理所有的商品，把唯一的和可选的属性分开存放
        $uniArr = array();  //唯一
        $mulArr = array();  //可选
        foreach ($gaData as $k => $v){
            if($v['attr_type'] == 0)
                //把同意个属性放到一起
                $uniArr[$v['attr_name']][] = $v;
            if($v['attr_type'] == 1)
                $mulArr[$v['attr_name']][] = $v;
        }
        //取出这件商品所有的会员价格
        $mpModel = D('member_price');
        $mpData = $mpModel->alias('a')
            ->field('a.price,b.level_name')
            ->join('left join __MEMBER_LEVEL__ b on a.level_id=b.id')
            ->where (array(
                'a.goods_id' => array('eq',$id)
            ))->select();
        //var_dump($mpData);die;
        //var_dump($mulArr);
        $viewPath = C('IMAGE_CONFIG');
        //var_dump($viewPath);die;
        $this->assign(array(
            'mpData' => $mpData,
            'gpData' => $gpData,
            'uniArr' => $uniArr,
            'mulArr' => $mulArr,
            'info' => $info,
            'catPath' => $catPath,
            'viewPath' => $viewPath
        ));

        //设置页面信息
        $this->assign(array(
           '_page_title' => '商品详情页',
            '_show_nav' => 0,
            '_page_keywords' => '商品详情页',
            '_page_description' => '商品详情页',

        ));
        $this->display();
    }
    // 处理浏览历史
    public function displayHistory()
    {
        $id = I('get.id');
        // 先从COOKIE中取出浏览历史的ID数组
        $data = isset($_COOKIE['display_history']) ? unserialize($_COOKIE['display_history']) : array();
        // 把最新浏览的这件商品放到数组中的第一个位置上
        array_unshift($data, $id);
        // 去重
        $data =	array_unique($data);
        // 只取数组中前6个
        if(count($data) > 6)
            $data = array_slice($data, 0, 6);
        // 数组存回COOKIE
        setcookie('display_history', serialize($data), time() + 30 * 86400, '/');
        // 再根据商品的ID取出商品的详细信息
        $goodsModel = D('goods');
        $data = implode(',', $data);
        $gData = $goodsModel->field('id,mid_logo,goods_name')->where(array(
            'id' => array('in', $data),
            'is_on_sale' => array('eq', 'yes'),
        ))//->order("FIELD(id,$data)")
            ->select();

        echo json_encode($gData);
    }
    /************************************/
    public function ajaxGetMemberPrice(){
        $goodsId = I('get.goods_id');
        $gModel = D('Admin/Goods');
        echo $gModel->getMemberPrice($goodsId);
    }
}