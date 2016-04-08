<html lang="zh">
<?php
include "head.php";
?>
<body>
<div class="container">
    <header>
        <div class="logo" >贵阳学院汽车衡智能称重系统</div>
        <nav class="float-right">
            <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <ul>
                    <li><a href="cars.php">返回</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <h2>司机登录页面</h2>

    <form method="POST" class="pure-form pure-form-aligned" action="checkdlogin.php" >
        <fieldset>
            <div class="pure-control-group">
                <label for="name">驾驶证号</label>
                <input id="name" type="text" placeholder="Username" name="username" required="required">
            </div>

            <div class="pure-control-group">
                <label for="password">密  码</label>
                <input id="password" type="password" placeholder="Password" name="password" required="required">
            </div>
            <div class="pure-controls">
                <button type="submit" class="pure-button pure-button-primary" type="submit" value="Login">确定</button>
            </div>
        </fieldset>
    </form>
    <?php
    include "footer.php";
    ?>
</div>
</body>
</html>