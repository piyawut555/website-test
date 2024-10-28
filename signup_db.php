<?php
session_start();
include('db.php');

if(isset($_POST['signup'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenum = $_POST['phonenum'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $urole = 'user';

    if(empty($firstname)){
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header("location: signup.php");
    } else if(empty($lastname)){
        $_SESSION['error'] = 'กรุณากรอกนามสกุล';
        header("location: signup.php");
    } else if(empty($email)){
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header("location: signup.php");
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        header("location: signup.php");
    } else if(empty($phonenum)){
        $_SESSION['error'] = 'กรุณากรอกเบอร์โทรศัพท์';
        header("location: signup.php");
    } else if(empty($password)){
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: signup.php");
    } else if(strlen($password) < 8){
        $_SESSION['error'] = 'รหัสผ่านควรมีความยาวอย่างน้อย 8 ตัว';
        header("location: signup.php");
    } else if(empty($c_password)){
        $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
        header("location: signup.php");
    } else if($password != $c_password){
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        header("location: signup.php");
    } else{
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $query = mysqli_query($conn, $check_email);
        $result = mysqli_fetch_assoc($query);

        if($result){
            if($result['email'] === $email){
                $_SESSION['error'] = 'อีเมลนี้ถูกใช้งานแล้ว';
                header("location: signup.php");
            }
        }
        if(!isset($_SESSION['error'])){
            $password = md5($password);
            $sql = "INSERT INTO users(firstname, lastname, email, phonenum, password, urole) VALUES ('$firstname', '$lastname', '$email', '$phonenum', '$password', '$urole')";
            mysqli_query($conn, $sql);
            $_SESSION['success'] = 'สมัครสมาชิกสำเร็จแล้ว';
            header("location: signup.php");
        } else{
            $_SESSION['error'] = 'เกิดข้อผิดพลาดในการสมัครสมาชิก';
            header("location: signup.php");
        }
    }
}
?>
