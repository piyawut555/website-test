<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <form action="signin_db.php" method="post">
        <h1>เข้าสู่ระบบ</h1>

        <?php if(isset($_SESSION['error'])){?>
            <div class="error">
                <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php }?>

        <?php if(isset($_SESSION['success'])){?>
            <div class="success">
                <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </div>
        <?php }?>

        <div class="input-group">
            <label for="email">อีเมล</label>
            <input type="email" name="email">
        </div>
        <div class="input-group">
            <label for="password">รหัสผ่าน</label>
            <input type="password" name="password">
        </div>
        <button type="submit" name="signin">เข้าสู่ระบบ</button>
        <p>ยังไม่ได้สมัครสมาชิก? <a href="signup.php">สมัครสมาชิก</a></p>
    </form>
</body>
</html>