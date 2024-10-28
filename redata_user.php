<?php

session_start();
include('db.php');

if (isset($_POST['reset'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_id = $_SESSION['user_login'];

    if (empty($firstname)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header("location: profile.php");
    } else if (empty($lastname)) {
        $_SESSION['error'] = 'กรุณากรอกนามสกุล';
        header("location: profile.php");
    } else if (empty($email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header("location: profile.php");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        header("location: profile.php");
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่านปัจจุบัน';
        header("location: profile.php");
    } else {
        $check_data = "SELECT * FROM users WHERE id = '$user_id'";
        $result = mysqli_query($conn, $check_data);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if (md5($password) === $user_data['password']) {
                $stmt = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE id = '$user_id'";
                if (mysqli_query($conn, $stmt)) {
                    $_SESSION['success'] = 'เปลี่ยนข้อมูลสำเร็จ'; 
                } else {
                    $_SESSION['error'] = 'เกิดข้อผิดพลาด';
                }
            } else {
                $_SESSION['error'] = 'รหัสผ่านปัจจุบันไม่ถูกต้อง';
            }
        } else {
            $_SESSION['error'] = 'เกิดข้อผิดพลาดในการค้นหาผู้ใช้';
        }
    }
    header("location: profile.php");
}
?>
