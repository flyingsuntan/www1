<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/15
 * Time: 14:56
 */
@session_start();
echo "<pre />";
class Student{
    private $_name;
    public function __construct($n)
    {
        $this->_name = $n;
    }
}
var_dump($_SESSION);
echo "<pre />";