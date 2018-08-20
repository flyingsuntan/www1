<?php
namespace Home\Controller;
use Think\Controller;
class SearchController extends NavController {
    //分类搜索
    public function cat_search(){
        //取出商品和翻页
        $goodsModel = D('Admin/Goods');
        $data = $goodsModel->cat_search(I('get.cat_id'),5);

        //根据上面搜索出来的商品计算筛选条件
        $catModel = D('Admin/category');
        $searchFilter = $catModel->getSearchConditionByGoodsId($data['goods_id']);
        $this->assign(array(
            'page' => $data['page'],
            'data' => $data['data'],
            'searchFilter' => $searchFilter,
            '_page_title' => '分类搜索页',
            '_show_nav' => 0,
            '_page_keywords' => '分类搜索页',
            '_page_description' => '分类搜索页',
        ));
        $this->display();
    }
//关键字搜索
    public function key_search()
    {
        //搜索关键字
        $key = I('get.key');
        //搜索sphinx
        require('./sphinxapi.php');
        $sph = new \SphinxClient();
        $sph->SetServer('127.0.0.1',9312);
        //过滤掉被标记为修改的
        $sph->SetFilter('is_updated',array(0));
        //第一个参数：要查询的关键字
        //第二个参数：sphinx中索引的名字 默认是* 所有的索引
        $ret = $sph->Query($key,'goods');

        //提取出商品的ID
        $ids = array_keys($ret['matches']);
        $gModel = D('Admin/Goods');
        $ret = $gModel->field('id,goods_name')->where(array(
            'id' => array('in',$ids)
            ))->select();
        var_dump($ret);
        //取出商品和翻页
        $goodsModel = D('Admin/Goods');
        $data = $goodsModel->key_search($key);

        //根据上面搜索出来的商品计算筛选条件
        $catModel = D('Admin/category');
        $searchFilter = $catModel->getSearchConditionByGoodsId($data['goods_id']);
        $this->assign(array(
            'page' => $data['page'],
            'data' => $data['data'],
            'searchFilter' => $searchFilter,
            '_page_title' => '关键字搜索页',
            '_show_nav' => 0,
            '_page_keywords' => '关键字搜索页',
            '_page_description' => '关键字搜索页',
        ));
        $this->display();
    }



}