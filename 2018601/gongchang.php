<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 12:57
 */
class A{}
class B{}
//���һ��������,��������࣬��һ����̬������
//ͨ���÷������Ի��ָ����Ķ���
class GongChang{
    static function GetObject($className){
        $obj = new $className();
        return $obj;
    }
}
$o1 = GongChang::GetObject("A");
$o2 = GongChang::GetObject("B");
