<?php
session_start();
include('db.php');

if(!isset($_SESSION['admin_login'])){
    header("location: signin.php");
    exit; // It's a good practice to exit after a header redirect
}

if(isset($_SESSION['admin_login'])){
    $admin_id = $_SESSION['admin_login'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $admin_id");
    $row = mysqli_fetch_array($query);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>

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

</body>

</html>