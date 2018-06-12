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
        echo "<br />你小心点，你正用得属性{$prop_name}我还没有定义呢";
    }
    function __set($name, $value)
    {
        // TODO: Implement __set() method.
        echo "<br />没有赋值得对象{$name}";
    }
}
$a1 = new A();
echo $a1->p1;//1;
echo $a1->p2;//出错，未定义之类！
$a1->p3 = 3;