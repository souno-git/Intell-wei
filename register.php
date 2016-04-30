<html>
<?php
include "head.php";
?>
<body>
<div class="container">
    <header>
        <div class="logo" >贵阳学院汽车衡智能称重系统</div>
    </header>
    <h2>注册页面</h2>
    <a href="index.php">返回</a>

    <form class="pure-form pure-form-aligned" action="register.php" method="POST">
        <fieldset>
            <div class="pure-control-group">
                <label for="name">用户名</label>
                <input id="name" type="text" placeholder="Username" name="username" required="required">
            </div>

            <div class="pure-control-group">
                <label for="password">密 纹</label>
                <input id="password" type="password" placeholder="Password" name="password" required="required">
            </div>

            <div class="pure-controls">
                <button type="submit" class="pure-button pure-button-primary" type="submit" value="Register">确定</button>
            </div>
        </fieldset>
    </form>
    <?php
    include "footer.php";
    ?>    </div>
</body>
</html>


<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $bool = true;

    require 'connect.inc.php'; //连接到数据库
    $query = mysql_query("Select * from users"); //获取用户表
    while($row = mysql_fetch_array($query)) //显示用户数据
    {
        $table_users = $row['username']; //逐行对比完成
        if($username == $table_users) // 减产用户是否存在
        {
            $bool = false; // sets bool to false
            Print '<script charset="utf-8">alert("用户名已存在！");</script>'; //提示用户存在
            Print '<script>window.location.assign("register.php");</script>'; // 重定向注册页面
        }
    }

    if($bool) // checks if bool is true
    {
        mysql_query("INSERT INTO users (username, password) VALUES ('$username','$password')"); //在用户表中写入所有的数据
        Print '<script charset="utf-8">alert("注册成功！");</script>'; // 提示用户
        Print '<script>window.location.assign("index.php");</script>'; // 重定向到register.php
    }

}
?>