<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 14:49
 */
class Mysql{
    public $link = null;
    private $db_host;
    private $db_port;
    private $db_user;
    private $db_pwd;
    private $bm;
    private $database;

    function __construct($db_host,$db_port,$db_user,$db_pwd,$bm,$database)
    {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pwd = $db_pwd;
        $this->bm = $bm;
        $this->database = $database;
        $this->link = mysql_connect($this->db_host . ":" .$this->db_port,$this->db_user,$this->db_pwd);
        $set_bm = mysql_query("set names $this->bm");
        $set_cha = mysql_query("use $this->database");
        if($this->link){
            echo "���ӳɹ�";
        }else {
            echo "ʧ��";
        }
        if($set_bm){
            echo "���ӳɹ�";
        }else {
            echo "ʧ��";
        }
        if($set_cha){
            echo "���ӳɹ�";
        }else {
            echo "ʧ��";
        }

    }
    function Bm($bm){
        $set_bm1 = mysql_query("set names $bm");
        if($set_bm1){
            echo "������ĳɹ�";
        }else{
            echo "�������ʧ��";
        }
    }
    function DataBase($database){
        $set_cha1 = mysql_query("use $database");
        if($set_cha1){
            echo "���ݿ���ĳɹ�";
        }else{
            echo "���ݿ����ʧ��";
        }
    }
    function closeDB()
    {
        $close  = mysql_close($this->link);
        if($close){
            echo "�رճɹ�";
        }else{
            echo "�ر�ʧ��";
        }
    }

}
$db1 = new Mysql('127.0.0.1','3306','root','','gb2312','ceshi');
$db1 ->Bm(gb2312);
$db1->closeDB();
