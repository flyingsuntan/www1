<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 11:20
 */

require_once 'MySQLDB.class.php';
$config = array(
    db_host => '127.0.0.1',
    db_port => '3306',
    db_user =>'root',
    db_pwd => '',
    bm => 'gb2312',
    databas => 'ceshi'
);
$db1 = MySQLDB::GetInstance($config);
mysql_query("set names gb2312");
if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $sql3 = "delete from yonghubiao where id = $id";
    $db1->exec($sql3);
    echo "ɾ���ɹ�";
}
if(isset($_POST["ac"]) && $_POST["ac"] == "tijiao" ){
    $user = $_POST["user"];
    $pwd = $_POST["pwd"];
    $age = $_POST["age"];
    $education = $_POST["education"];
    $aihao = $_POST["interest"];
    $interest = "";
    for($i = 0; $i < count($aihao); ++$i){
        if($i == count($aihao)-1){//���һ���Ҫ�Ӷ���
            $interest .= $aihao[$i];
        }
        else{
            $interest .= $aihao[$i] . ",";
        }
    }
    //$interest = implode(',',$aihao);
    $fr = $_POST["fr"];
    $sql = "insert into yonghubiao (username,pwd,age,Education,Interest,fr,addate) values ('$user',md5('$pwd'),$age,'$education','$interest','$fr',now())";
   /*
   $zx = mysql_query($sql);
    if ($zx == false){
        echo "SQL���ִ�д���";
    }
   */

   $db1->exec($sql);

}

?>



<html><head><title></title></head>
<body>
<table border="1" >
    <caption>�������</caption>
    <form method="post" name="form1" action="">
        <tr>
            <td>
                 �û�����</td>
            <td>
                <input type="text" name="user" >
            </td>
        </tr>
        <tr>
            <td>���룺</td>
            <td>
                 <input type="password" name="pwd">
            </td>
        </tr>
        <tr>
            <td>���䣺</td>
            <td>
                <input type="text" name="age">
            </td>
        </tr>
        <tr>
            <td>ѧ����</td>
            <td>
                <select name="education">
                    <option  value="����">����</option>
                    <option  value="����">����</option>
                    <option  value="��ר">��ר</option>
                    <option  value="����">����</option>
                    <option  value="˶ʿ">˶ʿ</option>
                    <option  value="��ʿ">��ʿ</option>
                 </select>
            </td>
        </tr>
        <tr>
        <td>��Ȥ</td>
            <td>
                <input type="checkbox" name="interest[]" value="����">����
                <input type="checkbox" name="interest[]" value="����">����
                <input type="checkbox" name="interest[]" value="����">����
                <input type="checkbox" name="interest[]" value="�й�����">�й�����
                <input type="checkbox" name="interest[]" value="����">����
        </tr>
        <tr>
            <td>���ԣ�</td>
            <td>
                <input type="radio" name="fr" value="����">����
                <input type="radio" name="fr" value="����">����
                <input type="radio" name="fr" value="����">����
                <input type="radio" name="fr" value="����">����
                <input type="radio" name="fr" value="����">����
                <input type="radio" name="fr" value="����">����
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="submit" value="OK" style="width: 100%">
                <input type="hidden" name="ac" value="tijiao">
            </td>
        </tr>
</form>
</table>
<?php
    $sql2 = "select * from yonghubiao";
    $result1 = $db1->GetRows($sql2);
?>
<table border="1">
    <tr>
        <th>�û���</th>
        <th>����</th>
        <th>ѧ��</th>
        <th>��Ȥ</th>
        <th>����</th>
        <th>ע��ʱ��</th>
        <th>ɾ��</th>
    </tr>
    <?php foreach ($result1 as $key => $rec){
        ?>
        <tr>
            <td><?php echo $rec['id'] ?></td>
            <td><?php echo $rec['username'] ?></td>
            <td><?php echo $rec['age'] ?></td>
            <td><?php echo $rec['Education'] ?></td>
            <td><?php echo $rec['Interest'] ?></td>
            <td><?php echo $rec['fr'] ?></td>
            <td><?php echo $rec['addate'] ?></td>
            <td><a href="?id= <?php echo $rec['id'] ?>" onclick="return queren()">ɾ��</a></td>
        </tr>
    <?php } ?>
</table>
<?php
$user_count = $db1->GetOneData("select count(*) as c from yonghubiao");
?>
��ǰ�û�����Ϊ��<?php echo $user_count ; ?>
</body>
</html>
<script>
    function queren() {
        var s1 = windows.confirm("�����ȷ��ɾ���")
        if (s1 === ture){
            return true;
        }else{
            return false;
        }
    }
</script>
