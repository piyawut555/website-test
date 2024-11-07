<?php

    session_start();
    include('db.php');

    $query = "SELECT * FROM tbl_table ORDER BY id ASC";
    $result = mysqli_query($conn, $query);

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
    <title>จองโต๊ะ</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/table.css">
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
    
    <main>
        <div class="container">
            <h1>จองโต๊ะ</h1>
            <div class="menu">
                <?php foreach ($result as $row){
                    if($row['table_status'] == 0){
                        echo ' <div class = "table" style = "margin: 5px">';
                        echo '<a href="' . (isset($_SESSION['user_login']) ? 'booking.php?id=' . $row["id"] . '&act=booking' : 'signin.php') . '" class="btn-success" >' . $row['table_name'] . '</a></div>';
                    } else{ 
                        echo ' <div class = "table" style = "margin: 5px">';
                        echo ' <a href = "#" class = "btn-disable" >'.$row['table_name'].'</a></div> ';
                    }
                } ?>
            </div>
            <p>*เหลือง = ว่าง, เทา = ไม่ว่าง, เขียว = โต๊ะที่จอง</p>
        </div>
    </main>
</body>
</html>