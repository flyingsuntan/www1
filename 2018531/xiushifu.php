<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/31
 * Time: 15:47
 */
//���η�
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
//echo "<br />a1->p2=" . $a1->p2;//������Ϊ����ʱ���ⲿ��������protected����
//echo "<br />a1->p3=" . $a1->p3;//������Ϊ����ʱ���ⲿ��������private����
class B extends A{
    function ShowInfo1(){
        echo "<br />this->p1=" . $this->p1;
        echo "<br />this->p2=" . $this->p2;
        //echo "<br />this->p3=" . $this->p3;//������Ϊ����ʱ�̳����ڲ�����private����
    }
}
$b1 = new B();
echo "<hr />";
$b1->ShowInfo1();