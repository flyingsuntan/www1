<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/31
 * Time: 15:20
 */
class A {
    public  $p1 = "A������";
    function f1(){
        echo "<br />A�з���";
    }
}
class B extends A{
    public $p2 = "����B������";
}
$b1 = new B();
echo "<br />" .$b1->p1;
$b1->f1();