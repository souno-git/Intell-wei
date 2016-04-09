<?php
/**
 * Created by PhpStorm.
 * User: shenya
 * Date: 16-4-7
 * Time: 下午6:58
 */
session_start();
if($_SESSION['user'] or $_SESSION['duser']){
}
else{
    header("location:index.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST") //如果页面被调用则添加！
{
    include 'connect.inc.php';
    $driver_id = mysql_real_escape_string($_POST['driver_id']);
    $dpasswrd = mysql_real_escape_string($_POST['dpassword']);
    $carnum = mysql_real_escape_string($_POST['carnum']);
    $name = mysql_real_escape_string($_POST['name']);
    $bday = mysql_real_escape_string($_POST['bday']);
    $dkind = mysql_real_escape_string($_POST['dkind']);
    $part = mysql_real_escape_string($_POST['part']);
    $telnum = mysql_real_escape_string($_POST['telnum']);
    $sql = "UPDATE driver SET dpassword='$dpasswrd',carnum = '$carnum',name = '$name',
            bday = '$bday',dkind = '$dkind',part = '$part',telnum = '$telnum' WHERE driver.driver_id = '$driver_id'";
    echo $sql;
    $result = mysql_query($sql);
    if($result){
        //echo("succeded");
        if($_SESSION['user']){
            header("location: driver.php");
        }if($_SESSION['duser']){
            header("location: home.php");
        }

    }
    else{
        die(mysql_error());
        Print '<script>alert("Error Occured");</script>'; //提示用户
        //Print '<script>window.location.assign("admin.php");</script>';
    }
    //header("location: admin.php");*/

}

?>