<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 16:01
 */
//这里演示自定义的自动加载函数的使用：
spl_autoload_register("aotuoload1");//声明“aotuoload1”作为自动加载函数
spl_autoload_register("aotuoload2");//声明“aotuoload2”作为自动加载函数
function aotuoload1($name){//这个自动加载函数，用于加载class目录中的类文件
    //echo "<br />准备在aotuoload1加载这个类" .$name;
    $file = './class/' . $name . ".class.php";
    if(file_exists($file)){
        include_once $file;
    }
}
function aotuoload2($name){//这个自动加载函数，用于加载lib目录中的类文件
    //echo "<br />准备在aotuoload2加载这个类" .$name;
    $file = './lib/' . $name . ".class.php";
    if(file_exists($file)){
    include_once $file;
    }
}

$a1 = new A();//这个类在class目录下；
echo "<br />";
var_dump($a1);
$b1 = new B(); //这个类在lib 目录下；
echo "<br />";
var_dump($b1);