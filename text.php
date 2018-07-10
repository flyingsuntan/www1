<?php
$a = array ();
var_dump($a);
$b = array (array('id'=>4),array('id' => 5),array('id' => 5));
var_dump($b);
$c = array_merge($a,$b);
var_dump($c);
$c = null;
var_dump($c);