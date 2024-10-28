<?php
session_start();
include('db.php');

if(isset($_POST['signin'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email)){
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header("location: signin.php");
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        header("location: signin.php");
    } else if(empty($password)){
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: signin.php");
    } else{
        $password = md5($password);
        $check_data = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";
        $result = mysqli_query($conn, $check_data);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);

            if($row['urole'] == 'admin'){
                $_SESSION['admin_login'] = $row['id'];
                header("location: dashboard.php");
            } else{
                $_SESSION['user_login'] = $row['id'];
                header("location: index.php");
            }
        } else{
            $_SESSION['error'] = 'อีเมลหรือรหัสผ่านไม่ถูกต้อง';
            header("location: signin.php");
        }
    }   
}
?>
