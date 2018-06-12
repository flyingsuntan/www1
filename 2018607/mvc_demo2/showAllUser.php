<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 10:59
 */
require 'UserModel.class.php';
//实例化模型类，并从中获取2份数据
$obj_user = new UserModel();
$date1 = $obj_user->GetAllUser();
$date2 = $obj_user->GetUserCount();

//载入视图文件以显示该2份数据
include 'showAllUser_view.html';