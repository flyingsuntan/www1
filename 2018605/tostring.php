<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 15:09
 */
class A {
    public $name;
    public $age;
    public $edu;
    function __construct($name,$age,$edu)
    {
        $this->name = $name;
        $this->age = $age;
        $this->edu = $edu;
    }
    function __toString()
    {
        // TODO: Implement __toString() method.
        $str = "������" . $this->name;
        $str .= "�����䣺" . $this->age;
        $str .= "��ѧ����" . $this->edu;
        return $str;  //������Է��ء��κ��ַ������ݡ�
        //����Ҳ����������return $this->name
    }
}
$obj1 = new A("����",18,"��ѧ");
echo $obj1;