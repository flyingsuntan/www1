<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 15:48
 */
function __autoload($name){
    require_once './class/' . $name . ".class.php";
}
$obj1 = new A();
var_dump($obj1);
