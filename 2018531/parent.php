<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/31
 * Time: 16:21
 */

//parent�ؼ�����ʾ
class A{
    static $p1 = 1;
    static protected $p2 = 2;
}
class B extends A{
    static function Show1(){
        echo "<p>����������B�еķ���";
        echo "<br />����Ҫ��ʾ���������p1��" .self::$p1;
        echo "<br />����Ҫ��ʾ���������p2��" .parent::$p2;
}
}
B::Show1();//��̬������ֱ��ʹ������������
//������ʾʹ��parent�������󡱵����������ʵ�����Ի�ʵ����������
class C {
    public $p1 = 1;
    function ShowInfo(){
        echo "<br />C�е�����p1:" .$this->p1;
        echo "<pre />";
        var_dump($this);
        echo "<pre />";
    }
}
class D extends C{
    function Show2(){
        echo "<p>���ø����е�ʵ������:" ;
        parent::ShowInfo();
    }
}
$d1 = new D();
$d1->Show2();
?>