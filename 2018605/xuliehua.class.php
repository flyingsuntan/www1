<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 14:40
 */
class Xuliehua{
    public $p1 = 1;
    protected $p2 = 2;
    private  $p3 = 3;
    static $p4 = 4;
    function f1(){
        echo "<br />f1������������";
    }
    function __sleep()
    {
        // TODO: Implement __sleep() method.
        echo "Ҫ�������л��ˣ�";
        //��һ�б�ʾָ��p1��p2�������������ݽ������л�
        return array('p1','p2');
    }
}