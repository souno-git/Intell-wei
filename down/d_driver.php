<?php
session_start(); //启用session
if($_SESSION['user']){ //检查用户是否登录
}
else{
    header("location: index.php"); // 未登录则定向到主页
}
$user = $_SESSION['user']; //注册用户信息
?>
<table border="1" class="pure-table pure-table-bordered">
    <thead>
    <tr>
        <th>驾驶证号</th>
        <th>车牌号</th>
        <th>姓名</th>
        <th>照片</th>
        <th>生日</th>
        <th>驾照类型</th>
        <th>部门</th>
        <th>电话</th>
    </tr>
    </thead>
    <tbody>
    <?php
    header("content-type:application/msexcel");
    header("content-disposition:filename=driver.xls");
    include "../connect.inc.php";
    $queryitem = mysql_query("Select * from driver");
    while($row = mysql_fetch_array($queryitem))
    {
        echo "<tr>";
        echo '<td align="center">'. $row['driver_id'] . "</td>";
        echo '<td align="center">'. $row['carnum'] . "</td>";
        echo '<td align="center">'. $row['name'] . "</td>";
        echo '<td align="center">'. $row['photo'] . "</td>";
        echo '<td align="center">'. $row['bday'] . "</td>";
        echo '<td align="center">'. $row['dkind'] . "</td>";
        echo '<td align="center">'. $row['part'] . "</td>";
        echo '<td align="center">'. $row['telnum'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
