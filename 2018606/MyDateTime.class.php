<?php
/**
 * Created by PhpStorm.
 * User: Administrator
* Date: 2018/6/6
* Time: 18:11
*/
class MyDateTime{
    function GetDate(){
        return date("Y��m��d��");
    }
    function GetTime(){
        return date("H:i:s");
    }
    function GetDateTime(){
        return date("Y��m��d�� H:i:s");
    }
}