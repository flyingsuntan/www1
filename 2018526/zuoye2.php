<?php
include ("conn.php");
mysql_query("set names gb2312");
if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $sql3 = "delete from yonghubiao where id = $id";
    $result = mysql_query($sql3);
    if($result == false){
        echo "ɾ������ʧ��";
    }else{
        echo "ɾ�����ݳɹ�";
    }
}
if(isset($_POST["ac"]) && $_POST["ac"] == "tijiao" ){
    $user = $_POST["user"];
    $pwd = $_POST["pwd"];
    $age = $_POST["age"];
    $education = $_POST["education"];
    $aihao = $_POST["interest"];
    $interest = array_sum($aihao);

    $fr = $_POST["fr"];
    $sql = "insert into yonghubiao (username,pwd,age,Education,Interest,fr,addate) values ('$user',md5('$pwd'),$age,'$education','$interest','$fr',now())";
    $zx = mysql_query($sql);
    if ($zx == false){
        echo "SQL���ִ�д���";
    }

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
                    <option  value="1">����</option>
                    <option  value="2">����</option>
                    <option  value="3">��ר</option>
                    <option  value="4">����</option>
                    <option  value="5">˶ʿ</option>
                    <option  value="6">��ʿ</option>
                 </select>
            </td>
        </tr>
        <tr>
        <td>��Ȥ</td>
            <td>
                <input type="checkbox" name="interest[]" value="1">����
                <input type="checkbox" name="interest[]" value="2">����
                <input type="checkbox" name="interest[]" value="4">����
                <input type="checkbox" name="interest[]" value="8">�й�����
                <input type="checkbox" name="interest[]" value="16">����
        </tr>
        <tr>
            <td>���ԣ�</td>
            <td>
                <input type="radio" name="fr" value="1">����
                <input type="radio" name="fr" value="2">����
                <input type="radio" name="fr" value="3">����
                <input type="radio" name="fr" value="4">����
                <input type="radio" name="fr" value="5">����
                <input type="radio" name="fr" value="6">����
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
    $sql1 = "select count(*) from yonghubiao";
    $sql2 = "select * from yonghubiao";
    $len = mysql_query($sql1);
    $result1 = mysql_query($sql2);
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
    <?php while($result = mysql_fetch_array($result1)){
        ?>
        <tr>
            <td><?php echo $result['id'] ?></td>
            <td><?php echo $result['username'] ?></td>
            <td><?php echo $result['age'] ?></td>
            <td><?php echo $result['Education'] ?></td>
            <td><?php echo $result['Interest'] ?></td>
            <td><?php echo $result['fr'] ?></td>
            <td><?php echo $result['addate'] ?></td>
            <td><a href="zuoye_youhua.php?id= <?php echo $result['id'] ?>" onclick="return queren()">ɾ��</a></td>
        </tr>
    <?php } ?>
</table>

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