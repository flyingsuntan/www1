<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/11
 * Time: 14:48
 */
class AdminModel extends BaseModel {
    function CheckAdmin($user,$pass){
        $sql = "select count(*) as c from admin_user where admin_name ='$user' and admin_pass=md5('$pass')" ;
        $date = $this->_dao->GetOneData($sql);
        if($date == 1){
            $sql = "update admin_user set login_times = login_times+1,last_login_time=now()";
            $sql .="where admin_name ='$user' and admin_pass=md5('$pass')";
            $this->_dao->exec($sql);
            return true;
        }else{
            return false;
        }
    }
}