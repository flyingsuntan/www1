<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 10:59
 */
require 'UserModel.class.php';
//ʵ����ģ���࣬�����л�ȡ2������
$obj_user = new UserModel();
$date1 = $obj_user->GetAllUser();
$date2 = $obj_user->GetUserCount();

//������ͼ�ļ�����ʾ��2������
include 'showAllUser_view.html';