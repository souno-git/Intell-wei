<html lang="zh">
<?php
/**
 * Created by PhpStorm.
 * User: shenya
 * Date: 16-4-7
 * Time: 下午8:57
 */
include "head.php";
session_start(); //启用session
if($_SESSION['user']){ // 检查用户是否登录
}
else{
    header("location: index.php"); // 未登录则定向到主页
}
$user = $_SESSION['user']; //注册用户值
require "connect.inc.php";
$carnum_query=mysql_query("SELECT carnum FROM car") or die ("Error Occurred");
?>
<body>
<div class="container">
    <header>
        <div class="logo" >贵阳学院汽车衡智能称重系统</div>
        <nav class="float-right">
            <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <ul>
                    <li><a href="driver.php">返回</a></li>
                    <li><a href="logout.php">退出登录</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <h2 align="center">添加司机</h2>

    <form class="pure-form pure-form-aligned" action="add_driver.php" method="POST">
        <fieldset>
            <div class="pure-control-group">
                <label for="driver_id">驾驶证号</label>
                <input id="driver_id" type="text" placeholder="驾驶证号" name="driver_id" required="required">
            </div>

            <div class="pure-control-group">
                <label for="dpassword">密码</label>
                <input id="dpassword" type="password" placeholder="密码" name="dpassword" required="required">
            </div>
            <div class="pure-control-group">
            <label for="carnum">车牌号</label>
            <select name = "carnum" required="required">
                <?php
                while ($row=mysql_fetch_array($carnum_query)) {
                    $cdTitle=$row["carnum"];
                    echo "<option value='$cdTitle'> $cdTitle </option>";
                }
                ?>
            </select>
            </div>
            <div class="pure-control-group">
                <label for="name">姓名</label>
                <input id="name" type="text" placeholder="姓名" name="name" required="required">
            </div>
            <div class="pure-control-group">
                <label for="photo">照片</label>
                <input id="photo" type="text" placeholder="请输入图片服务器地址" name="photo" required="required">
            </div>
            <div class="pure-control-group">
                <label for="bday">出生日期</label>
                <input id="bday" type="date" placeholder="出生日期" name="bday" required="required">
            </div>
            <div class="pure-control-group">
                <label for="part">部门</label>
                <input id="part" type="text" placeholder="部门" name="part" required="required">
            </div>
            <div class="pure-control-group">
                <label for="dkind">驾照类型</label>
                <input id="dkind" type="text" placeholder="驾照类型" name="dkind" required="required">
            </div>
            <div class="pure-control-group">
                <label for="telnum">电话号码</label>
                <input id="telnum" type="text" placeholder="电话号码" name="telnum" required="required">
            </div>

            <div class="pure-controls">
                <button type="submit" class="pure-button pure-button-primary" type="submit" value="Register">提交</button>
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
    $driver_id = $_POST['driver_id'];
    $dpassword = $_POST['dpassword'];
    $carnum = $_POST['carnum'];
    $name = $_POST['name'];
    $photo = $_POST['photo'];
    $bday = $_POST['bday'];
    $dkind = $_POST['dkind'];
    $part = $_POST['part'];
    $telnum = $_POST['telnum'];
    $bool = true;

    require 'connect.inc.php'; //连接到数据库
    $query = mysql_query("Select * from driver"); //获取用户表
    while($row = mysql_fetch_array($query)) //显示用户数据
    {
        $table_users = $row['driver_id']; //逐行对比完成
        if($driver_id == $table_users) // 检测用户是否存在
        {
            $bool = false; // sets bool to false
            Print '<script>alert("Driver has been haven!");</script>'; //提示用户存在
            Print '<script>window.location.assign("add_driver.php");</script>'; // 重定向注册页面
        }
    }

    if($bool) // checks if bool is true
    {
        $sql = "INSERT INTO driver (driver_id,dpassword,carnum,name,photo,bday,dkind,part,telnum) VALUES ('$driver_id','$dpassword','$carnum','$name','$photo','$bday','$dkind','$part','$telnum');";
        //echo $sql;
        mysql_query($sql); //在用户表中写入所有的数据
        Print '<script>alert("Successfully add!");</script>'; // 提示用户
        Print '<script>window.location.assign("driver.php");</script>'; // 重定向到register.php
    }

}
?>