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
session_start(); //starts the session
if($_SESSION['user']){ // checks if the user is logged in
}
else{
    header("location: index.php"); // redirects if user is not logged in
}
$user = $_SESSION['user']; //assigns user value
?>
<body>
<div class="container">
    <header>
        <div class="logo" >贵阳学院汽车衡智能称重系统</div>
        <nav class="float-right">
            <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <ul>
                    <li><a href="cars.php">返回</a></li>
                    <li><a href="logout.php">退出登录</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <h2 align="center">车辆编辑</h2>
    <table class="pure-table pure-table-bordered">
        <thead>
        <tr>
            <th>车牌号</th>
            <th>车型</th>
            <th>照片</th>
            <th>核定载重</th>
            <th>生产日期</th>
            <th>备注</th>
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
    $query = mysql_query("Select * from car Where carnum='$id'"); // SQL请求
    $count = mysql_num_rows($query);
    if($count > 0) {
        while ($row = mysql_fetch_array($query)) {
            echo "<tr>";
            echo '<td align="center">'. $row['carnum'] . "</td>";
            echo '<td align="center">'. $row['model'] . "</td>";
            echo '<td align="center">'. $row['photo'] . "</td>";
            echo '<td align="center">'. $row['fload'] . "</td>";
            echo '<td align="center">'. $row['pdtime'] . "</td>";
            echo '<td align="center">'. $row['remarks'] . "</td>";
            echo '<td align="center"> <a href="delete_cars.php?id=' . $row['carnum'] . '"> 删除 </a></td>';
            echo "</tr>";
            $carnum = $row['carnum'];
            $model = $row['model'];
            $photo = $row['photo'];
            $fload = $row['fload'];
            $pdtime = $row['pdtime'];
            $remarks = $row['remarks'];
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
    <br>
    <br>
    <form class="pure-form pure-form-aligned" action="editcars.php" method="POST">
        <fieldset>
            <div class="pure-control-group">
                <label for="carnum">车牌号</label>
                <?php
                echo '<input readonly id="carnum" type="text" value="'.$carnum.'" name="carnum" required="required">';
                ?>
            </div>
            <div class="pure-control-group">
                <label for="model">车型</label>
                <?php
                echo '<input id="model" type="text" value="'.$model.'" name="model" required="required">';
                ?>
            </div>

            <div class="pure-control-group">
                <label for="photo">照片</label>
                <?php
                echo '<input id="photo" type="text" value="'.$photo.'" name="photo" required="required">';
                ?>
            </div>
            <div class="pure-control-group">
                <label for="fload">核定载重</label>
                <?php
                echo '<input id="fload" type="text" value="'.$fload.'" name="fload" required="required">';
                ?>
            </div>
            <div class="pure-control-group">
                <label for="pdtime">出厂日期</label>
                <?php
                echo '<input id="pdtime" type="date" value="'.$pdtime.'" name="pdtime" required="required">';
                ?>
            </div>
            <div class="pure-control-group">
                <label for="remarks">备注</label>
                <?php
                echo '<input id="remarks" type="text" value="'.$remarks.'" name="remarks">';
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

