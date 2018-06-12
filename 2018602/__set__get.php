<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/2
 * Time: 13:33
 */
class A{
    //定义一个属性，这个属性意图存储若干个不存在得属性数据
    protected $prop_list = array();
    //这个方法会在A得对象使用一个不存在得属性进行赋值时自动调用
    function __set($name, $value)
    {
        // TODO: Implement __set() method.
        //echo "你正在使用不存在得属性.....";
        $this->prop_list[$name] = $value;
    }
    function __get($name)
    {
        if (isset($this->prop_list[$name])){
            return $this->prop_list[$name];
        }else {
            return "该属性不存在";
        }
        // TODO: Implement __get() method.
    }


    function __isset($name)
    {
        // TODO: Implement __isset() method.
        $v1 = isset($this->prop_list[$name]);
        return$v1;
    }
    function __unset($name)
    {
        // TODO: Implement __unset() method.
        unset($this->prop_list[$name]);//这里其实是去销毁其中得属性列表得数组得某个单元
    }
}
$a1 = new A();
$a1->p1 = 1;
$a1->h2 = 2;
$a1->abc = '传智';
echo "<br />然后输出这些不存在得属性得值";
echo "<br />a1->p1:" . $a1->p1;
echo "<br />a1->h2:" . $a1->h2;
echo "<br />a1->abc:" . $a1->abc;
echo "<br />a1->abcddd:" . $a1->abcddd;//这个显然不存在
//下面演示isset判断一个不存在的属性
$v1 = isset($a1->p1);//存在
$v2 = isset($a1->ppp1);//不存在
echo "<hr />";
var_dump($v1);
echo "<br />";
var_dump($v2);
//下面演示销毁一个不存在得属性
echo "<hr />";
unset($a1->h2);
echo "<br />a1->h2:" . $a1->h2;
