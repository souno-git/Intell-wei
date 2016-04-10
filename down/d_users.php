<?php
session_start(); //启用session
if($_SESSION['user']){ // 检查用户是否登录
}
else{
    header("location: index.php"); // 未登录则定向到主页
}
$user = $_SESSION['user']; //注册用户值
?>
<table class="pure-table pure-table-bordered">
    <thead>
    <tr>
        <th>账号</th>
        <th>姓名</th>
        <th>密码</th>
        <th>权限</th>
    </tr>
    </thead>
    <tbody>
    <?php
    header("content-type:application/msexcel");
    header("content-disposition:filename=users.xls");
    include "../connect.inc.php";
    $queryitem = mysql_query("Select * from users");
    while($row = mysql_fetch_array($queryitem))
    {
        echo "<tr>";
        echo '<td align="center">'. $row['user_id'] . "</td>";
        echo '<td align="center">'. $row['username'] . "</td>";
        echo '<td align="center">'. $row['password'] . "</td>";
        echo '<td align="center">'. $row['perm'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
