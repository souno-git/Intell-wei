<html lang="en">
<?php
/**
 * Created by PhpStorm.
 * User: shenya
 * Date: 16-4-7
 * Time: 下午5:59
 */
include "head.php";
?>
<?php
session_start(); //启用 session
if($_SESSION['user']){ // 检查用户是否登录
}
else{
    header("location: index.php"); // 未登录则定向到用户
}
$user = $_SESSION['user']; //注册用户值
?>
<body>
<div class="container">
    <header>
        <div class="logo" >贵阳学院汽车衡智能称重系统</div>
        <nav class="float-right">
            <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <ul>
                    <li><a href="index.php">返回</a></li>
                    <li><a href="logout.php">退出登录</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <h2 align="center">编辑管理记录</h2>
    <div class="pure-skin-shenya">
    <table class="pure-table pure-table-bordered">
        <thead>
        <tr>
            <th>管理号</th>
            <th>账号</th>
            <th>车牌号</th>
            <th>类型</th>
            <th>净重</th>
            <th>时间</th>
            <th>备注</th>
            <th>删除</th>
        </tr>
        </thead>

        <tbody>
        <?php
        if(!empty($_GET['id']))
        {
            $id = $_GET['id'];
            $_SESSION['id'] = $id;
            $id_exists = true;
            include "connect.inc.php";//连接到数据库
            $query = mysql_query("Select * from manage Where manage_id='$id'"); // SQL请求
            $count = mysql_num_rows($query);
            if($count > 0)
            {
                while($row = mysql_fetch_array($query))
                {
                    echo "<tr>";
                    echo '<td align="center">'. $row['manage_id'] . "</td>";
                    echo '<td align="center">'. $row['user_id'] . "</td>";
                    echo '<td align="center">'. $row['carnum'] . "</td>";
                    echo '<td align="center">'. $row['kind'] . "</td>";
                    echo '<td align="center">'. $row['weight'] . "</td>";
                    echo '<td align="center">'. $row['time'] . "</td>";
                    if ($row['remarks'] == NULL)
                    {
                        echo '<td align="center">'. '无' . "</td>";
                    }
                    else
                    {
                        echo '<td align="center">'. $row['remarks'] . "</td>";
                    }

                    echo '<td align="center"> <a href="delete_manage.php?id='. $row['manage_id'] .'"> 删除 </a></td>';
                    echo "</tr>";
                    $manage_id = $row['manage_id'];
                    $user_id=$row['user_id'];
                    $carnum=$row['carnum'];
                    $kind=$row['kind'];
                    $weight=$row['weight'];
                    $time=$row['time'];
                    $remarks=$row['remarks'];
                }
            }
            else
            {
                $id_exists = false;
            }
        }
        ?>
        </tbody>
    </table>
        </div>
    <?php
    $user_query=mysql_query("SELECT user_id FROM users") or die ("Error Occurred");
    $car_query=mysql_query("SELECT carnum FROM car") or die ("Error Occurred");
    ?>
    <br/>
    <br/>
    <form class="pure-form pure-form-aligned" action="editmanage.php" method="POST">
        <fieldset>
            <div class="pure-control-group">
                <label for="manage_id">管理号</label>
                <?php
                echo '<input readonly id="manage_id" type="text" value="'.$manage_id.'" name="manage_id">'
                ?>
            </div>
            <div class="pure-control-group">
                <label for="user_id">管理账号</label>
                <select name = "user_id">
                    <?php
                    while ($row=mysql_fetch_array($user_query)) {
                        $cdTitle=$row["user_id"];
                        echo "<option value='$cdTitle'> $cdTitle</option>";
                    }
                    echo "<option selected='selected'> $user_id </option>";
                    ?>
                </select>
            </div>
            <div class="pure-control-group">
                <label for="carnum">车牌号</label>
                <select name = "carnum">
                    <?php
                    while ($row=mysql_fetch_array($car_query)) {
                        $cdTitle=$row["carnum"];
                        echo "<option value='$cdTitle' selected> $cdTitle </option>";
                    }
                    echo "<option selected='selected'> $carnum </option>";
                    ?>
                </select>
            </div>
            <div class="pure-control-group">
                <label for="kind">类型</label>
                <?php
                echo '<input id="kind" type="text" value="'.$kind.'" name="kind">'
                ?>
            </div>
            <div class="pure-control-group">
                <label for="weight">净重</label>
                <?php
                echo '<input id="weight" type="text" value="'.$weight.'" name="weight">'
                ?>
            </div>
            <div class="pure-control-group">
                <label for="time">时间</label>
                <input  type="datetime"  name="time" value="<?php  echo $time; ?>"/>
            </div>
            <div class="pure-control-group">
                <label for="remarks">备注</label>
                <?php
                echo '<input id="remarks" type="text" value="'.$remarks.'" name="remarks">'
                ?>
            </div>
            <div class="pure-controls">
                <button type="submit" class="pure-button pure-button-primary">提交</button>
            </div>
        </fieldset>
    </form>
    <?php
    include "footer.php";
    ?>
</div>
</body>
</html>