<?php
session_start(); //starts the session
if($_SESSION['user']){ // checks if the user is logged in
}
else{
    header("location: index.php"); // redirects if user is not logged in
}
$user = $_SESSION['user']; //assigns user value
?>
<table class="pure-table pure-table-bordered">
    <thead>
    <tr>
        <th>驾驶证号</th>
        <th>车牌号</th>
        <th>姓名</th>
        <th>生日</th>
        <th>驾照类型</th>
        <th>部门</th>
        <th>电话</th>
    </tr>
    </thead>
    <tbody>
    <?php
    header("content-type:application/msexcel");
    header("content-disposition:filename=driver.xls");
    include "../connect.inc.php";
    $queryitem = mysql_query("Select * from driver");
    while($row = mysql_fetch_array($queryitem))
    {
        echo "<tr>";
        echo '<td align="center">'. $row['driver_id'] . "</td>";
        echo '<td align="center">'. $row['carnum'] . "</td>";
        echo '<td align="center">'. $row['name'] . "</td>";
        echo '<td align="center">'. $row['bday'] . "</td>";
        echo '<td align="center">'. $row['dkind'] . "</td>";
        echo '<td align="center">'. $row['part'] . "</td>";
        echo '<td align="center">'. $row['telnum'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
