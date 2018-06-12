<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/2
 * Time: 16:14
 */
class A {
    //当对这个对象的不存在的实例方法进行调用的时候，会自动调用本方法
    //这个方法必须带2个形参：
    //$name:表示要调用的不存在的方法名；
    //$arguments表示要调用该不存在的方法时，所使用的实参数据，是一个数组；
    function __call($name, $arguments)
    {
        echo "<bt />__call被调用了";
        // TODO: Implement __call() method.
    }

}
$a1 = new A();
$a1->f1();