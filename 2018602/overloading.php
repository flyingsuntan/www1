<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/2
 * Time: 13:04
 */
class A {
    public $p1 = 1;
    function __get($prop_name)
    {
        // TODO: Implement __get() method.
        echo "<br />��С�ĵ㣬�����õ�����{$prop_name}�һ�û�ж�����";
    }
    function __set($name, $value)
    {
        // TODO: Implement __set() method.
        echo "<br />û�и�ֵ�ö���{$name}";
    }
}
$a1 = new A();
echo $a1->p1;//1;
echo $a1->p2;//����δ����֮�࣡
$a1->p3 = 3;