<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 12:23
 */
//������
class Animal{
    public $p1 = "��ʳ";
    function Move(){
        echo "<br />���ƶ�����!";
    }
}
//����
class Fish extends Animal{
    public $skin = "��������"; //Ƥ��
    public $p1 = "�ſ�Բ�ε�������������ʳ���ˮ";  //�����˸����ͬ������
    function Move(){
        echo "<br />�ڶ�β��ǰ��"; //�����˸����ͬ��������
    }
}
//����
class Bird extends Animal{
    public $skin = "������ë";
    public $p1 = "�ſ����������ʳ��";//�����˸����ͬ������
    function Move(){
        echo "<br />ɿ��������ǰ��";//�����˸����ͬ��������
    }
}
$o1 = new Fish();
$o1->Move();
$o2 = new Bird();