<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/31
 * Time: 14:33
 */
class Teacher {
    public $name;
    public $age;
    public $from;
    public function ZiWoJeShao(){
        echo "�ҽ�{$this->name}����{$this->age}������{$this->from}";
    }
    function __construct($n,$a,$f)
    {
        $this->name = $n;
        $this->age = $a;
        $this->from = $f;
    }
    function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo "<br />��ʦ�ɹ�";
    }
}
$o1 = new Teacher('̷����',25,'����');
$o1->ZiWoJeShao();



class Students{
    const School = '����';
    public $name;
    public $sex;
    public $age;
    static $con = 0;
    function __construct($n,$s,$a)
    {
        $this->name = $n;
        $this->sex = $s;
        $this->age = $a;
        self::$con++;
        echo "<br />{$this->name}����" . Students::School . "����ǰ��" . Students::$con . "��ѧ��";
    }
    public function JieShao(){
        echo "<br />�ҽ�{$this->name}����{$this->age}���Ա�{$this->sex}";

    }
    function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo "<br />{$this->name}����ɹ�";
    }
}
$o2 = new Students('̷����',��,25);
$o2->JieShao();
$o3= new Students('̷����',��,25);
$o3->JieShao();

