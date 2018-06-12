<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/31
 * Time: 14:33
 */
class Teacher {
    public $name;
    public $age;
    public $from;
    public function ZiWoJeShao(){
        echo "我叫{$this->name}今年{$this->age}岁来自{$this->from}";
    }
    function __construct($n,$a,$f)
    {
        $this->name = $n;
        $this->age = $a;
        $this->from = $f;
    }
    function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo "<br />教师成功";
    }
}
$o1 = new Teacher('谭飞阳',25,'重庆');
$o1->ZiWoJeShao();



class Students{
    const School = '传智';
    public $name;
    public $sex;
    public $age;
    static $con = 0;
    function __construct($n,$s,$a)
    {
        $this->name = $n;
        $this->sex = $s;
        $this->age = $a;
        self::$con++;
        echo "<br />{$this->name}加入" . Students::School . "，当前有" . Students::$con . "个学生";
    }
    public function JieShao(){
        echo "<br />我叫{$this->name}今年{$this->age}岁性别{$this->sex}";

    }
    function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo "<br />{$this->name}加入成功";
    }
}
$o2 = new Students('谭飞阳',男,25);
$o2->JieShao();
$o3= new Students('谭飞阳',男,25);
$o3->JieShao();

