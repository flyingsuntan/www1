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
        echo "<br />�����еĹ��췽����";
        var_dump($this);
    }
}
class B extends A{
    function __construct()
    {
        echo "<br />�����еĹ��췽����";
        var_dump($this);
    }
}
class C extends A{
    //�������û�й��췽��
}
$o1 = new B();
$o2 = new C();

class D{
    function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo "<br />���౻���١�";
    }
}
class E extends D{
    function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo "<br />���౻���١�";
    }
}
class F extends D{

}
$o3 = new E();
$o4 = new F();
?>