<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/16
 * Time: 14:43
 */
include 'session_db.php';
//使用session
session_start();
$_SESSION['new_key'] = 'new_value';


//创建表结构
//create table session(
//    sess_id varchar(40) not null,
//    sess_content text,
//    primary key (sess_id)
//)engine=myisam charset=utf8;