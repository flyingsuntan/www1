<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 11:36
 */

class A {
    function __construct()
    {
        echo "<br />父类中的构造方法。";
        var_dump($this);
    }
}
class B extends A{
    function __construct()
    {
        echo "<br />子类中的构造方法。";
        var_dump($this);
    }
}
class C extends A{
    //这个类中没有构造方法
}
$o1 = new B();
$o2 = new C();

class D{
    function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo "<br />父类被销毁。";
    }
}
class E extends D{
    function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo "<br />子类被销毁。";
    }
}
class F extends D{

}
$o3 = new E();
$o4 = new F();
?>