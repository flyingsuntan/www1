 <?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/11
 * Time: 14:38
 */
class AdminController extends PlatformController {
    function LoginAction(){
        include VIEW_PATH . 'Login.html';
    }
    /*
     * 生成验证码
     * */
    public function CaptchaAction(){
        //通过验证码的工具类,完成即可！

        $t_captcha = ModelFactory::M('Captcha');
        $t_captcha->makeImage();
    }
    function CheckLoginAction(){
        //验证码是否正确
        $t_captcha = ModelFactory::M('AdminModel');
        //$t_captcha->checkCode($_POST['captcha']);
        if(!$t_captcha->checkCode($_POST['captcha'])){
            //不正确，跳转到登录页面，提示
            $this->GotoUrl("验证码不正确",'?p=back&c=Admin&a=Login',2);
            //停止脚本执行
            die();
        }

        //echo "检测用户名和密码";
        //接收登录表单的2个数据项：
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $model = ModelFactory::M('AdminModel');
        //下面方法，返回的是true或false，表示是否合法
        //$result = $model->CheckAdmin($user,$pass);
        //下面的方法，当管理员合法时，返回管理员所有信息
        //当管理员信息非法时，返回false
        $result = $model -> CheckAdminInfo($user,$pass);
        //直接判断即可，非空数组，可以自动转换为布尔型ture
        if($result){
            //管理员合法

            //echo "登录成功";
            //分配登录标识
            //cookie
            //setcookie('is_login','yes',time()+600);

            //session

            session_start();

            $_SESSION['admin_info'] = $result;
            //设置登录状态
            if(isset($_POST['remember'])){
                //需要记录,通常是在原始数据上，添加混淆字符串，在加密
                setcookie('admin_id',md5($result['id'] . 'SALT'),PHP_INT_MAX);
                setcookie('admin_pass',md5($result['admin_pass'] . 'SALT'),PHP_INT_MAX);
            }

            //跳转到后台首页
            header("Location:index.php?p=back&c=Manage&a=Index");
        }
        else {
            $this->GotoUrl("登录失败",'?p=back&c=Admin&a=Login',2);
        }
    }

}