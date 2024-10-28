<?php
session_start();
include('db.php');


if(!isset($_SESSION['user_login'])){
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile Form</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <div class="container">
        <h2>เปลี่ยนรหัสผ่าน</h2>

        <?php
            include('navbar.php');
        ?>
    
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

        <form action="resetpass_db.php" method="post">
            <div class="form-group">
                <label for="new_password">รหัสผ่านใหม่:</label>
                <input type="password" name="new_password">
            </div>
            <div class="form-group">
                <label for="c_new_password">ยืนยันรหัสผ่านใหม่:</label>
                <input type="password" name="c_new_password">
            </div>
            <div class="form-group">
                <label for="password">รหัสผ่านปัจจุบัน:</label>
                <input type="password" name="password">
            </div>
            <div class="form-group">
                <button type="submit" name="reset">เปลี่ยนรหัสผ่าน</button>
            </div>
        </form>
        <form action="logout.php" method="post">
            <button type="submit" class="form-group logout-button">ออกจากระบบ</button>
        </form>
    </div>
</body>
</html>
