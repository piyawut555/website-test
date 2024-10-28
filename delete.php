<?php
session_start();
include('db.php');

if (!isset($_SESSION['admin_login'])) {
    header("location: signin.php");
    exit;
}

if (isset($_POST['delete']) && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);

    $query = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("location: member.php");
    } else {
        header("location: menber.php");
    }

    exit;
} else {
    header("location: member.php");
    exit;
}
?>
