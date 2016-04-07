<?php
session_start(); //启用session
if($_SESSION['user']){
    header("location: home.php");// 检查用户是否登录
}
else{
    header("location: login.php"); // 未登录则返回主页
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
                    <li><a href="login.php">登录</a></li>
                    <li><a href="register.php">注册</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <?php
    echo "<p>Dieling.cc</p>";
    ?>
<?php
    include "footer.php";
?>
</div>
</body>
</html>
