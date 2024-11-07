<?php
session_start();
include('db.php');

if(isset($_SESSION['user_login'])){
    $user_id = $_SESSION['user_login'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
    $row1 = mysqli_fetch_array($query);
}

$query = "SELECT * FROM tbl_table WHERE id=$_GET[id]";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <header class="header">

        <a href="#" class="logo">Logo</a>

        <nav class="navbar">
            <a href="index.php">หน้าแรก</a>
            <a href="#">เกี่ยวกับ</a>
            <a href="table.php">จองโต๊ะ</a>
            <a href="#">ติดต่อ</a>
        </nav>

        <a class="user-name" href="<?php echo isset($row1) ? 'profile.php' : 'signin.php'; ?>">
            <?php 
        if (isset($row1)) {
            echo ($row1['firstname']) . " " . htmlspecialchars($row1['lastname']);
        } else {
            echo "เข้าสู่ระบบ";
        }
    ?>
        </a>
    </header>

    <div class="container">
        <h2>ข้อมูลผู้จอง</h2>

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

        <form action="save_booking.php" method="post">
            <div class="form-group">
                <label for="last-name">เลขโต๊ะ:</label>
                <input type="text" name="table_name" class="form-control" disabled
                    value="<?php echo $row['table_name'];?>">
            </div>
            <div class="form-group">
                <label for="email">ผู้จอง:</label>
                <input type="text" name="booking_name" required value="<?php if (isset($row)) { echo($row1['firstname'] . " " . $row1['lastname']); } ?>">
            </div>
            <div class="form-group">
                <label for="password">วันที่:</label>
                <input type="date" name="booking_date" class="form-control" required value="<?php echo date('Y-m-d');?>">
            </div>
            <div class="form-group">
                <label for="password">เวลา:</label>
                <input type="time" name="booking_time" class="form-control" required placeholder="เวลา">
            </div>
            <div class="form-group">
                <label for="password">เบอร์โทร:</label>
                <input type="text" name="booking_phone" required value="<?php if (isset($row)) { echo($row1['phonenum']); } ?>">
            </div>
            <div class="form-group">
                <label for="password">ผู้บันทึก:</label>
                <input type="text" name="booking_staff" class="form-control" readonly value="พนง.">
            </div>
            <div class="form-group">
                <input type="hidden" name="table_id" value="<?php echo $_GET['id'];?>">
                <button type="submit" name="queue">บันทึกการจอง</button>
            </div>
        </form>
    </div>

</body>

</html>