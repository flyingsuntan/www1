<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/11
 * Time: 14:38
 */
class AdminController extends BaseController {
    function LoginAction(){
        include VIEW_PATH . 'Login.html';
    }
    function CheckLoginAction(){
        //echo "检测用户名和密码";
        //接收登录表单的2个数据项：
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $model = ModelFactory::M('AdminModel');
        $result = $model->CheckAdmin($user,$pass);
        if($result === true){
            echo "登录成功";
        }
        else {
            $this->GotoUrl("登录失败",'?p=back&c=Admin&a=Login',2);
        }
    }
}