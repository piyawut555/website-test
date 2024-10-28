<?php

session_start();
include('db.php');

if (isset($_POST['reset'])) {
    $new_password = $_POST['new_password'];
    $c_new_password = $_POST['c_new_password'];
    $password = $_POST['password'];
    $user_id = $_SESSION['user_login'];

    if (empty($new_password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่านใหม่';
        header("location: reset_password.php");
        exit(); // Ensure no further processing occurs
    } else if (strlen($new_password) < 8) {
        $_SESSION['error'] = 'รหัสผ่านควรมีความยาวอย่างน้อย 8 ตัว';
        header("location: reset_password.php");
        exit();
    } else if (empty($c_new_password)) {
        $_SESSION['error'] = 'กรุณายืนยันรหัสผ่านใหม่';
        header("location: reset_password.php");
        exit();
    } else if (strlen($c_new_password) < 8) {
        $_SESSION['error'] = 'รหัสผ่านควรมีความยาวอย่างน้อย 8 ตัว';
        header("location: reset_password.php");
        exit();
    } else if ($new_password != $c_new_password) {
        $_SESSION['error'] = 'รหัสผ่านใหม่ไม่ตรงกัน';
        header("location: reset_password.php");
        exit();
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่านปัจจุบัน';
        header("location: reset_password.php");
        exit();
    } else {
        $check_data = "SELECT * FROM users WHERE id = '$user_id'";
        $result = mysqli_query($conn, $check_data);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if (md5($password) === $user_data['password']) {
                $new_password_hashed = md5($new_password);
                $stmt = "UPDATE users SET password = '$new_password_hashed' WHERE id = '$user_id'";
                if (mysqli_query($conn, $stmt)) {
                    $_SESSION['success'] = 'เปลี่ยนรหัสผ่านสำเร็จแล้ว'; 
                } else {
                    $_SESSION['error'] = 'เกิดข้อผิดพลาดในการเปลี่ยนรหัสผ่าน';
                }
            } else {
                $_SESSION['error'] = 'รหัสผ่านปัจจุบันไม่ถูกต้อง';
            }
        } else {
            $_SESSION['error'] = 'เกิดข้อผิดพลาดในการค้นหาผู้ใช้';
        }
    }
    header("location: reset_password.php");
}
?>
