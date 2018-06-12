<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 10:47
 */
require 'BaseModel.class.php';
//require 'MySQLDB.class.php';
class UserModel extends BaseModel {

    function GetAllUser(){
       /* $config = array(
            db_host => '127.0.0.1',
            db_port => '3306',
            db_user =>'root',
            db_pwd => '',
            bm => 'utf8',
            databas => 'ceshi'
        );*/
        $sql = "select * from yonghubiao";
       // $db = MySQLDB::GetInstance($config);
        $date = $this->_dao->GetRows($sql);
        return $date;

    }
    function GetUserCount(){
       /* $config = array(
            db_host => '127.0.0.1',
            db_port => '3306',
            db_user =>'root',
            db_pwd => '',
            bm => 'gb2312',
            databas => 'ceshi'
        );*/
        $sql = "select count(*) from yonghubiao";
        //$db = MySQLDB::GetInstance($config);
        $date = $this->_dao->GetOneData($sql);
        return $date;
    }
    function delUserById($id){
        $sql = "delete from yonghubiao where id = $id";
        $date = $this->_dao->exec($sql);
        return $date;
    }
    function GetUserInfoById($id){
        $sql = "select * from yonghubiao where id = $id";
        $date = $this->_dao->GetOneRow($sql);
        return $date;
    }
    function AddUserAction($user ,$pwd,$age,$Education,$Interest,$fr){
        $sql = "insert into yonghubiao(username ,pwd,age,Education,Interest,fr,addate) values ('$user','$pwd','$age','$Education','$Interest','$fr',now())";
        $date = $this->_dao->exec($sql);
        return $date;
    }
}
//$obj1 = new UserModel();

