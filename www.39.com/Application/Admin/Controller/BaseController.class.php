<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/15
 * Time: 17:33
 */
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller{
    public function __construct()
    {
        //必须先调用父类得构造函数
        parent::__construct();
        //判断登录
        if(!session('id'))
            $this->error('必须先登录！',U('Login/login'));
        //所有管理员都可以进入后台首页
        if(CONTROLLER_NAME == 'Index')
            return true;
        $priModel = D('privilege');
        if(!$priModel->chkPri())
            $this->error('无权访问！',U('Member/login'));
    }
}