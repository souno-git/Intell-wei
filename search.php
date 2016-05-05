<html lang="zh">
<?php
include "head.php";
?>
<?php
session_start(); //启用session
if($_SESSION['user']){ // 检查用户是否登陆
}
else{
    //header("location: index.php"); // 如果用户未登录则调用主页
}
$user = $_SESSION['user']; //读取用户
require "connect.inc.php";
$user_query=mysql_query("SELECT user_id FROM users") or die ("Error Occurred");
$car_query=mysql_query("SELECT carnum FROM car") or die ("Error Occurred");
?>
<body>
        <div class="container">
          <header>
             <div class="logo" >贵阳学院汽车衡智能称重系统</div>
             <nav class="float-right">
                <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <ul>
                    <li><?php if(empty($user)) {echo '<a href="index.php">返回首页</a></li>';}else{echo '<a href="index.php">返回管理</a></li>';} ?>

                </ul>
            </div>
           </nav>
          </header>
          <h2 align="center">条件查询页面</h2>
            <div style="border:1px solid #a1a1a1;padding:0px 25px;border-radius:2px">
                <br>
            <form class="pure-form pure-form-aligned" action="search.php" method="POST">
                <fieldset>
            <table align="center">
                <tr align="center">
                    <td align="center">
            <div>
                <label for="carnum">车牌号:</label>
                <INPUT id="carnum" name="carnum">
                <select name = "car_num" onchange="document.getElementById('carnum').value=this.options[this.selectedIndex].value">
                    <?php
                    while ($row=mysql_fetch_array($car_query)) {
                        $cdTitle=$row["carnum"];
                        echo "<option value='$cdTitle'> $cdTitle </option>";
                    }
                    ?>
                </select>
            </div>
                    </td>
                    <td align="center">
            <div>
                <label for="time">时间:</label>
                <input  type="datetime" placeholder="YYYY-MM-DD HH:MM:SS" name="time" />
            </div>
                    </td>

                    <td align="right">
                <div>
                    <button type="submit" class="pure-button pure-button-primary">查询</button>
                </div>
                    </td>
                </tr>
            </table>
    </fieldset>
</form>
</div>
            <br>
            <div class="pure-skin-shenya">
            <table class="pure-table pure-table-bordered pure-table-striped">
                <thead>
                <tr>
                    <th>管理号</th>
                    <th>账号</th>
                    <th>车牌号</th>
                    <th>类型</th>
                    <th>净重</th>
                    <th>时间</th>
                    <th>备注</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $carnum = mysql_real_escape_string($_POST['carnum']);
                $time = mysql_real_escape_string($_POST['time']);
                if(!empty($_POST['time'])&&!empty($_POST['carnum'])){
                    $search_sql="Select * from manage Where carnum='$carnum' AND manage.time='$time'";
                }
                elseif (!empty($_POST['time'])&&empty($_POST['carnum'])){
                    $search_sql="Select * from manage Where manage.time='$time'";
                }
                else{
                    $search_sql="Select * from manage Where carnum='$carnum'";
                }
                $queryitem = mysql_query($search_sql);
                while($row = mysql_fetch_array($queryitem))
                {
                    echo "<tr>";
                    echo '<td align="center">'. $row['manage_id'] . "</td>";
                    echo '<td align="center">'. $row['user_id'] . "</td>";
                    echo '<td align="center">'. $row['carnum'] . "</td>";
                    echo '<td align="center">'. $row['kind'] . "</td>";
                    echo '<td align="center">'. $row['weight'] . "</td>";
                    echo '<td align="center">'. $row['time'] . "</td>";
                    echo '<td align="center">'. $row['remarks'] . "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
                </div>
            <?php
            include "footer.php";
            ?>
        </div>
</body>
</html>

