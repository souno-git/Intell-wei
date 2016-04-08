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
            <h2>     <li><a href="home.php">称重列表</a></li>
                <li class="pure-menu-selected"><a href="users.php">用户</a></li>
                <li><a href="driver.php">司机</a></li>
                <li><a href="cars.php">车辆</a></li>
            </h2>
        </ul>
    </div>
    <h2 align="center">用户管理</h2>
    <nav class="float-right">
        <div class="pure-menu pure-menu-open pure-menu-horizontal">
            <ul>
                <li><a href="add_users.php">添加用户</a></li>
            </ul>
        </div>
    </nav>
    <table class="pure-table pure-table-bordered">
        <thead>
        <tr>
            <th>账号</th>
            <th>用户名</th>
            <th>密码</th>
            <th>权限</th>
            <th>编辑</th>
            <th>删除</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include "connect.inc.php";
        $queryitem = mysql_query("Select * from users");
        while($row = mysql_fetch_array($queryitem))
        {
            echo "<tr>";
            echo '<td align="center">'. $row['user_id'] . "</td>";
            echo '<td align="center">'. $row['username'] . "</td>";
            echo '<td align="center">'. $row['password'] . "</td>";
            echo '<td align="center">'. $row['perm'] . "</td>";
            echo '<td align="center"> <a href="edit_users.php?id='. $row['user_id'] .'"> 编辑 </a> </td>';
            echo '<td align="center"> <a href="delete_users.php?id='. $row['user_id'] .'"> 删除 </a></td>';
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <?php
    include "footer.php";
    ?>
</div>
</body>
</html>
