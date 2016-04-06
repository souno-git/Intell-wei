<?php
/**
 * Created by PhpStorm.
 * User: dieling
 * Date: 16-4-6
 * Time: 上午11:45
 */
session_start();
session_destroy();
header("location:index.php");
?>