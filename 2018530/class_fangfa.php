<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/30
 * Time: 17:19
 */
class C1{
    public $p1 = 1;
    static $p2 = 2;
    function ShowInfo1(){  //ʵ������
        echo "<br />ʵ�����Ա����ã�";
        echo "<br />p1��ֵΪ��" . $this->p1;
        //this����һ�����󣬾��ǵ��õ�ǰ��������Ķ���
    }
    static function ShowInfo2(){ //��̬����
        echo "<br />��̬���Ա����ã�";
        //echo "<br />p1��ֵΪ��" . $this->p1;��һ�г���
        echo "<br /> p2��ֵΪ��" .self::$p2;
        //self����һ�����ࡱ,��������ʣ�self���������ڵ�����࣬�������C1
    }
}
$o1 = new C1;
$o1 -> ShowInfo1();//ʹ�ö������ʵ������
C1::ShowInfo2();//ʹ���������þ�̬����