<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/19
 * Time: 10:26
 */
//不仅仅是用COOKIE传输session-ID
ini_set('session.use_only_cookies','0');
//自动通过url或者表单传输session_id
ini_set('session.ues_trans_sid','1');

//常规使用session即可！
session_start();
?>
<hr>
<form action ="session_no_cookie_2.php" method="post">
    <input type="submit">
</form>
<hr>
<a href="session_no_cookie_2.php">no coolie</a>
