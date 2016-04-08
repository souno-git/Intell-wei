<html lang="zh">
<?php
/**
 * Created by PhpStorm.
 * User: shenya
 * Date: 16-4-7
 * Time: 下午3:25
 */
include "head.php";
?>
<?php
session_start(); //starts the session
if($_SESSION['user']){ // checks if the user is logged in
}
else{
    header("location: index.php"); // redirects if user is not logged in
}
$user = $_SESSION['user']; //assigns user value
require "connect.inc.php";
$user_query=mysql_query("SELECT user_id FROM users") or die ("Error Occurred");
$car_query=mysql_query("SELECT carnum FROM car") or die ("Error Occurred");
?>
<body>
<div class="container">
    <header>
        <div class="logo" >贵阳学院汽车衡智能称重系统</div>
        <nav class="float-right">
            <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <ul>
                    <li><a href="home.php">返回</a></li>
                    <li><a href="logout.php">退出登录</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <h2 align="center">添加管理记录</h2>
    <form class="pure-form pure-form-aligned" action="addmanage.php" method="POST">
        <fieldset>
            <div class="pure-control-group">
                <label for="user_id">账号</label>
                <select name = "user_id">
                 <?php
                    while ($row=mysql_fetch_array($user_query)) {
                        $cdTitle=$row["user_id"];
                        echo "<option value='$cdTitle'> $cdTitle </option>";
                    }
                  ?>
                    <option value=''>  </option>
                </select>
            </div>
            <div class="pure-control-group">
                <label for="carnum">车牌号</label>
                <select name = "carnum">
                    <?php
                    while ($row=mysql_fetch_array($car_query)) {
                        $cdTitle=$row["carnum"];
                        echo "<option value='$cdTitle'> $cdTitle </option>";
                    }
                    ?>
                    <option value=''>  </option>
                </select>
            </div>
            <div class="pure-control-group">
                <label for="kind">类型</label>
                <input id="kind" type="text" placeholder="Kind" name="kind" required="required">
            </div>
            <div class="pure-control-group">
                <label for="weight">净重</label>
                <input id="weight" type="text" placeholder="Weight" name="weight" required="required">
            </div>
            <div class="pure-control-group">
                <label for="time">时间</label>
                <input readonly type="datetime"  name="time" value="<?php $timestamp = date('Y-m-d G:i:s'); echo $timestamp; ?>"/>
            </div>
            <div class="pure-control-group">
                <label for="remarks">备注</label>
                <input id="remarks" type="text" placeholder="Remarks" name="remarks">
            </div>
            <div class="pure-controls">
                <button type="submit" class="pure-button pure-button-primary">提交</button>
            </div>
        </fieldset>
    </form>
<?php
include "footer.php";
?>
</div>
</body>
</html>



