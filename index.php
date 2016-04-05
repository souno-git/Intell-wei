<?php
session_start(); //starts the session
if($_SESSION['user']){
    header("location: home.php");// checks if the user is logged in
}
else{
    header("location: login.php"); // redirects if user is not logged in
}
$user = $_SESSION['user']; //assigns user value
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
