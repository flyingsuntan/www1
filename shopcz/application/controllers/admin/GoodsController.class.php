<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/29
 * Time: 15:52
 */
//后台商品控制器
class GoodsController extends BaseController {
    public function indexAction(){
        include CUR_VIEW_PATH . "goods_list.html";
    }
    public function addAction(){
        include CUR_VIEW_PATH . "goods_add.html";
    }
    public function insertAction(){}
    public function editAction(){
        include CUR_VIEW_PATH ."goods_edit.html";
    }
    public function updateAction(){}
    public function deleteAction(){}
}