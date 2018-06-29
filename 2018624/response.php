<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/24
 * Time: 14:01
 */
//echo 'Hello ' . $_GET['name'];

//项目中的语言支持
$support_list = getSupportLang();


$browser_list = getBrowserLang();
//var_dump($browser_list);


$curr_lang = getLang($support_list,$browser_list);
//var_dump($curr_lang);
require './language/' .$curr_lang . '.php';
echo $lang['Hello'] . ' ' . $_GET['name'];

//找到浏览器所需要的
function getLang($s_l,$b_l){
    $lang = 'zh_cn';//默认的语言
    foreach ($b_l as $l){
        if(in_array($l,$s_l)){
            //找到浏览器所需要的
            $lang = $l;
            break;
        }
    }
    return $lang;
}
//获取项目中支持的语言
function getSupportLang(){
    $path = './language/';
    $hanle = opendir($path);
    while($filename = readdir($hanle)){
        if($filename == '.' || $filename == '..')continue;
        $lang_list[] = substr($filename,0,strpos($filename,'.'));
    }
    return $lang_list;
}

//获取浏览器所需要的语言
function getBrowserLang(){
    $accept_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    //en,zh-CN;q=0.7,ar-EG;q=0.3
    //分析上面的字符串，获取数组array（'en','zh-CN','ar-EG'）
    $lang_list = explode(',',$accept_language);
    foreach ($lang_list as $lang){
        $tmp_arr = explode(';',$lang);
        $tmp_lang = $tmp_arr[0];
        $browser_list[] = str_replace('-','_',strtolower($tmp_lang));

    }
    return $browser_list;
}


