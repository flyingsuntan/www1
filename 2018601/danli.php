<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 14:14
 */
//单例模式：
//就是设计这样一个类，这个类只能“创造”出它的一个对象（实例）；
class Single {
    //第一步：私有化构造方法：
    private function __construct()
    {
    }
    //第二步：定义一个静态属性，初始化null
    static private $instance = null;
    //第三步：定义一个静态方法，从中判断对象是否生成并适当返回该对象；
    static function GetObject(){
        //准备在这里，根据自己的逻辑，控制好对象的数量：就一个：
        //然后“返回给人家”
        if(!isset(self::$instance)){
            $obj = new self();//就生产一个！
           self::$instance = $obj;//并妥当地存起来，
            return self::$instance;//然后返回。

        }else{
            return self::$instance;
            //就直接返回该已生产的对象
        }
    }
}
$obj1 = Single::GetObject();
$obj2 = Single::GetObject();
var_dump($obj1);echo "<br />";
var_dump($obj2);echo "<br />";