<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/2
 * Time: 16:14
 */
class A {
    //�����������Ĳ����ڵ�ʵ���������е��õ�ʱ�򣬻��Զ����ñ�����
    //������������2���βΣ�
    //$name:��ʾҪ���õĲ����ڵķ�������
    //$arguments��ʾҪ���øò����ڵķ���ʱ����ʹ�õ�ʵ�����ݣ���һ�����飻
    function __call($name, $arguments)
    {
        echo "<bt />__call��������";
        // TODO: Implement __call() method.
    }

}
$a1 = new A();
$a1->f1();