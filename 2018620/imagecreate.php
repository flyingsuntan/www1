<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/20
 * Time: 11:08
 * 创建新的画布
* imagecreate();//（宽，高）创建基于调色板画布（支持的颜色少）
* imagecreatetruecolor();//(宽，高)创建正彩色（支持的颜色多）
 *
 *
 * 基于已有图像创建画布：
 * imagecreatefromjpeg（图片地址）；
 * imagecreatefrompng();
 * imagecreatefromgif();
 *
 *
 *
 * 分配颜色：为某张画布分配某种颜色
 * 颜色的标识方式：RGB颜色
 * imagecolorallocate（画布，颜色R，颜色G，颜色B）
 *
 * 填充画布：使用某个颜色，在画布的某个位置进行填充
 * imagefill(画布，位置X，位置Y，颜色);
 * 位置，采用坐标标识。
 * 原点：左上角，0，0
 * 向右，X增加
 * 向下，Y增加
 * 右下角坐标：（width-1，height-1）
 *
 *
 * 导出（输出）
 * imagepng（）输出为png格式
 * imagegif（）
 * imagejpeg（）
 *
 * */