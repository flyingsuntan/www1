<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/30
 * Time: 14:45
 */
//const PP1 = 1;//������ͨ����1
define ("PP2",2);//������ͨ����2
echo PP2;
class C1{
    //�����ೣ��
    const PI = 3.14;
    const G = 9.8;
}
//ʹ���ೣ��
$v1 = C1::PI*3*3;
echo "<br />v1 = $v1";
echo "<br />C1::G = " . C1::G;
echo PP2;
