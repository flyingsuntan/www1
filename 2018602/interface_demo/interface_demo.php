<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/3
 * Time: 12:12
 */
interface  Player{//������
    function play();
    function stop();
    function next();
    function prev();
}
interface USBset {//usb�豸
    const USBWidth = 12;//usb�ӿڵĿ�ȣ���λ����
    const USBHeight = 5; //usb�ӿڵĸ߶ȣ���λ����
    function dataIn();//��������
    function dataOut();//�������
}
//MP3�������࣬��ͬʱ���в������Ĺ��ܣ�Ҳ����usb�豸�������͹���
//������Ϳ��Դ���2���ӿڻ�ȡ�䡰������Ϣ������������ʵ������
class MP3Player implements Player ,USBset {
    function play(){}//ʵ�ָ÷���
    function stop(){}//ʵ�ָ÷���
    function next(){}//ʵ�ָ÷���
    function prev(){}//ʵ�ָ÷���
    function dataIn(){}//ʵ�ָ÷���
    function dataOut(){}//ʵ�ָ÷���
}
$a = new MP3Player();
$a ->play();
