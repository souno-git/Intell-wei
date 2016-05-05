<html lang="zh">
<?php
/**
 * Created by PhpStorm.
 * User: shenya
 * Date: 16-4-7
 * Time: 下午8:18
 */
include "head.php";
?>
<?php
session_start(); //启用session
if($_SESSION['user']){ // 检查用户是否登陆
}
else{
    header("location: index.php"); // 如果用户未登录则调用主页
}
$user = $_SESSION['user']; //读取用户
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
    <div class="pure-menu pure-menu-open pure-menu-horizontal">
        <ul>
            <h2>     <li><a href="admin.php">称重列表</a></li>
                <li><a href="users.php">用户</a></li>
                <li class="pure-menu-selected"><a href="driver.php">司机</a></li>
                <li><a href="cars.php">车辆</a></li>
            </h2>
        </ul>
    </div>
    <h2 align="center">司机管理</h2>
    <form class="pure-form pure-form-aligned" action="edit_driver.php" method="GET">
        <label for="carnum">输入驾驶证号:</label><br><input type="text" id="id_text" name="id">
        <button type="submit" class="pure-button pure-button-primary">编辑</button>
    </form>
    <nav class="float-right">
        <div class="pure-menu pure-menu-open pure-menu-horizontal">
            <ul>
                <li><a href="down/d_driver.php">导出文件</a></li>
                <li><a href="add_driver.php">添加司机</a></li>
            </ul>
        </div>
    </nav>
    <div class="pure-skin-shenya">
    <table class="pure-table pure-table-bordered pure-table-striped">
        <thead>
        <tr>
            <th>驾驶证号</th>
            <th>车牌号</th>
            <th>姓名</th>
            <th>生日</th>
            <th>驾照类型</th>
            <th>部门</th>
            <th>电话</th>
            <th>编辑</th>
            <th>删除</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include "connect.inc.php";
        $queryitem = mysql_query("Select * from driver");
        while($row = mysql_fetch_array($queryitem))
        {
            echo "<tr>";
            echo '<td align="center">'. $row['driver_id'] . "</td>";
            echo '<td align="center">'. $row['carnum'] . "</td>";
            echo '<td align="center">'. $row['name'] . "</td>";
            echo '<td align="center">'. $row['bday'] . "</td>";
            echo '<td align="center">'. $row['dkind'] . "</td>";
            echo '<td align="center">'. $row['part'] . "</td>";
            echo '<td align="center">'. $row['telnum'] . "</td>";
            echo '<td align="center"> <a href="edit_driver.php?id=' . $row['driver_id'] .'"> 编辑 </a> </td>';
            echo '<td align="center"> <a href="delete_driver.php?id=' . $row['driver_id'] .'"> 删除 </a></td>';
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
        </div>
    <?php
    include "footer.php";
    ?>
</div>
</body>
</html>
