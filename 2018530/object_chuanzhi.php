<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/30
 * Time: 13:58
 */

class c1{
    var $p1 = 1;
}
$v1 =1 ;
$v2 = $v1;//ֵ����
$v1++;
echo "<br />v1 = $v1,v2 = $v2";//2��1
$o1 = new c1();
$o2 = $o1;//ֵ����
$o1->p1=2;
echo "<br />o1->p1 = {$o1->p1},o2->p1 = {$o2->p1}";//2��2

$o3 = new c1();
$o4 = &$o3;//���ô���
$o3->p1=2;
echo "<br />o3->p1 = {$o3->p1},o4->p1 = {$o4->p1}";//2��2

?>