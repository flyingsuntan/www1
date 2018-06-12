<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 15:26
 */
class A{
    function f1 (){
        echo "<br />__DIR__:" . __DIR__;
        echo "<br />__FILE__:" . __FILE__;
        echo "<br />__LINE__:" . __LINE__;
        echo "<br />__CLASS__:" . __CLASS__;
        echo "<br />__METHOD__:" . __METHOD__;
        echo "<br />__LINE__:" . __LINE__;

    }
}
$obj1 = new A();
$obj1->f1();