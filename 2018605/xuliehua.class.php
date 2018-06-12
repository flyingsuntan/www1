<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 14:40
 */
class Xuliehua{
    public $p1 = 1;
    protected $p2 = 2;
    private  $p3 = 3;
    static $p4 = 4;
    function f1(){
        echo "<br />f1方法被调用了";
    }
    function __sleep()
    {
        // TODO: Implement __sleep() method.
        echo "要进行序列化了！";
        //下一行表示指定p1和p2这两个属性数据进行序列化
        return array('p1','p2');
    }
}