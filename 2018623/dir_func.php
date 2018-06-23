<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/23
 * Time: 11:43
 */

//mkdir
/**
$path = './where/to/some/path';
$result = mkdir($path,0777,true);
var_dump($result);
 * */

/*
//rmdir
//$path = './where/to/some/path';
$path = './where';
$result = rmdir($path);
var_dump($result);
*/


//opendir,readdir,closedir
/*
$path = 'e:/wamp/www';
$handle = opendir($path);
var_dump($handle);

while(false !==($filename = readdir($handle))){
    if($filename == '.' || $filename == '..')continue;
echo $filename . "<br />";
}
closedir($handle);
*/

//rename
$old_path = './where';
$new_path = '../2018622/some';
$result = rename($old_path,$new_path);
var_dump($result);
