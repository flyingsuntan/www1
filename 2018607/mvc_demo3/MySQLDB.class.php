<?php
//header("Content-Type: text/html;charset=utf-8");
class MySQLDB{
    private $link = null;
    private $db_host;
    private $db_port;
    private $db_user;
    private $db_pwd;
    private $bm;
    private $database;

    //ʵ�ֵ�����2�������ڴ洢Ψһ�ĵ�������
    private static $instance = null;
    //ʵ�ֵ�����3����
    static function GetInstance($config){
        //if(!isset(self::$instance)){
        if(!(self::$instance instanceof self)){
            self::$instance = new self($config);
        }
        return self::$instance;

    }
    //ʵ�ֵ�����4����˽�л���¡��ħ������
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    //ʵ�ֵ�����1����
    private function __construct($config)
    {
        //�Ƚ�������������Ϣ����������
        $this->db_host = !empty($config['db_host']) ? $config['db_host'] : "127.0.0.1";//���ǿ�ֵ�����ʹ��Ĭ��ֵ����
        $this->db_port = !empty($config['db_port']) ? $config['db_port'] : "3306";
        $this->db_user = !empty($config['db_user']) ? $config['db_user'] : "root";
        $this->db_pwd = !empty($config['db_pwd']) ? $config['db_pwd'] : "";
        $this->bm = !empty($config['bm']) ? $config['bm'] : "gb2312";
        $this->database = !empty($config['databas']) ? $config['databas'] : "ceshi";
        //Ȼ���������ݿ�
        $this->link = mysql_connect($this->db_host . ":" . $this->db_port,$this->db_user,$this->db_pwd) or die  ("����ʧ��");
        //�趨����
        //$set_bm = mysql_query("set names {$config['bm']}");
        $this->Bm($this->bm);
        //ѡ��Ҫʹ�õ����ݿ���
        $this->DataBase($this->database);
    }
    //�������ݿ����
    function Bm($bm){
        $set_bm1 = mysql_query("set names $bm");
    }
    //�������ݿ�
    function DataBase($database){
        $set_cha1 = mysql_query("use $database");
    }
    //�ر��������ݿ�
    function closeDB()
    {
        $close  = mysql_close($this->link);
    }
    //�������Ϊ��ִ��һ����ɾ����䣬�����Է�����ٽ��
    function exec($sql){
        $result = $this->query($sql);
        return true;

    }
    //�������Ϊ��ִ��һ������һ�����ݵ���䣬�����Է���һά����
    //������±꣬����sql����е�ȡ�����ֶ�����
    function GetOneRow($sql){
        $result = $this->query($sql);
        //���￪ʼ�������ݣ��Է������顣��ʱ$resultʱһ�������
        $rec = mysql_fetch_assoc($result);
        mysql_free_result($result);//��ǰ�ͷ���Դ�����ٽ��������������Ҫ�ȵ�ҳ����������ͷ�
        return $rec;

    }
    //������Ϊ��ִ��һ�����ض������ݵ���䣬�����Է��ض�ά����
    function GetRows($sql){
        $result = $this->query($sql);
        //���￪ʼ�������ݣ��Է������顣��ʱ$resultʱһ�����������ʱ�������ݣ�
        $arr = array();//�����飬���ڴ��Ҫ���صĽ�����飨��ά��
        while($rec = mysql_fetch_assoc($result)){
            $arr[] = $rec;//��ʱ��$arr���Ƕ�ά������
        }
        return $arr;
    }
    //������Ϊ��ִ��һ������һ�����ݵ���䣬�����Է���һ��ֱ��ֵ
    function GetOneData($sql){
        $result = $this->query($sql);
        //���￪ʼ�������ݣ��Է���һ�����ݣ�
        $rec = mysql_fetch_row($result);
        $data = $rec[0];
        return $data;
    }
    //�����������ִ���κ�sql��䣬�����д������򷵻�ִ�н��
    private function query($sql){
        $result = mysql_query($sql);
        if($result ===false){
            //���ִ��ʧ�ܣ�����Ҫ��������ʧ�������
            echo "<p>sql���ִ��ʧ�ܣ���ο�������Ϣ��";
            echo "<br />�������" . mysql_errno();//��ȡ�������
            echo "<br />������Ϣ" . mysql_error();//��ȡ������ʾ�ڲ�
            echo "<br />�������" . $sql;
            die();
        }
        return $result;//���ص��ǡ�ִ�еĽ����
    }
}