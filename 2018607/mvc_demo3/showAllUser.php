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

//ʵ����ģ���࣬�����л�ȡ2������
//ʵ����ģ���࣬�����л�ȡ2������
//�û���ϸ��Ϣ
if(!empty($_GET['act']) && $_GET['act']=='detail'){
    $id = $_GET['id'];
    $obj =  ModelFactory::M('UserModel');
    $date =  $obj->GetUserInfoById($id);
    include 'userInfo.html';
    //ɾ���û�
}else if(!empty($_GET['act']) && $_GET['act']=='del'){

    $id = $_GET['id'];
    $obj = ModelFactory::M('UserModel');
    $result =  $obj->delUserById($id);
    echo "ɾ���ɹ�";
    echo "<a href='?'>����</a>";
}
//�������ҳ��
else if(!empty($_GET['act']) && $_GET['act']=='fromAdd'){
    include "addUser.html";
}
//����û�
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
    echo "������ݳɹ�";
    echo "<a href='?'>����</a>";
}
else{
//$obj_user = new UserModel();
    $obj_user = ModelFactory::M('UserModel');
    $date1 = $obj_user->GetAllUser();
    $date2 = $obj_user->GetUserCount();

//������ͼ�ļ�����ʾ��2������
include 'showAllUser_view.html';
}