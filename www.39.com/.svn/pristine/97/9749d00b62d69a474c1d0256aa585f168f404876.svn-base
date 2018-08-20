<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17
 * Time: 14:28
 */
namespace Home\Controller;
use Think\Controller;
class NavController extends Controller{
    public function __construct()
    {
        //必须先调用父类的构造函数
        parent::__construct();
        $catModel = D('Admin/category');
        $catData = $catModel->getNavData();
        $this->assign('catData',$catData);
    }
}