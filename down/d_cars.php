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
            <th>车牌号</th>
            <th>车型</th>
            <th>照片</th>
            <th>核定载重</th>
            <th>出厂时间</th>
            <th>备注</th>
        </tr>
        </thead>
        <tbody>
        <?php
        header("content-type:application/msexcel");
        header("content-disposition:filename=cars.xls");
        include "../connect.inc.php";
        $queryitem = mysql_query("Select * from car");
        while($row = mysql_fetch_array($queryitem))
        {
            echo "<tr>";
            echo '<td align="center">'. $row['carnum'] . "</td>";
            echo '<td align="center">'. $row['model'] . "</td>";
            echo '<td align="center">'. $row['photo'] . "</td>";
            echo '<td align="center">'. $row['fload'] . "</td>";
            echo '<td align="center">'. $row['pdtime'] . "</td>";
            echo '<td align="center">'. $row['remarks'] . "</td>";
            echo "</tr>";
        }
        ?>
</tbody>
</table>