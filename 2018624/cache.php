<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/24
 * Time: 16:35
 */
header('Content_Type:text/html;charset=utf-8');
//Sun, 24 Jun 2018 08:38:11 GMT
$expires = gmdate('D,d M Y H:i:s',time()+3 . 'GMT');
header('Expires:' . $expires);

echo date("H:i:s") ."<hr />";
?>
<a href="cache.php">点击</a>
