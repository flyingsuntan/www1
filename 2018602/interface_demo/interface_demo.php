<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/3
 * Time: 12:12
 */
interface  Player{//播放器
    function play();
    function stop();
    function next();
    function prev();
}
interface USBset {//usb设备
    const USBWidth = 12;//usb接口的宽度，单位毫米
    const USBHeight = 5; //usb接口的高度，单位毫米
    function dataIn();//数据输入
    function dataOut();//数据输出
}
//MP3播放器类，它同时具有播放器的功能，也具有usb设备的特征和功能
//则，这里就可以从这2个接口获取其“特征信息”，并在其中实现它；
class MP3Player implements Player ,USBset {
    function play(){}//实现该方法
    function stop(){}//实现该方法
    function next(){}//实现该方法
    function prev(){}//实现该方法
    function dataIn(){}//实现该方法
    function dataOut(){}//实现该方法
}
$a = new MP3Player();
$a ->play();
