<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/24
 * Time: 16:48
 */
$file = './51875badb57d3.jpg';
header('Content-Disposition:attachment;filename=' . basename($file));
$finfo = new Finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($file);
header('Content-Type:' . $mime);
header('Content-Length:' . filesize($file));
//echo 'ITCAST_KANG';
$file = './51875badb57d3.jpg';
$handle = fopen($file,r);
while (!feof($handle)){
    echo fgets($handle,1024);
}
fclose($handle);