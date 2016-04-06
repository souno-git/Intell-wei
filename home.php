<html lang="zh">
<?php
include "head.php";
?>
<?php
session_start(); //starts the session
if($_SESSION['user']){ // checks if the user is logged in
}
else{
    header("location: index.php"); // redirects if user is not logged in
}
$user = $_SESSION['user']; //assigns user value
?>
<body>
<div class="container">
    <header>
        <div class="logo" >贵阳学院汽车衡智能称重系统</div>
        <nav class="float-right">
            <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <ul>
                    <li><a href="logout.php">退出登录</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="pure-menu pure-menu-open pure-menu-horizontal">

        <ul>
            <h2>     <li class="pure-menu-selected"><a href="home.php">Items</a></li>
                <li><a href="employee.php">Employees</a></li>
                <li><a href="client.php">Clients</a></li>
                <li><a href="customer.php">Customers</a></li>
                <li><a href="sale.php">Sales</a></li>
            </h2>
        </ul>
    </div>
    <h2 align="center">Item list</h2>
    <nav class="float-right">
        <div class="pure-menu pure-menu-open pure-menu-horizontal">
            <ul>
                <li><a href="add_item.php">Add Item</a></li>
            </ul>
        </div>
    </nav>
    <table class="pure-table pure-table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Condition</th>
            <th>Customer_ID</th>
            <th>Client_ID</th>
            <th>Collector_ID</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>

        <tbody>
        <?php
        include "connect.inc.php";
        $queryitem = mysql_query("Select * from item");
        while($row = mysql_fetch_array($queryitem))
        {
            echo "<tr>";
            echo '<td align="center"><a href="item.php?id='. $row['item_id'] .'">'. $row['item_id'] . "</a></td>";
            echo '<td align="center">'. $row['name'] . "</td>";
            echo '<td align="center">'. $row['description'] . "</td>";
            echo '<td align="center">'. $row['condition'] . "</td>";
            if ($row['customer_id'] == NULL)
            {
                echo '<td align="center">'. 'Not yet sold' . "</td>";
            }
            else
            {
                echo '<td align="center"><a href="person.php?id='. $row['customer_id'] .'">'. $row['customer_id'] . "</a></td>";
            }
            echo '<td align="center"><a href="person.php?id='. $row['client_id'] .'">'. $row['client_id'] . "</a></td>";
            echo '<td align="center"><a href="person.php?id='. $row['collector_id'] .'">'. $row['collector_id'] . "</a></td>";
            echo '<td align="center"> <a href="edit_item.php?id='. $row['item_id'] .'"> edit </a> </td>';
            echo '<td align="center"> <a href="delete_item.php?id='. $row['item_id'] .'"> delete </a></td>';
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <?php
    include "footer.php";
    ?>
</div>
</body>
</html>