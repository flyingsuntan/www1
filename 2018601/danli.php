<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 14:14
 */
//����ģʽ��
//�����������һ���࣬�����ֻ�ܡ����족������һ������ʵ������
class Single {
    //��һ����˽�л����췽����
    private function __construct()
    {
    }
    //�ڶ���������һ����̬���ԣ���ʼ��null
    static private $instance = null;
    //������������һ����̬�����������ж϶����Ƿ����ɲ��ʵ����ظö���
    static function GetObject(){
        //׼������������Լ����߼������ƺö������������һ����
        //Ȼ�󡰷��ظ��˼ҡ�
        if(!isset(self::$instance)){
            $obj = new self();//������һ����
           self::$instance = $obj;//���׵��ش�������
            return self::$instance;//Ȼ�󷵻ء�

        }else{
            return self::$instance;
            //��ֱ�ӷ��ظ��������Ķ���
        }
    }
}
$obj1 = Single::GetObject();
$obj2 = Single::GetObject();
var_dump($obj1);echo "<br />";
var_dump($obj2);echo "<br />";