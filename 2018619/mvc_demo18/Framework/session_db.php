<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/16
 * Time: 14:36
 */
//读操作需要的函数
//@param string $sess_id 当前会话的session_ID
//@return string 当前session数据区内容


session_set_save_handler('sessionBegin','sessionEnd','sessionRead','sessionWrite','sessionDelete','sessionGC');
ini_set('session.save_handler','user');

function sessionRead($sess_id){
    //echo "<br />Read<br />";
    //执行读select操作
    $sql = "select sess_content from session where sess_id = '$sess_id'";
    //echo $sql. "<br />";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    if($row){
        return $row['sess_content'];

    }else{
        return '';
    }

}
//写操作需要的函数
//@param string $sess_id session_ID
//@return string $sess_content 处理好（序列化）的session数据
//@return boll 写入结果
function sessionWrite($sess_id,$sess_content){
    //echo "<br />Write<br />";
    //执行写操作
    //利用sess_id判断是否已经存在该记录，存在update,不存在则insert
    //replace into :如果主键存在，则替换，否则插入。语法与inssert相同
    $sql = "replace into session (sess_id,sess_content,last_write) values ('$sess_id','$sess_content',unix_timestamp())";
    //echo $sql;
    return mysql_query($sql);
}
function sessionDelete($sess_id){
    //echo "<br />Delete<br />";
    //删除操作
    $sql = "delete from session where sess_id = '$sess_id'";
    return mysql_query($sql);
}
//垃圾回收，有几率执行
//@param  int $maxlifetime  最大有效期
//@return
function sessionGC($maxlifetime){

    //echo "<br />GC<br />";
    $sql = "delete from session where last_write < unix_timestamp() - $maxlifetime ";
    return mysql_query($sql);
}
function sessionBegin(){
    //echo "<br />Begin<br />";
    //连接数据库服务器
    mysql_connect('127.0.0.1','root','');
    mysql_query("set names utf8");
    mysql_query("use ceshi");
}
function sessionEnd(){
    //echo "<br />End<br />";
    return true;
}

