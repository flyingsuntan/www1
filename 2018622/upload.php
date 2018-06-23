<?php
header('Content-type:text/html;charset=utf-8');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/22
 * Time: 13:09
**/
$result = uploadFile($_FILES['goods_image']);
var_dump($result);
/**
 * 文件上传（业务逻辑判断）函数
 * 一次上传（判断）一个文件
 * @param array $file_info 某个临时上传文件的5个信息，由$_FILES中获得
 **/

function uploadFile($file_info){
    //判断是否有错误
    if($file_info['error'] !=0){
        echo "上传文件存在错误";
        return false;
    }

    //判断文件类型

    //后缀名
    $ext_list = array('.jpg','.png','.gif','.jpeg');//允许的后缀名
    $ext = strchr($file_info['name'],'.');
    if(!in_array($ext,$ext_list)){
        echo "类型，后缀不合法";
        return false;
    }
    //MIME
    $mime_list =  array('image/jpeg','image/png','image/gif');//允许的MIME列表！
    if(!in_array($file_info['type'],$mime_list)){
        echo "类型，MIME不合法";
        return false;
    }
    //PHP检测MIME
    $finfo = new Finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($file_info['tmp_name']);
    if(!in_array($mime_type,$mime_list)){
        echo "类型，PHP检测MIME不合法";
        return false;
    }



    //判断文件大小
    $max_size = 500*1024; //允许的最大尺寸
    if($file_info['size']>$max_size){
        echo "文件过大";
        return false;
    }


    //设置目标文件地址
    //上传目录
    $upload_path = './';
    //采用子目录存储
    //获取当前需要的子目录名（目录/小时）
    $sub_dir = date('YmdH') . '/';
    //是否存在
    if (!is_dir($upload_path . $sub_dir)){
        mkdir($upload_path . $sub_dir);
    }
    //目标文件名
    $prefix = ''; //前缀
    $dst_name = uniqid($prefix,true) . $ext;

    //是否为HTTP上传文件的检测
    if(!is_uploaded_file($file_info['tmp_name'])){
        echo '不是HTTP上传的临时文件';
        return false;
    }

    //移动
   if( move_uploaded_file($file_info['tmp_name'],$upload_path . $sub_dir . $dst_name)){
       //移动成功
       return $sub_dir .$dst_name;
   }else{
       echo "移动失败";
       return false;
   }
}