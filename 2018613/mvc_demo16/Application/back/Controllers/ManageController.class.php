<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/13
 * Time: 17:19
 * 后台管理相关的控制器类
 */
class ManageController extends BaseController{
    /*
     * 首页动作
     * */
    public function IndexAction(){
    //提示
        if(!isset(IS_LOGIN)){
            header("Location:index.php?p=back&c=Admin&a=Login");die;
        }else{
        echo "这里是后台首页！不久会被更好的实现";
        }
    }
}