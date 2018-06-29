<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/25
 * Time: 16:13
 */
//后台首页控制器
class IndexController extends BaseController {
    //生成验证码
    public function codeAction(){
        $this->libaray('Captcha');
        $c = new Captcha();
        $c->generateCode();
    }
    public function indexAction(){
       // echo "admin...index...";
        include CUR_VIEW_PATH ."index.html";
    }
    public function topAction(){
        include CUR_VIEW_PATH . "top.html";
    }
    public function mainAction(){

        //实例化模型
        $adminModel = new AdminModel('admin');
        $admins = $adminModel->getAdmins();
        echo "<pre />";
        var_dump($admins);
        include CUR_VIEW_PATH . "main.html";
    }
    public function menuAction(){
        include CUR_VIEW_PATH . "menu.html";
    }
    public function dragAction(){
    include CUR_VIEW_PATH . "drag.html";
}
}