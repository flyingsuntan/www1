<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/28
 * Time: 15:05
 */
//批量实体转义
function deepspecialchars($data){
    if(empty($data)){
        return $data;
    }
    //中高级的写法
    return is_array($data) ?  array_map('deepspecialchars',$data) :  htmlspecialchars($data);
   /*
    //初级程序员的写法
    //array('username' => 'zs','email'=>'zs@163.com')
    if(is_array($data)){
        //数组
        foreach ($data as $k => $v){
            $data[$k] = deepspecialchars($v);
        }
        return $data;
    }else{
        //单个变量
        return htmlspecialchars($data);
    }*/
}
function deepaddslashes($data){
    if(empty($data)){
        return $data;
    }
    //中高级的写法
    return is_array($data) ?  array_map('deepaddslashes',$data) :  addslashes($data);
}
