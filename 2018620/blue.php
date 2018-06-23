<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/20
 * Time: 11:14
 */
//创建画布
$width = 500;
$height = 200;
$image = imagecreatetruecolor($width,$height);
//var_dump($image);



//操作画布
//分配颜色
$blue = imagecolorallocate($image,0,0,255);//0,0,0xff


//填充
imagefill($image,0,0,$blue);


//输出
//imagepng($image,'./bule.png');
header('content-type:image/png');
imagepng($image);

//销毁资源
imagedestroy($image);