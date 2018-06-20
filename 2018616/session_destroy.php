<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/16
 * Time: 16:34
 */
include "session_db.php";
session_start();
$_SESSION['key'] = 'value';
session_destroy();