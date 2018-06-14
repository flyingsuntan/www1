<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/14
 * Time: 15:54
 */
$result = setcookie('is_login','yes');
var_dump($result);
setcookie('is_login','yes','time()+180');