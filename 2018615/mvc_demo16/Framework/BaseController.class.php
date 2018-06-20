<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/10
 * Time: 16:41
 */
class BaseController{
    function __construct()
    {
        header("content-type:text/html;charset=utf-8");
    }
    //显示一定的提示文字，然后自动跳转（可以设置停留的时间秒数）
    function GotoUrl($msg,$url,$time){
        echo "$msg";
        echo "<br /><a href='?'>返回</a>";
        echo "<br />页面将在{$time}秒之后自动跳转。";
        header("refresh:$time;url=$url");//自动定时跳转功能
    }
}