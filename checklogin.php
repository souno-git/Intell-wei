<?php
/**
 * Created by PhpStorm.
 * User: dieling
 * Date: 16-4-6
 * Time: 上午11:45
 */
session_start();
$username = $_POST["username"];
$password = $_POST["password"];

require 'connect.inc.php'; //链接到数据库
//$query = mysql_query("SELECT * from users WHERE username='$username'"); //如果输入用户名=数据库中用户名提取出对应数据
$query = mysql_query("SELECT * from users WHERE username='$username'");
$exists = mysql_num_rows($query); //检查用户是否存在
$table_users = "";
$table_password = "";
if($exists > 0) //如果没有返回或者用户不存在
{
    while ($row = mysql_fetch_assoc($query)) //打印获取的数据
    {
        $table_users = $row['username']; // 逐行对比所有相同的用户直到完成
        $table_password = $row['password'];

    }
       if(($username == $table_users) && ($password == $table_password)) // 检查是否有任何匹配字段
       {
           if($password == $table_password)
           {
               $_SESSION['user'] = $username; //在一个session中设置用户名。这是一个全局变量
               header("location: home.php"); // 将用户重定向到认证主页
           }

       }
       else
       {
           Print '<script charset="utf-8" >alert("INCORRECT PASSWORD!");</script>'; //提示用户
           Print '<script type=>window.location.assign("login.php");</script>'; // 重定向到 login.php
       }

   }
   else
   {
       Print '<script charset="utf-8" >alert("INCORRECT USERNAME!");</script>';
       Print '<script type=>window.location.assign("login.php");</script>';
   }

?>
