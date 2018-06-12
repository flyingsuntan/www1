<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/2
 * Time: 16:26
 */
//目标：设计一个类，这个类的实例，可以实现如下需求：
//调用方法f1：
//传入一个参数，就返回其本身，
//传入2个参数就求其平方和
//传入3个参数就求其立方和；
//其他参数形式，报错！
class A {
    //这是一个魔术方法，在A的对象调用不存在的方法的时候
    //会被自动调用来应对这种情况：
    function __call($name,$argument){
        //就表示要处理调用时形式上使用f1的这个不存在的方法
        if($name === 'f1'){
            $len = count($argument);
            if($len<1 || $len >3){
                trigger_error("使用非法的方法",E_USER_ERROR);
            }else if($len == 1){
                return $argument[0];
            }else if ($len == 2){
                return $argument[0]*$argument[0] + $argument[1]*$argument[1];
            }else if ($len == 3){
                return $argument[0]*$argument[0]*$argument[0] + $argument[1]*$argument[1]*$argument[1] + pow($argument[2],3);
            }
}


    }
}
$a1 = new A();   //实例化出来一个对象
$v1 = $a1 -> f1(1);
$v2 = $a1 -> f1(2,3);
$v3 = $a1 -> f1(4,5,6);
echo "v1 = $v1,v2= $v2,v3 = $v3";