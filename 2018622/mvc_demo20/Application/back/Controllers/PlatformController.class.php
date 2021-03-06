<?php

/**
 * 后台back的平台控制器
 */
class PlatformController extends BaseController {

    public function __construct() {
        // 强制调用父类被重写的构造方法
        parent::__construct();
        // 校验是否登录
        $this->_check();
    }

    /**
     * 校验是否登陆
     */
    protected function _check() {
        // 开启session

        session_start();

        // 判断当前请求是否是特例，是否需要校验
        // 获得当前的控制器，和当前的动作
        $curr_controller = strtolower(CONTROLLER);// 当前控制器
        $curr_action = strtolower(ACTION);// 当前动作
        // 条件, 当前的控制器为admin，并且 动作为loign或checklogin
        if ($curr_controller=='admin' && ($curr_action=='login'|| $curr_action=='checklogin' || $curr_action=='captcha')) {
            // 不需要校验，函数内后续代码不需要执行
            return ;
        }
        // 校验：判断是否具有登录标识, session
        if (!isset($_SESSION['admin_info'])) {
            //不存在session中的登录标识
            //判断cookie中，是否记录的登录状态
            $m_admin = ModelFactory::M(AdminModel);

            if(isset($_COOKIE['admin_id']) && isset($_COOKIE['admin_pass']) && $admin_info = $m_admin->CheckCookieInfo($_COOKIE['admin_id'],$_COOKIE['admin_pass']))
            {
                //具有登录状态,设置session中的登录标识
                $_SESSION['admin_info'] = $admin_info;
            }else{
                //没有记录登录状态
                //没有标识，跳转到登录页面
                header('Location: index.php?p=back&c=Admin&a=Login');
                die();
            }
        }
    }
}