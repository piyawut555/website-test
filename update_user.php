<?php
session_start();
include('db.php');

if (!isset($_SESSION['admin_login'])) {
    header("location: signin.php");
    exit;
}

if (isset($_POST['update'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phonenum = mysqli_real_escape_string($conn, $_POST['phonenum']);
    $urole = mysqli_real_escape_string($conn, $_POST['urole']);

    // Update user information
    $query = "UPDATE users SET 
                firstname = '$firstname', 
                lastname = '$lastname', 
                email = '$email', 
                phonenum = '$phonenum', 
                urole = '$urole' 
              WHERE id = $user_id";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "User updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update user.";
    }

    // Redirect to the dashboard
    header("location: edit.php");
    exit;
} else {
    header("location: edit.php");
    exit;
}
