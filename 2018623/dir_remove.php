<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/23
 * Time: 15:21
 */
 //$path = 'e:/wamp/www';
 readDirS($path);
/**
 * @param  [type]  $path [description]
 * @return [type]        [description]
 */
// 直接展示版
function readDirS($path) {
	$handle = opendir($path);
	while(false !== ($filename = readdir($handle))) {
		// ., .. 直接跳过
		if ($filename == '.' || $filename == '..') continue;
		// 判断当前读取到的是否为目录
		if (is_dir($path . '/' . $filename)) {
			// 是目录，递归处理，深度+1
			readDirS($path . '/' . $filename);
		}else{
		    unlink($path . '/' . $filename);
        }
	}
	closedir($handle);
	//删除该目录
    return rmdir($path);
}