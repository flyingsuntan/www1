<?php

// $path = 'e:/amp/apache/htdocs/shop39';
// readDirS($path);
/**
 * @param  [type]  $path [description]
 * @param  integer $deep 当前深度
 * @return [type]        [description]
 */
/* 直接展示版
function readDirS($path, $deep=0) {
	$handle = opendir($path);
	while(false !== ($filename = readdir($handle))) {
		// ., .. 直接跳过
		if ($filename == '.' || $filename == '..') continue;

		echo str_repeat('&nbsp;', $deep*4), $filename, '<br>';
		// 判断当前读取到的是否为目录
		if (is_dir($path . '/' . $filename)) {
			// 是目录，递归处理，深度+1
			readDirS($path . '/' . $filename, 1+$deep);
		}
	}

	closedir($handle);
}
*/

$path = 'e:/wamp/www';
$result = readDirS_array($path);
echo '<Pre />';
var_dump($result);

// 返回数组版
function readDirS_array($path, $deep=0 ,$type='dir') {
    // static 保证在readDirs_array中，一直可以存在，为了保证每次递归调用，操作都是一同一个数据（数组）
    static $file_list = array();// 存储所有的文件信息，二维数组！
    $handle = opendir($path);
    while(false !== ($filename = readdir($handle))) {
        // ., .. 直接跳过
        if ($filename == '.' || $filename == '..') continue;
        // 将当前文件信息，存储到数组中
        $fileinfo['filename'] = $filename;
        $fileinfo['deep'] = $deep;
        $fileinfo['type'] = $type;
        // 放入二维数组中！
        $file_list[] = $fileinfo;
        // 判断当前读取到的是否为目录
        if (is_dir($path . '/' . $filename)) {
            // 是目录，递归处理，深度+1
            //$type = 'dir';
            readDirS_array($path . '/' . $filename, 1+$deep);
        }else{
            $type = 'file';
        }
    }
    closedir($handle);
    // 返回
    return $file_list;
}