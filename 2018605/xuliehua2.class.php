<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 14:56
 */
class Xuliehua2
{
    public $p1 = 1;
    public $p2 = 2;
    public $p3 = 3;
    static $p4 = 4;

    function f1()
    {
        echo "<br />f1������������";
    }

    function __sleep()
    {
        // TODO: Implement __sleep() method.
        echo "Ҫ�������л��ˣ�";
        //��һ�б�ʾָ��p1��p2�������������ݽ������л�
        return array('p1', 'p2');
    }
    function __wakeup()
    {
        // TODO: Implement __sleep() method.
        echo "Ҫ���з����л��ˣ�";

    }
}
