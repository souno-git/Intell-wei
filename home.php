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
    <h2 align="center">您的信息</h2>
    <table class="pure-table pure-table-bordered">
        <thead>
        <tr>
            <th>驾驶证号</th>
            <th>车牌号</th>
            <th>姓名</th>
            <th>生日</th>
            <th>驾照类型</th>
            <th>部门</th>
            <th>电话</th>
            <th>修改</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($duser)) {
            $id = $duser;
            $_SESSION['id'] = $id;
            $id_exists = true;
            include "connect.inc.php";//连接到数据库
            $query = mysql_query("Select * from driver Where driver_id='$id'"); // SQL请求
            $count = mysql_num_rows($query);
            if ($count > 0) {
                while ($row = mysql_fetch_array($query)) {
                    echo "<tr>";
                    echo '<td align="center">' . $row['driver_id'] . "</td>";
                    echo '<td align="center">' . $row['carnum'] . "</td>";
                    echo '<td align="center">' . $row['name'] . "</td>";
                    echo '<td align="center">' . $row['bday'] . "</td>";
                    echo '<td align="center">' . $row['dkind'] . "</td>";
                    echo '<td align="center">' . $row['part'] . "</td>";
                    echo '<td align="center">' . $row['telnum'] . "</td>";
                    echo '<td align="center"> <a href="edit_home.php?id=' . $row['driver_id'] . '"> 修改 </a></td>';
                    echo "</tr>";
                    $dcarnum = $row['carnum'];

                }
            }
        }
        ?>
        </tbody>
    </table>
    <br>
    <h2 align="center">关联车辆</h2>

    <table class="pure-table pure-table-bordered">
        <thead>
        <tr>
            <th>车牌号</th>
            <th>车型</th>
            <th>自重</th>
            <th>生产日期</th>
        </tr>
        </thead>
        <tbody>
<?php
if(!empty($dcarnum)) {
    $id = $dcarnum;
    $id_exists = true;
    include "connect.inc.php";//连接到数据库
    $query = mysql_query("Select * from car Where carnum='$id'"); // SQL请求
    $count = mysql_num_rows($query);
    if ($count > 0) {
        while ($row = mysql_fetch_array($query)) {
            echo "<tr>";
            echo '<td align="center">' . $row['carnum'] . "</td>";
            echo '<td align="center">' . $row['model'] . "</td>";;
            echo '<td align="center">' . $row['fload'] . "</td>";
            echo '<td align="center">' . $row['pdtime'] . "</td>";
            echo "</tr>";
        }
    }
}
?>
        </tbody>

        </table>



    <br>
    <h2 align="center">记录列表</h2>
    <nav class="float-right">
        <div class="pure-menu pure-menu-open pure-menu-horizontal">
            <ul>
                <li><a href="down/d_home.php?id=">导出文件</a></li>
            </ul>
        </div>
    </nav>
    <table class="pure-table pure-table-bordered">
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
        $queryitem = mysql_query("Select * from manage Where carnum='$dcarnum' order by manage_id desc");
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