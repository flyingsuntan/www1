<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/2
 * Time: 12:01
 */
//������
abstract  class Guai {
    protected $blood = 100;
    abstract protected function Attach();
}
//�߹�
class Snake extends Guai{
    protected function Attach(){
        echo "<br />���Ŀ������˹���Ȼ��Ѹ��ҧһ�ڣ�";
        $this->blood--; //�����Ѫ1��
    }
}
//����
class Tiger extends Guai{
    protected function Attach(){
        echo "<br />������ҧ���˹�";
        $this->blood--; //�����Ѫ1��
    }
}