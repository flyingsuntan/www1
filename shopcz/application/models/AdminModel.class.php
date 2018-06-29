<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/26
 * Time: 10:55
 */
//后台管理员模型
class AdminModel extends Model{
    //获取所有的管理员
    public function getAdmins(){
        $sql = "select * from {$this->table}";
        return $this->db->getAll($sql);
    }
    //验证用户名和密码
    public function checkUser($username,$password){
        $sql = "select *from {$this->table} where admin_name = '$username' and password = '$password' limit 1";

        return $this->db->getRow($sql);

        }
    }
