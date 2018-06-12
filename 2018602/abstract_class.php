<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/2
 * Time: 12:01
 */
//怪物类
abstract  class Guai {
    protected $blood = 100;
    abstract protected function Attach();
}
//蛇怪
class Snake extends Guai{
    protected function Attach(){
        echo "<br />悄悄靠近主人公，然后迅猛咬一口！";
        $this->blood--; //自身掉血1点
    }
}
//虎怪
class Tiger extends Guai{
    protected function Attach(){
        echo "<br />猛扑猛咬主人公";
        $this->blood--; //自身掉血1点
    }
}