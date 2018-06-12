<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/11
 * Time: 14:38
 */
class AdminController extends BaseController {
    function LoginAction(){
        include VIEW_PATH . 'Login.html';
    }
}