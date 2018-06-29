<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/25
 * Time: 16:58
 */
//核心控制器
class Controller{
    //跳转方法
    public  function jump($url,$message,$wait = 3){
        if($wait == 0){
            header("location:$url");
        }else{
            include CUR_VIEW_PATH . "message.html";
        }
        exit();//一定要退出die一样
    }

    //引入工具类模型方法
    public function libaray($lib){
        include LIB_PATH . "{$lib}.class.php";
    }
    //引入辅助函数方法
    public function heloer ($helper){
        include HELPER_PATH . "{$helper}.php";
    }
}