<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/30
 * Time: 15:07
 */
class Student{
    public $name = "";//实例属性
    static $count = 0;//静态属性
}
$s1 =  new Student();
$s1->name = "张三";//使用普通属性，这里时赋值
Student::$count++;//使用静态属性，统计学生对象数量
$s2 = new Student();
$s2->name = "李四";//使用普通属性，这里时赋值
Student::$count++;//使用静态属性，统计学生对象数量
echo "当前的学生对象总数为：" . Student::$count;
