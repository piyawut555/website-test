<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <form action="signup_db.php" method="post">
        <h1>สมัครสมาชิก</h1>

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
            <label for="firstname">ชื่อ</label>
            <input type="text" name="firstname">
        </div>
        <div class="input-group">
            <label for="lastname">นามสกุล</label>
            <input type="text" name="lastname">
        </div>
        <div class="input-group">
            <label for="email">อีเมล</label>
            <input type="email" name="email">
        </div>
        <div class="input-group">
            <label for="phonenum">เบอร์โทร</label>
            <input type="text" name="phonenum">
        </div>
        <div class="input-group">
            <label for="password">รหัสผ่าน</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <label for="c_password">ยืนยันรหัสผ่าน</label>
            <input type="password" name="c_password">
        </div>
        <button type="submit" name="signup">สม้ครสมาชิก</button>
        <p>เป็นสมาชิกแล้ว? <a href="signin.php">เข้าสู่ระบบ</a></p>
    </form>
</body>
</html>