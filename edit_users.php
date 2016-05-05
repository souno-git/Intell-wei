<html lang="en">
<?php
/**
 * Created by PhpStorm.
 * User: shenya
 * Date: 16-4-7
 * Time: 下午5:59
 */
include "head.php";
?>
<?php
session_start(); //启用 session
if($_SESSION['user']and $_SESSION['perm']){ // 检查用户是否登录
}
else{
    header("location: index.php"); // 未登录则定向到主页
}
$user = $_SESSION['user']; //注册用户值
?>
<body>
<div class="container">
    <header>
        <div class="logo" >贵阳学院汽车衡智能称重系统</div>
        <nav class="float-right">
            <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <ul>
                    <li><a href="users.php">返回</a></li>
                    <li><a href="logout.php">退出登录</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <h2 align="center">用户编辑</h2>
    <div class="pure-skin-shenya">
    <table class="pure-table pure-table-bordered">
        <thead>
        <tr>
            <th>账号</th>
            <th>姓名</th>
            <th>密码</th>
            <th>权限</th>
            <th>删除</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($_GET['id']))
        {
            $id = $_GET['id'];
            $_SESSION['id'] = $id;
            $id_exists = true;
            include "connect.inc.php";//连接到数据库
            $query = mysql_query("Select * from users Where user_id='$id'"); // SQL请求
            $count = mysql_num_rows($query);
            if($count > 0) {
                while ($row = mysql_fetch_array($query)) {
                    echo "<tr>";
                    echo '<td align="center">' . $row['user_id'] . "</td>";
                    echo '<td align="center">' . $row['username'] . "</td>";
                    echo '<td align="center">' . $row['password'] . "</td>";
                    echo '<td align="center">' . $row['perm'] . "</td>";
                    echo '<td align="center"> <a href="delete_users.php?id=' . $row['user_id'] . '"> 删除 </a></td>';
                    echo "</tr>";
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $password = $row['password'];
                    $perm = $row['perm'];
                }
            }
            else
            {
                     $id_exists = false;
            }

        }
        ?>
        </tbody>
    </table>
        </div>
    <br>
    <br>
    <form class="pure-form pure-form-aligned" action="editusers.php" method="POST">
        <fieldset>
            <div class="pure-control-group">
                <label for="user_id">账号</label>
                <?php
                echo '<input readonly id="user_id" type="text" value="'.$user_id.'" name="user_id" required="required">';
                ?>
            </div>
            <div class="pure-control-group">
                <label for="username">姓名</label>
                <?php
                echo '<input id="username" type="text" value="'.$username.'" name="username" required="required">';
                ?>
            </div>

            <div class="pure-control-group">
                <label for="password">密 纹</label>
                <?php
                echo '<input id="password" type="password" value="'.$password.'" name="password" required="required">';
                ?>
            </div>
            <div class="pure-control-group">
                <label for="perm">权限码</label>
                <?php
                echo '<input id="perm" type="text" value="'.$perm.'" name="perm" required="required">';
                ?>
            </div>

            <div class="pure-controls">
                <button type="submit" class="pure-button pure-button-primary" type="submit" value="Register">提交</button>
            </div>
        </fieldset>
    </form>
    <?php
    include "footer.php";
    ?>
</div>
</body>
</html>