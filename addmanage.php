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

if($_SERVER['REQUEST_METHOD'] == "POST") //如果页面被调用则添加！
{
    include 'connect.inc.php';
    $user_id = mysql_real_escape_string($_POST['user_id']);
    $carnum = mysql_real_escape_string($_POST['carnum']);
    $kind = mysql_real_escape_string($_POST['kind']);
    $weight = mysql_real_escape_string($_POST['weight']);
    $time = mysql_real_escape_string($_POST['time']);
    $remarks = mysql_real_escape_string($_POST['remarks']);
    $flag=0;
    if($remarks==''){
        $sql_manage = "INSERT INTO manage(manage_id,user_id,carnum,kind,weight,time,remarks)
     VALUES (NULL,'$user_id','$carnum','$kind','$weight','$time',NULL);";
        $flag=1;
    }
    else{
        $sql_manage = "INSERT INTO manage(manage_id,user_id,carnum,kind,weight,time,remarks)
     VALUES (NULL,'$user_id','$carnum','$kind','$weight','$time','$remarks');";
    }
    $result_manage = mysql_query($sql_manage);
    $manage_id=mysql_insert_id();
    if($manage_id){
        echo("succeded");
        header("location: admin.php");
    }
    else{
        echo("failed");
        die(mysql_error());
        Print '<script>alert("Error Occured");</script>'; //提示用户！
        Print '<script>window.location.assign("add_item.php");</script>';
    }
}
else
{
    Print '<script>alert("Error Occured");</script>'; //提示用户
    Print '<script>window.location.assign("add_item.php");</script>'; // 重定向 login.php
}

?>











