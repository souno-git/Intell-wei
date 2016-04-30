<?php
/**
 * Created by PhpStorm.
 * User: shenya
 * Date: 16-4-7
 * Time: 下午6:58
 */
session_start();
if($_SESSION['user']){
}
else{
    header("location:index.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST") //如果页面被调用则添加！
{
    include 'connect.inc.php';
    $carnum = mysql_real_escape_string($_POST['carnum']);
    $model = mysql_real_escape_string($_POST['model']);
    $fload = mysql_real_escape_string($_POST['fload']);
    $pdtime = mysql_real_escape_string($_POST['pdtime']);
    $remarks = mysql_real_escape_string($_POST['remarks']);
    $sql = "UPDATE car SET model = '$model',fload = '$fload',pdtime = '$pdtime',remarks = '$remarks'
            WHERE car.carnum = '$carnum'";
    echo $sql;
    $result = mysql_query($sql);
    if($result){
        //echo("succeded");
        header("location: cars.php");
    }
    else{
        die(mysql_error());
        Print '<script charset="utf-8">alert("修改错误！");</script>'; //提示用户
        //Print '<script>window.location.assign("admin.php");</script>';
    }
    //header("location: admin.php");*/

}

?>