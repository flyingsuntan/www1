<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 17:08
 */
class A
{
    public $p1 = 1;
    protected $p2 = 2;
    private $p3 = 3;
    static $p4 = 4;

    public function ShowAllProperties()
    {
        foreach ($this as $key => $value) {
            echo "<br /> Ù–‘$key:" . $value;
        }
    }
}
$obj1 = new A();
foreach ($obj1 as $key => $value){
    echo "<br /> Ù–‘$key:" . $value;
    echo "<hr />";
    $obj1 -> ShowAllProperties();
}