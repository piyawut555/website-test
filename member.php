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

$sql = "SELECT * FROM users";
$stmt = mysqli_query($conn, $sql);

$results = []; // Initialize results array
if ($stmt) {
    // Fetch all results
    while ($result = mysqli_fetch_assoc($stmt)) {
        $results[] = $result; // Store each row in the $results array
    }
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
            <a href="#">รายชื่อสมาชิก</a>
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

    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">ชื่อ</th>
                    <th scope="col">นามสกุล</th>
                    <th scope="col">อีเมล</th>
                    <th scope="col">เบอร์โทร</th>
                    <th scope="col">สถานะ</th>
                    <th scope="col">เครื่องมือ</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($results as $key => $user) { ?>
                <tr>
                    <th scope="row"><?php echo ($user['id']); ?></th>
                    <td><?php echo ($user['firstname']); ?></td>
                    <td><?php echo ($user['lastname']); ?></td>
                    <td><?php echo ($user['email']); ?></td>
                    <td><?php echo ($user['phonenum']); ?></td>
                    <td><?php echo ($user['urole']); ?></td>
                    <td class="form-button">
                        <form action="edit.php" method="post">
                            <input type="hidden" name="user_id" value="<?php echo ($user['id']); ?>">
                            <button class="btn green" name="edit">แก้ไข</button>
                        </form>
                        <form action="delete.php" method="post"
                            onsubmit="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?');">
                            <input type="hidden" name="user_id" value="<?php echo ($user['id']); ?>">
                            <button class="btn red" name="delete">ลบ</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

</body>

</html>