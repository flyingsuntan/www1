<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/30
 * Time: 18:30
 */
class C1{
    public $name ;
    function __construct($n)
    {
        $this->name = $n;
    }
    function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo "<br />{$this->name}±ªœ˙ªŸ¡À";
    }
}
$o1 = new C1('A');