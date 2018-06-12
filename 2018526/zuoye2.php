<?php
include ("conn.php");
mysql_query("set names gb2312");
if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $sql3 = "delete from yonghubiao where id = $id";
    $result = mysql_query($sql3);
    if($result == false){
        echo "删除数据失败";
    }else{
        echo "删除数据成功";
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
        echo "SQL语句执行错误。";
    }

}

?>



<html><head><title></title></head>
<body>
<table border="1" >
    <caption>添加数据</caption>
    <form method="post" name="form1" action="">
        <tr>
            <td>
                 用户名：</td>
            <td>
                <input type="text" name="user" >
            </td>
        </tr>
        <tr>
            <td>密码：</td>
            <td>
                 <input type="password" name="pwd">
            </td>
        </tr>
        <tr>
            <td>年龄：</td>
            <td>
                <input type="text" name="age">
            </td>
        </tr>
        <tr>
            <td>学历：</td>
            <td>
                <select name="education">
                    <option  value="1">初中</option>
                    <option  value="2">高中</option>
                    <option  value="3">大专</option>
                    <option  value="4">本科</option>
                    <option  value="5">硕士</option>
                    <option  value="6">博士</option>
                 </select>
            </td>
        </tr>
        <tr>
        <td>兴趣</td>
            <td>
                <input type="checkbox" name="interest[]" value="1">排球
                <input type="checkbox" name="interest[]" value="2">篮球
                <input type="checkbox" name="interest[]" value="4">足球
                <input type="checkbox" name="interest[]" value="8">中国足球
                <input type="checkbox" name="interest[]" value="16">地球
        </tr>
        <tr>
            <td>来自：</td>
            <td>
                <input type="radio" name="fr" value="1">东北
                <input type="radio" name="fr" value="2">华北
                <input type="radio" name="fr" value="3">西北
                <input type="radio" name="fr" value="4">华东
                <input type="radio" name="fr" value="5">华南
                <input type="radio" name="fr" value="6">华西
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
        <th>用户名</th>
        <th>年龄</th>
        <th>学历</th>
        <th>兴趣</th>
        <th>来自</th>
        <th>注册时间</th>
        <th>删除</th>
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
            <td><a href="zuoye_youhua.php?id= <?php echo $result['id'] ?>" onclick="return queren()">删除</a></td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
<script>
    function queren() {
        var s1 = windows.confirm("你真的确认删除嘛？")
        if (s1 === ture){
            return true;
        }else{
            return false;
        }
    }
</script>