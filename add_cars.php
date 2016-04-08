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
    <h2 align="center">添加车辆</h2>
    <form class="pure-form pure-form-aligned" action="add_cars.php" method="POST">
        <fieldset>
            <div class="pure-control-group">
                <label for="carnum">车牌号</label>
                <input id="carnum" type="text" placeholder="车牌号" name="carnum" required="required">
            </div>

            <div class="pure-control-group">
                <label for="model">车型</label>
                <input id="model" type="text" placeholder="车型" name="model" required="required">
            </div>
            <div class="pure-control-group">
                <label for="photo">照片</label>
                <input id="photo" type="text" placeholder="照片" name="photo" required="required">
            </div>
            <div class="pure-control-group">
                <label for="fload">核定载重</label>
                <input id="fload" type="text" placeholder="核定载重" name="fload" required="required">
            </div>
            <div class="pure-control-group">
                <label for="pdtime">出厂日期</label>
                <input id="pdtime" type="date" placeholder="出厂日期" name="pdtime" required="required">
            </div>
            <div class="pure-control-group">
                <label for="remarks">备注</label>
                <input id="remarks" type="text" placeholder="备注非必须" name="remarks" >
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

<?php
/**
 * Created by PhpStorm.
 * User: shenya
 * Date: 16-4-7
 * Time: 下午4:05
 */
session_start();
if($_SESSION['user']){
}
else{
    header("location:index.php");
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $carnum = $_POST['carnum'];
    $model = $_POST['model'];
    $photo = $_POST['photo'];
    $fload = $_POST['fload'];
    $pdtime = $_POST['pdtime'];
    $remarks = $_POST['remarks'];
    $bool = true;
    require 'connect.inc.php'; //连接到数据库
    $query = mysql_query("Select * from car"); //获取车辆表表
    while($row = mysql_fetch_array($query)) //显示车辆数据
    {
        $table_car = $row['carnum']; //逐行对比完成
        if($carnum == $table_car) // 检测车辆是否存在
        {
            $bool = false; // sets bool to false
            Print '<script>alert("Carnum has been haven!");</script>'; //提示用户存在
            Print '<script>window.location.assign("add_cars.php");</script>'; // 重定向注册页面
        }
    }

    if($bool) // checks if bool is true
    {
        if($remarks=='') {
            $sql = "INSERT INTO car(carnum,model,photo,fload,pdtime,remarks)VALUES('$carnum','$model','$photo','$fload','$pdtime',NULL);";
            //echo $sql;
        }else{
            $sql = "INSERT INTO car(carnum,model,photo,fload,pdtime,remarks)VALUES('$carnum','$model','$photo','$fload','$pdtime',$remarks);";
        }
        mysql_query($sql);//在用户表中写入所有的数据
        Print '<script>alert("Successfully add!");</script>'; // 提示用户
        Print '<script>window.location.assign("cars.php");</script>'; // 重定向到car.php
    }

}
?>