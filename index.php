<?php
session_start();
include('db.php');

if(isset($_SESSION['user_login'])){
    $user_id = $_SESSION['user_login'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
    $row = mysqli_fetch_array($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header class="header">

        <a href="#" class="logo">Logo</a>

        <nav class="navbar">
            <a href="#">หน้าแรก</a>
            <a href="#">เกี่ยวกับ</a>
            <a href="#">จองโต๊ะ</a>
            <a href="#">ติดต่อ</a>
        </nav>

        <a class="user-name" href="<?php echo isset($row) ? 'profile.php' : 'signin.php'; ?>">
            <?php 
                if (isset($row)) {
                    echo ($row['firstname']) . " " . htmlspecialchars($row['lastname']);
                } else {
                    echo "เข้าสู่ระบบ";
                }
            ?>
        </a>
    </header>
</body>
</html>