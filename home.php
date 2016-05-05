<html lang="zh">
<?php
include "head.php";
?>
<?php
session_start(); //启用session
if($_SESSION['duser']){ // 检查用户是否登陆
}
else{
    header("location: index.php"); // 如果用户未登录则调用主页
}
$duser = $_SESSION['duser']; //读取用户
?>
<body>
<div class="container">
    <header>
        <div class="logo" >贵阳学院汽车衡智能称重系统</div>
        <nav class="float-right">
            <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <ul>
                    <li><a href="logout.php">退出登录</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <br>
    <h2 align="center">司机主页</h2>
    <div class="pure-skin-shenya">
    <table class="pure-table pure-table-bordered">
        <thead>
        <tr>
            <th align="center">照片</th>
            <th align="center" colspan="4">信息</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($duser)) {
        $id = $duser;
        $_SESSION['id'] = $id;
        $id_exists = true;
        include "connect.inc.php";//连接到数据库
          $driver_query = mysql_query("Select * from driver Where driver_id='$id'"); // SQL请求
          $count = mysql_num_rows($driver_query);
          if ($count > 0) {
             while ($row = mysql_fetch_array($driver_query)) {
                echo "<tr>";
                echo '<td rowspan="6" align="center">' . '<p align="center"><img height="175" width="130" src="img/' . $row['photo'] . '"/></p>' . '</td>';
                echo '<td>驾驶证号</td><td align="center">' . $row['driver_id'] . "</td>";
                echo '<td>车牌号</td><td align="center">' . $row['carnum'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo '<td>姓名</td><td align="center">' . $row['name'] . "</td>";
                echo '<td>生日</td><td align="center">' . $row['bday'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo '<td>驾照类型</td><td align="center">' . $row['dkind'] . "</td>";
                echo '<td>部门</td><td align="center">' . $row['part'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo '<td>电话</td><td align="center">' . $row['telnum'] . "</td>";
                $car_id = $row['carnum'];
            }

        }
        $car_query = mysql_query("Select * from car Where carnum='$car_id'");
        $count = mysql_num_rows($car_query);
        if ($count > 0) {
            while ($row = mysql_fetch_array($car_query)) {
                echo '<td > 车型</td ><td align="center">' . $row['model'] . "</td>";;
                echo "</tr>";
                echo "<tr>";
                echo '<td>车辆自重</td><td align="center">' . $row['fload'] . "</td>";
                echo '<td>出厂日期</td><td align="center">' . $row['pdtime'] . "</td>";
                echo "</tr>";
                }
        }
            echo '<th align="center" colspan="4"> <a href="edit_home.php?id=' . $row['driver_id'] . '"> 修改 </a></th>';
        }
        ?>
    </table>
    </div>
    <br>
    <h2 align="center">称重记录</h2>
    <nav class="float-right">
        <div class="pure-menu pure-menu-open pure-menu-horizontal">
            <ul>
                <li><a href="down/d_home.php?id=">导出文件</a></li>
            </ul>
        </div>
    </nav>
    <div class="pure-skin-shenya">
    <table class="pure-table pure-table-bordered pure-table-striped">
        <thead>
        <tr>
            <th>记录号</th>
            <th>管理账号</th>
            <th>车牌号</th>
            <th>类型</th>
            <th>净重</th>
            <th>时间</th>
            <th>备注</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $queryitem = mysql_query("Select * from manage Where carnum='$car_id' order by manage_id desc");
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
        </div>
    <p align="center"><?php $timestamp = date('Y-m-d G:i:s'); echo $timestamp; ?></p>
    <?php
    include "footer.php";
    ?>
</div>
</body>
</html>