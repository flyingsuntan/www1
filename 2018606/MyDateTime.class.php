<?php
/**
 * Created by PhpStorm.
 * User: Administrator
* Date: 2018/6/6
* Time: 18:11
*/
class MyDateTime{
    function GetDate(){
        return date("Y年m月d日");
    }
    function GetTime(){
        return date("H:i:s");
    }
    function GetDateTime(){
        return date("Y年m月d日 H:i:s");
    }
}