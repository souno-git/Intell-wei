<?php
/**
 * Created by PhpStorm.
 * User: shenya
 * Date: 16-4-7
 * Time: 下午6:58
 */
session_start();
if($_SESSION['user']and $_SESSION['perm']){
}
else{
    header("location:index.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST") //如果页面被调用则添加！
{
    include 'connect.inc.php';
    $user_id = mysql_real_escape_string($_POST['user_id']);
    $username = mysql_real_escape_string($_POST['username']);
    $passwrod = mysql_real_escape_string($_POST['password']);
    $perm = mysql_real_escape_string($_POST['perm']);
    $sql = "UPDATE users SET perm = '$perm',username = '$username',password = '$passwrod'
            WHERE users.user_id = '$user_id'";
    echo $sql;
    $result = mysql_query($sql);
    if($result){
        //echo("succeded");
        header("location: users.php");
    }
    else{
        die(mysql_error());
        Print '<script>alert("Error Occured");</script>'; //提示用户
        //Print '<script>window.location.assign("admin.php");</script>';
    }
    //header("location: admin.php");*/

}

?>