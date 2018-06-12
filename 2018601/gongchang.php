<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 12:57
 */
class A{}
class B{}
//设计一个工厂类,这个工厂类，有一个静态方法：
//通过该方法可以获得指定类的对象！
class GongChang{
    static function GetObject($className){
        $obj = new $className();
        return $obj;
    }
}
$o1 = GongChang::GetObject("A");
$o2 = GongChang::GetObject("B");
