<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 17:20
 */
class A{
    static $p1 = 1;
    static function Show1(){
        echo "<br />self::p1=" . self::$p1;
        echo "<br />static::p1=" . static::$p1;
    }
}
class B extends A{
    static $p1 = 11; //÷ÿ–¥¡À$p1
}
A::Show1();
echo "<hr />";
B::Show1();