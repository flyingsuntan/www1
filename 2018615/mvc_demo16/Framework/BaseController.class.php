<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/10
 * Time: 16:41
 */
class BaseController{
    function __construct()
    {
        header("content-type:text/html;charset=utf-8");
    }
    //��ʾһ������ʾ���֣�Ȼ���Զ���ת����������ͣ����ʱ��������
    function GotoUrl($msg,$url,$time){
        echo "$msg";
        echo "<br /><a href='?'>����</a>";
        echo "<br />ҳ�潫��{$time}��֮���Զ���ת��";
        header("refresh:$time;url=$url");//�Զ���ʱ��ת����
    }
}