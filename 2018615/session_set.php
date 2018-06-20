<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/15
 * Time: 14:50
 */
//ini_set('session.cookie_lifetime','100');
//session_set_cookie_params('3600','/','','false','false');
session_start();
////添加
//$_SESSION['user'] = 'Kang';
//$_SESSION['gender'] = 'male';
////修改
//$_SESSION['gender'] = 'secret';
////删除
//unset($_SESSION['user']);
//
////获取
//var_dump($_SESSION['gender']);
//var_dump(isset($_SESSION['gender']));
$_SESSION['int'] = 42;//4个字节
$_SESSION['float'] = 42.24;//8个字节
$_SESSION['string'] = 'itcast';
$_SESSION['bool'] = 'false'; //1个字节
$_SESSION['array'] = array('name' => 'kang');
class Student{
    private $_name;
    public function __construct($n)
    {
        $this->_name = $n;
    }
}
$_SESSION['object'] = new Student('哈哈');
$_SESSION['null'] = NULL;

