
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
        echo "������ݳɹ�";
        echo "<a href='?'>����</a>";
    }

    function DelAction()
    {
        $id = $_GET['id'];
        $obj = ModelFactory::M('UserModel');
        $result = $obj->delUserById($id);
        echo "ɾ���ɹ�";
        echo "<a href='?'>����</a>";
    }

    function IndexAction()
    {
        $obj_user = ModelFactory::M('UserModel');
        $date1 = $obj_user->GetAllUser();
        $date2 = $obj_user->GetUserCount();

//������ͼ�ļ�����ʾ��2������
        include 'showAllUser_view.html';
    }
    function EditAction(){
        $id = $_GET['id'];
        $obj = ModelFactory::M('UserModel');
        $date = $obj->GetUserInfoById($id);
        $aihao = explode(",",$date['Interest']);//���ｫ�����ַ������ݡ�������������
                                                          //ʹ��ָ�����ַ�������ȥ�ָ�Ϊһ������

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
        echo "�޸����ݳɹ�";
        echo "<a href='?'>����</a>";
    }
}
$ctr1 = new UserController();
$act = !empty($_GET['a']) ? $_GET['a'] : "Index";
$action = $act."Action";
$ctr1->$action();
//����3�У�������һ������if�ж��߼�
/*
if(!empty($_GET['act']) && $_GET['act']=='detail'){
    DetailAction();
    //ɾ���û�
}else if(!empty($_GET['act']) && $_GET['act']=='del'){
    DelAction();
}
//�������ҳ��
else if(!empty($_GET['act']) && $_GET['act']=='fromAdd'){
    ShowFormAction();
}
//����û�
elseif(!empty($_GET['act']) && $_GET['act']=='AddUser'){
    AddUserAction();
}
else{
//$obj_user = new UserModel();
    IndexAction();
}
*/