<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 11:24
 */
//演示类型约束：
interface USB{}//这就是一个接口
class A{} //这就是类
class B implements USB{} //这个类实现了接口USB

function f1($p1,array $p2 , A $p3 ,USB $p4){
    echo "<br />没有约束的P1： " . $p1;
    echo "<br />要求是数组的P2： " ;
    print_r($p2);
    echo "<br />要求是类A的对象： " ;
    var_dump($p3);
    echo "<br />要求是实现了接口USB的对象： " ;
    var_dump($p4);
}
$obj1 = new A();
$obj2 = new B();
$arr = array (1,2,3);
//下面开始各种形式调用函数：
//f1(1.2,1.3,$obj1,$obj2);//这里报错，1.3不合适
//f1(1.2,$arr,$obj2,$obj2);这里报错，第一个$obj2不合适
//f1(1.2,$arr,$obj1,$obj1);这里报错，第二个$obj1不合适
f1(1.2,$arr,$obj1,$obj2);