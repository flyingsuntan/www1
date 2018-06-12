<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/31
 * Time: 15:47
 */
//修饰符
class A {
    public $p1 = 1;
    protected $p2 = 2;
    private $p3 = 3;
    function ShowInfo(){
        echo "<br />this->p1=" . $this->p1;
        echo "<br />this->p2=" . $this->p2;
        echo "<br />this->p3=" . $this->p3;
    }
}
$a1 = new A();
$a1->ShowInfo();
echo "<hr />";
echo "<br />a1->p1=" . $a1->p1;
//echo "<br />a1->p2=" . $a1->p2;//出错，因为这里时“外部”，又是protected修饰
//echo "<br />a1->p3=" . $a1->p3;//出错，因为这里时“外部”，又是private修饰
class B extends A{
    function ShowInfo1(){
        echo "<br />this->p1=" . $this->p1;
        echo "<br />this->p2=" . $this->p2;
        //echo "<br />this->p3=" . $this->p3;//出错！因为这里时继承类内部又是private修饰
    }
}
$b1 = new B();
echo "<hr />";
$b1->ShowInfo1();