<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/16
 * Time: 17:06
 */
require "session_db.php";
//设置
ini_set('session.gc_probability','1');
ini_set('session.gc_divisor','3');
session_start();
