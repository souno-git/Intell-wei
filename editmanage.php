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
    $manage_id = mysql_real_escape_string($_POST['manage_id']);
    $user_id = mysql_real_escape_string($_POST['user_id']);
    $carnum = mysql_real_escape_string($_POST['carnum']);
    $kind = mysql_real_escape_string($_POST['kind']);
    $weight = mysql_real_escape_string($_POST['weight']);
    $time = mysql_real_escape_string($_POST['time']);
    $remarks = mysql_real_escape_string($_POST['remarks']);
    if($remarks==''){
        $sql = "UPDATE manage SET user_id = '$user_id',carnum = '$carnum',kind = '$kind',
            remarks = NULL,weight = '$weight',time = '$time' WHERE manage.manage_id = '$manage_id'";
    }
    else{
        $sql = "UPDATE manage SET user_id = '$user_id',carnum = '$carnum',kind = '$kind',
            remarks = '$remarks',weight = '$weight',time = '$time' WHERE manage.manage_id = '$manage_id'";
    }
    echo $sql;
    $result = mysql_query($sql);
    if($result){
        //echo("succeded");
        header("location: admin.php");
    }
    else{
        die(mysql_error());
        Print '<script>alert("Error Occured");</script>'; //提示用户
        //Print '<script>window.location.assign("admin.php");</script>';
    }
    //header("location: admin.php");*/

}

?>