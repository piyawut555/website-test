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
    <title>ข้อมูลผู้ใช้</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <header>
        <?php
            include('navbar.php')
        ?>
    </header>
    <div class="container">
        <h2>ข้อมูลผู้ใช้</h2>

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

        <form action="redata_user.php" method="post">
            <div class="form-group">
                <label for="first-name">ชื่อ:</label>
                <input type="text" name="firstname" required value="<?php if (isset($row)) { echo($row['firstname']); } ?>">
            </div>
            <div class="form-group">
                <label for="last-name">นามสกุล:</label>
                <input type="text" name="lastname" required value="<?php if (isset($row)) { echo($row['lastname']); } ?>">
            </div>
            <div class="form-group">
                <label for="email">อีเมล:</label>
                <input type="email" name="email" required value="<?php if (isset($row)) { echo($row['email']); } ?>">
            </div>
            <div class="form-group">
                <label for="password">รหัสผ่านปัจจุบัน:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="reset">ยืนยันเปลี่ยนข้อมูล</button>
            </div>
        </form>
        <form action="reset_password.php" method="post">
            <button type="submit" class="form-group reset-button">เปลี่ยนรหัสผ่าน</button>
        </form>
        <form action="logout.php" method="post">
            <button type="submit" class="form-group logout-button">ออกจากระบบ</button>
        </form>
    </div>
</body>
</html>
