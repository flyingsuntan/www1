<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/2
 * Time: 13:33
 */
class A{
    //����һ�����ԣ����������ͼ�洢���ɸ������ڵ���������
    protected $prop_list = array();
    //�����������A�ö���ʹ��һ�������ڵ����Խ��и�ֵʱ�Զ�����
    function __set($name, $value)
    {
        // TODO: Implement __set() method.
        //echo "������ʹ�ò����ڵ�����.....";
        $this->prop_list[$name] = $value;
    }
    function __get($name)
    {
        if (isset($this->prop_list[$name])){
            return $this->prop_list[$name];
        }else {
            return "�����Բ�����";
        }
        // TODO: Implement __get() method.
    }


    function __isset($name)
    {
        // TODO: Implement __isset() method.
        $v1 = isset($this->prop_list[$name]);
        return$v1;
    }
    function __unset($name)
    {
        // TODO: Implement __unset() method.
        unset($this->prop_list[$name]);//������ʵ��ȥ�������е������б�������ĳ����Ԫ
    }
}
$a1 = new A();
$a1->p1 = 1;
$a1->h2 = 2;
$a1->abc = '����';
echo "<br />Ȼ�������Щ�����ڵ����Ե�ֵ";
echo "<br />a1->p1:" . $a1->p1;
echo "<br />a1->h2:" . $a1->h2;
echo "<br />a1->abc:" . $a1->abc;
echo "<br />a1->abcddd:" . $a1->abcddd;//�����Ȼ������
//������ʾisset�ж�һ�������ڵ�����
$v1 = isset($a1->p1);//����
$v2 = isset($a1->ppp1);//������
echo "<hr />";
var_dump($v1);
echo "<br />";
var_dump($v2);
//������ʾ����һ�������ڵ�����
echo "<hr />";
unset($a1->h2);
echo "<br />a1->h2:" . $a1->h2;
