<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/1
 * Time: 13:52
 */
//首页控制器
class IndexController extends Controller{
    //index方法
    public function indexAction(){
        //获取所有的商品分类
        $categoryModel = new CategoryModel('category');
        $cats = $categoryModel->frontCats();
        //获取推荐商品
        $goodsModel = new GoodsModel('goods');
        $bestGoods = $goodsModel->getBestGoods();
        //var_dump($bestGoods);
        //die;
        //载入视图
        include CUR_VIEW_PATH ."index.html";
    }

}