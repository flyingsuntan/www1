<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/30
 * Time: 15:07
 */
class Student{
    public $name = "";//ʵ������
    static $count = 0;//��̬����
}
$s1 =  new Student();
$s1->name = "����";//ʹ����ͨ���ԣ�����ʱ��ֵ
Student::$count++;//ʹ�þ�̬���ԣ�ͳ��ѧ����������
$s2 = new Student();
$s2->name = "����";//ʹ����ͨ���ԣ�����ʱ��ֵ
Student::$count++;//ʹ�þ�̬���ԣ�ͳ��ѧ����������
echo "��ǰ��ѧ����������Ϊ��" . Student::$count;
