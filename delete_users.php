<?php
/**
 * Created by PhpStorm.
 * User: shenya
 * Date: 16-4-7
 * Time: 下午5:46
 */
session_start(); //启用session
if($_SESSION['user']and $_SESSION['perm']){ //检查是否登录
}
else {
    header("location:index.php"); //未登录则重定向用户到主页
}
if($_SERVER['REQUEST_METHOD'] == "GET")
{
    include 'connect.inc.php'; //连接到数据库
    $id = $_GET['id'];
    $sql_query="DELETE FROM users WHERE user_id='$id'";
    // $result1=mysql_query($sql_query1);
    //$result2=mysql_query($sql_query2);
    // $result3=mysql_query($sql_query3);
    // $result4=mysql_query($sql_query4);
    $result=mysql_query($sql_query);
    // $result=mysql_query($sql_query);
    if(/*($result and $result2 and $result1 and $result3 and $result4 and*/ $result){
        header("location:users.php");
    }
    else{
        echo mysql_error();
    }
}
?>