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
    echo "删除成功";
}
if(isset($_POST["ac"]) && $_POST["ac"] == "tijiao" ){
    $user = $_POST["user"];
    $pwd = $_POST["pwd"];
    $age = $_POST["age"];
    $education = $_POST["education"];
    $aihao = $_POST["interest"];
    $interest = "";
    for($i = 0; $i < count($aihao); ++$i){
        if($i == count($aihao)-1){//最后一项，不要加逗号
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
        echo "SQL语句执行错误。";
    }
   */

   $db1->exec($sql);

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
                    <option  value="初中">初中</option>
                    <option  value="高中">高中</option>
                    <option  value="大专">大专</option>
                    <option  value="本科">本科</option>
                    <option  value="硕士">硕士</option>
                    <option  value="博士">博士</option>
                 </select>
            </td>
        </tr>
        <tr>
        <td>兴趣</td>
            <td>
                <input type="checkbox" name="interest[]" value="排球">排球
                <input type="checkbox" name="interest[]" value="篮球">篮球
                <input type="checkbox" name="interest[]" value="足球">足球
                <input type="checkbox" name="interest[]" value="中国足球">中国足球
                <input type="checkbox" name="interest[]" value="地球">地球
        </tr>
        <tr>
            <td>来自：</td>
            <td>
                <input type="radio" name="fr" value="东北">东北
                <input type="radio" name="fr" value="华北">华北
                <input type="radio" name="fr" value="西北">西北
                <input type="radio" name="fr" value="华东">华东
                <input type="radio" name="fr" value="华南">华南
                <input type="radio" name="fr" value="华西">华西
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
        <th>用户名</th>
        <th>年龄</th>
        <th>学历</th>
        <th>兴趣</th>
        <th>来自</th>
        <th>注册时间</th>
        <th>删除</th>
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
            <td><a href="?id= <?php echo $rec['id'] ?>" onclick="return queren()">删除</a></td>
        </tr>
    <?php } ?>
</table>
<?php
$user_count = $db1->GetOneData("select count(*) as c from yonghubiao");
?>
当前用户总数为：<?php echo $user_count ; ?>
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
