
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 10:59
 */
require 'UserModel.class.php';
require 'ModelFactory.class.php';

//实例化模型类，并从中获取2份数据
//实例化模型类，并从中获取2份数据
//用户详细信息
class UserController
{
    function DetailAction()
    {
        $id = $_GET['id'];
        $obj = ModelFactory::M('UserModel');
        $date = $obj->GetUserInfoById($id);
        include 'userInfo.html';
    }

    function ShowFormAction()
    {
        include "addUser.html";
    }

    function AddUserAction()
    {
        $user = $_POST["user"];
        $pwd = $_POST["pwd"];
        $age = $_POST["age"];
        $education = $_POST["Education"];
        $aihao = $_POST["Interest"];
        $interest = array_sum($aihao);
        $fr = $_POST["fr"];
        $obj = ModelFactory::M('UserModel');
        $result = $obj->AddUserAction($user, $pwd, $age, $education, $interest, $fr);
        echo "添加数据成功";
        echo "<a href='?'>返回</a>";
    }

    function DelAction()
    {
        $id = $_GET['id'];
        $obj = ModelFactory::M('UserModel');
        $result = $obj->delUserById($id);
        echo "删除成功";
        echo "<a href='?'>返回</a>";
    }

    function IndexAction()
    {
        $obj_user = ModelFactory::M('UserModel');
        $date1 = $obj_user->GetAllUser();
        $date2 = $obj_user->GetUserCount();

//载入视图文件以显示该2份数据
        include 'showAllUser_view.html';
    }
    function EditAction(){
        $id = $_GET['id'];
        $obj = ModelFactory::M('UserModel');
        $date = $obj->GetUserInfoById($id);
        $aihao = explode(",",$date['Interest']);//这里将这种字符串数据“排球，篮球，足球”
                                                          //使用指定的字符（，）去分割为一个数组

        include "Edit.html";
    }
    function EditFormAction(){
        $id = $_POST['id'];
        $user = $_POST["user"];
        $pwd = $_POST["pwd"];
        $age = $_POST["age"];
        $education = $_POST["Education"];
        $aihao = $_POST["Interest"];
        $interest = array_sum($aihao);
        $fr = $_POST["fr"];
        $obj = ModelFactory::M('UserModel');
       // include 'Edit.html';

        $result = $obj->EditAction($user, $pwd, $age, $education, $interest, $fr,$id);
        echo "修改数据成功";
        echo "<a href='?'>返回</a>";
    }
}
$ctr1 = new UserController();
$act = !empty($_GET['a']) ? $_GET['a'] : "Index";
$action = $act."Action";
$ctr1->$action();
//以上3行，代替了一下所有if判断逻辑
/*
if(!empty($_GET['act']) && $_GET['act']=='detail'){
    DetailAction();
    //删除用户
}else if(!empty($_GET['act']) && $_GET['act']=='del'){
    DelAction();
}
//加载添加页面
else if(!empty($_GET['act']) && $_GET['act']=='fromAdd'){
    ShowFormAction();
}
//添加用户
elseif(!empty($_GET['act']) && $_GET['act']=='AddUser'){
    AddUserAction();
}
else{
//$obj_user = new UserModel();
    IndexAction();
}
*/