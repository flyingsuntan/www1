<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/2
 * Time: 16:26
 */
//Ŀ�꣺���һ���࣬������ʵ��������ʵ����������
//���÷���f1��
//����һ���������ͷ����䱾��
//����2������������ƽ����
//����3�����������������ͣ�
//����������ʽ������
class A {
    //����һ��ħ����������A�Ķ�����ò����ڵķ�����ʱ��
    //�ᱻ�Զ�������Ӧ�����������
    function __call($name,$argument){
        //�ͱ�ʾҪ�������ʱ��ʽ��ʹ��f1����������ڵķ���
        if($name === 'f1'){
            $len = count($argument);
            if($len<1 || $len >3){
                trigger_error("ʹ�÷Ƿ��ķ���",E_USER_ERROR);
            }else if($len == 1){
                return $argument[0];
            }else if ($len == 2){
                return $argument[0]*$argument[0] + $argument[1]*$argument[1];
            }else if ($len == 3){
                return $argument[0]*$argument[0]*$argument[0] + $argument[1]*$argument[1]*$argument[1] + pow($argument[2],3);
            }
}


    }
}
$a1 = new A();   //ʵ��������һ������
$v1 = $a1 -> f1(1);
$v2 = $a1 -> f1(2,3);
$v3 = $a1 -> f1(4,5,6);
echo "v1 = $v1,v2= $v2,v3 = $v3";