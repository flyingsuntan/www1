<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 12:27*/

$v1 = 1;
$v2 = 'abc';
$v3 = false;
$v4 = array(41,42,43);
$str1 = serialize($v1);//תΪ�ַ���
$str2 = serialize($v2);
$str3 = serialize($v3);
$str4 = serialize($v4);
file_put_contents('./file1.txt',$str1);//��str1�洢��file1.txt�ϡ�
file_put_contents('./file2.txt',$str2);
file_put_contents('./file3.txt',$str3);
file_put_contents('./file4.txt',$str4);

