<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/30
 * Time: 11:52
 */
//����һ��"����"(Person��)
class Person{
    var $name;
    var $age;
    var $edu;
}
//����һ���µ�Person�����,���������$obj1�У���ʵ���Ǹ�ֵ��
$obj1 = new Person();
$obj1->name = '����';  //���š�->�����Ǳ�ʾָ�������е�ĳ������������������Ǹ���������ֵ��
$obj1->age = 18;
$obj1->edu = '��ѧ';
echo "<pre />";
var_dump($obj1);
echo "<pre />";
//�ִ���һ������
$obj2 = new Person();
$obj2->name = '����';
$obj2->age = 22;
$obj2->edu = '����';
echo "<pre />";
var_dump($obj2);
echo "<pre />";
