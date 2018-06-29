<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/27
 * Time: 17:32
 */
//后台登录控制器
class LoginController extends Controller{
    //显示登录页面
    public function loginAction(){
        //载入登录页面视图
        include CUR_VIEW_PATH . "login.html";
    }
    //验证用户名密码
    public function signinAction(){
        //1.获取用户名和密码
         $username = trim($_POST['username']);
         $this->heloer('input');
         $username = deepaddslashes($username);
         $password = md5(trim($_POST['password']));
         //对用户名和密码进行转义
        //函数addslashes
         //接收验证码
        $code = trim($_POST['captcha']);
        //先检查验证码，注意将二者大小写转成一致
        if(strtolower($_SESSION['captcha']) != strtolower($code)){
            $this->jump('index.php?p=admin&c=Login&a=login','验证码错误',3);
        }

        //2.验证和处理
        if($username == ''){
            $this->jump('index.php?p=admin&c=Login&a=signin','用户名不能为空',3);
        }
        //3.调用模型来完成验证操作并给出提示
        $adminModel = new AdminModel('admin');
        $user = $adminModel->checkUser($username,$password);
        if($user){
            //登录成功
            $_SESSION['admin'] = $user;
            $this->jump('index.php?p=admin&c=index&a=index','',0);
        }else{
            //失败
            $this->jump('index.php?p=admin&c=Login&a=login','用户名或密码错误',3);
        }
    }
    //注销
    public function logoutAction(){
        //删除session中的变量
        unset($_SESSION['admin']);
        //销毁session
        session_destroy();
        //跳转
        $this->jump('index.php?p=admin&c=Login&a=login','',0);
    }
    //生成验证码
    public function captchaAction(){
        //引入验证码类
        $this->libaray('Captcha');
        //实例化对象
        $captcha = new Captcha();
        //生成验证码
        $captcha->generateCode();
        //将验证码保存到session中
        $_SESSION['captcha'] = $captcha->getCode();
    }
}