<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 11:24
 */
//��ʾ����Լ����
interface USB{}//�����һ���ӿ�
class A{} //�������
class B implements USB{} //�����ʵ���˽ӿ�USB

function f1($p1,array $p2 , A $p3 ,USB $p4){
    echo "<br />û��Լ����P1�� " . $p1;
    echo "<br />Ҫ���������P2�� " ;
    print_r($p2);
    echo "<br />Ҫ������A�Ķ��� " ;
    var_dump($p3);
    echo "<br />Ҫ����ʵ���˽ӿ�USB�Ķ��� " ;
    var_dump($p4);
}
$obj1 = new A();
$obj2 = new B();
$arr = array (1,2,3);
//���濪ʼ������ʽ���ú�����
//f1(1.2,1.3,$obj1,$obj2);//���ﱨ��1.3������
//f1(1.2,$arr,$obj2,$obj2);���ﱨ����һ��$obj2������
//f1(1.2,$arr,$obj1,$obj1);���ﱨ���ڶ���$obj1������
f1(1.2,$arr,$obj1,$obj2);