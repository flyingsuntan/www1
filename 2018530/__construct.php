<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/30
 * Time: 17:38
 */

class Person
{
    var $name ;
    var $age ;
    var $edu ;

    function xiyifu()
    {
        echo "<br />{$this->age}���{$this->edu}ѧ��";
        echo "��{$this->name}���ڿ��ϴ�·�";
    }
}
$girl1 = new Person();//����һ������
$girl1->name = "С��";//Ȼ��ֱ�����������
$girl1->age = 18;
$girl1->edu = "��ѧ";
$girl1->xiyifu();

$girl2 = new Person();//�ٴ���һ������
$girl2->name = "С��";//Ȼ��ֱ�����������
$girl2->age = 19;
$girl2->edu = "����";
$girl2->xiyifu();

//���Ϸ�ʽ��newһ�����������Ȼ����һ�����ݸ�ֵ����ʼ������
//Ȼ����ܺ��ʵ�ȥʹ�ã����ã��÷��������һ��������


echo "<br />";
class NvShen   //Ů��
{
    var $name ;
    var $age ;
    var $edu ;
    function __construct($p1,$p2,$p3)
    {
        $this->name = $p1;
        $this->age = $p2;
        $this->edu = $p3;
    }

    function xiyifu()
    {
        echo "<br />{$this->age}���{$this->edu}ѧ��";
        echo "��{$this->name}���ڿ��ϴ�·�";
    }
}
//new���NvShen�࣬Ҳ���Ǵ������Ů�������ͬʱ
//�ͻ��Զ�ȥ���ø����еĹ��췽����__construct��$p1,$p2,$p3��
//���new��������������еľ��Ƕ�Ӧʵ�Σ�
$girl3 = new NvShen('С��',18,'��ѧ');
$girl3->xiyifu();
$girl3 = new NvShen('С��',19,'����');
$girl3->xiyifu();