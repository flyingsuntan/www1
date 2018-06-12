<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 16:54
 */
class  A {
    public  $p1 = 1;
}
$obj1 = new A();
$obj1 -> p1 = 11;
$obj2 = $obj1;
var_dump($obj1);
echo "<br />";
var_dump($obj2);
 $obj3 = clone $obj1;//克隆出新对象
echo "<br />";
 var_dump($obj3);
?>