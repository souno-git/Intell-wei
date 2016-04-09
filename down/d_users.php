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
        <th>账号</th>
        <th>姓名</th>
        <th>密码</th>
        <th>权限</th>
    </tr>
    </thead>
    <tbody>
    <?php
    header("content-type:application/msexcel");
    header("content-disposition:filename=users.xls");
    include "../connect.inc.php";
    $queryitem = mysql_query("Select * from users");
    while($row = mysql_fetch_array($queryitem))
    {
        echo "<tr>";
        echo '<td align="center">'. $row['user_id'] . "</td>";
        echo '<td align="center">'. $row['username'] . "</td>";
        echo '<td align="center">'. $row['password'] . "</td>";
        echo '<td align="center">'. $row['perm'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
