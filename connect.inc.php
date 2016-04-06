<?php
/**
 * Created by PhpStorm.
 * User: dieling
 * Date: 16-4-4
 * Time: 下午6:05
 */
$conn_error = 'Could not connect';
$mysql_host = '127.0.0.1';
$mysql_user = 'root';
$mysql_pass = '1004426187';
$mysql_db = 'qicheheng';
$link = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
mysql_select_db($mysql_db,$link);
?>



