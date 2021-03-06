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
        //下面方法，返回的是true或false，表示是否合法
        //$result = $model->CheckAdmin($user,$pass);
        //下面的方法，当管理员合法时，返回管理员所有信息
        //当管理员信息非法时，返回false
        $result = $model -> CheckAdminInfo($user,$pass);
        //直接判断即可，非空数组，可以自动转换为布尔型ture
        if($result){
            //echo "登录成功";
            //分配登录表示
            //cookie
            //setcookie('is_login','yes',time()+600);

            //session
            session_start();
            $_SESSION['admin_info'] = $result;
            //跳转到后台首页
            header("Location:index.php?p=back&c=Manage&a=Index");
        }
        else {
            $this->GotoUrl("登录失败",'?p=back&c=Admin&a=Login',2);
        }
    }
}