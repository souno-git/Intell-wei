<?php
session_start(); //启用session
if($_SESSION['user']){
    header("location: admin.php");// 检查用户是否登录
}
else{
}
$user = $_SESSION['user']; //读取用户值
?>
<html lang="en">
<?php
include "head.php";
?>
<body>
<div class="container">
    <header>
        <div class="logo" >贵阳学院汽车衡智能称重系统</div>
        <nav class="float-right">
            <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <ul>
                    <li><a href="dlogin.php">司机登录</a></li>
                    <li><a href="login.php">管理登录</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <h2 align="center">当前统计信息</h2>

    <table class="pure-table pure-table-bordered">
        <thead>
        <tr>
            <th>记录数</th>
            <th>总重量</th>
            <th>司机数</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include "connect.inc.php";
        $count_sql = "SELECT count(*) from manage;";
        $count = mysql_query($count_sql);
        $count_row = mysql_fetch_array($count);
        $sum_sql = "SELECT sum(weight) from manage;";
        $sum = mysql_query($sum_sql);
        $sum_row = mysql_fetch_array($sum);
        $driver_sql = "SELECT count(driver_id) from driver;";
        $driver = mysql_query($driver_sql);
        $driver_row = mysql_fetch_array($driver);
        echo '<td align= "center">'.$count_row[0]."</td>";
        echo '<td align= "center">'.$sum_row[0]."</td>";
        echo '<td align= "center">'.$driver_row[0]."</td>";
        ?>
        </tbody>
    </table>
    <h2 align="center">当前称重信息</h2>
    <table class="pure-table pure-table-bordered">
        <thead>
        <tr>
            <th>管理号</th>
            <th>账号</th>
            <th>车牌号</th>
            <th>类型</th>
            <th>净重</th>
            <th>时间</th>
            <th>备注</th>
        </tr>
        </thead>

        <tbody>
        <?php
        $queryitem = mysql_query("Select * from manage order by manage_id desc");
        while($row = mysql_fetch_array($queryitem))
        {
            echo "<tr>";
            echo '<td align="center">'. $row['manage_id'] . "</td>";
            echo '<td align="center">'. $row['user_id'] . "</td>";
            echo '<td align="center">'. $row['carnum'] . "</td>";
            echo '<td align="center">'. $row['kind'] . "</td>";
            echo '<td align="center">'. $row['weight'] . "</td>";
            echo '<td align="center">'. $row['time'] . "</td>";
            echo '<td align="center">'. $row['remarks'] . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <p align="center"><?php $timestamp = date('Y-m-d G:i:s'); echo $timestamp; ?></p>
<?php
    include "footer.php";
?>
</div>
</body>
</html>
