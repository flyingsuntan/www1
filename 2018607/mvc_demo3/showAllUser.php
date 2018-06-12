<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
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
if(!empty($_GET['act']) && $_GET['act']=='detail'){
    $id = $_GET['id'];
    $obj =  ModelFactory::M('UserModel');
    $date =  $obj->GetUserInfoById($id);
    include 'userInfo.html';
    //删除用户
}else if(!empty($_GET['act']) && $_GET['act']=='del'){

    $id = $_GET['id'];
    $obj = ModelFactory::M('UserModel');
    $result =  $obj->delUserById($id);
    echo "删除成功";
    echo "<a href='?'>返回</a>";
}
//加载添加页面
else if(!empty($_GET['act']) && $_GET['act']=='fromAdd'){
    include "addUser.html";
}
//添加用户
elseif(!empty($_GET['act']) && $_GET['act']=='AddUser'){
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
else{
//$obj_user = new UserModel();
    $obj_user = ModelFactory::M('UserModel');
    $date1 = $obj_user->GetAllUser();
    $date2 = $obj_user->GetUserCount();

//载入视图文件以显示该2份数据
include 'showAllUser_view.html';
}