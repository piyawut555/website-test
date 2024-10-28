<?php
session_start();
include('db.php');

if (!isset($_SESSION['admin_login'])) {
    header("location: signin.php");
    exit;
}

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Fetch the current user data
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
    $user = mysqli_fetch_array($query);
} else {
    header("location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="dashboard.css">



<body>

    <header class="header">

        <h1>Dashboard</h1>

        <nav class="navbar">
            <a href="index.php">คำสั่งซื้อ</a>
            <a href="#">การจองโต๊ะ</a>
            <a href="#">เดลิเวอรี่</a>
            <a href="member.php">รายชื่อสมาชิก</a>
        </nav>

        <a class="user-name" href="<?php echo isset($row) ? 'profile.php' : 'signin.php'; ?>">
            <?php 
        if (isset($row)) {
            echo ($row['firstname']) . " " . ($row['lastname']);
        } else {
            echo "เข้าสู่ระบบ";
        }
    ?>
        </a>
    </header>


    <div class="form-wrapper">
        <form action="update_user.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

            <label for="firstname">ชื่อ:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>" required>

            <label for="lastname">นามสกุล:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>" required>

            <label for="email">อีเมล:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

            <label for="phonenum">เบอร์โทร:</label>
            <input type="text" id="phonenum" name="phonenum" value="<?php echo $user['phonenum']; ?>" required>

            <label for="urole">สถานะ:</label>
            <select id="urole" name="urole" required>
                <option value="admin" <?php echo ($user['urole'] == 'admin') ? 'selected' : ''; ?>>admin</option>
                <option value="user" <?php echo ($user['urole'] == 'user') ? 'selected' : ''; ?>>user</option>
            </select>

            <button type="submit" name="update" class="btn green">อัปเดต</button>
        </form>
    </div>
</body>

</html>
