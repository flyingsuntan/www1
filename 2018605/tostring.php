<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 15:09
 */
class A {
    public $name;
    public $age;
    public $edu;
    function __construct($name,$age,$edu)
    {
        $this->name = $name;
        $this->age = $age;
        $this->edu = $edu;
    }
    function __toString()
    {
        // TODO: Implement __toString() method.
        $str = "姓名：" . $this->name;
        $str .= "，年龄：" . $this->age;
        $str .= "，学历：" . $this->edu;
        return $str;  //这里可以返回“任何字符串内容”
        //比如也可以这样：return $this->name
    }
}
$obj1 = new A("张三",18,"大学");
echo $obj1;