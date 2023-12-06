<?php
session_start();
include "dbconnection.php";

if (isset($_POST['update'])) {
    $username = $_SESSION['username'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

      $update = "UPDATE userinfo SET firstname=?, lastname=?, email=?, useraddress=?, contactno=? WHERE username=?";
      $stmt = mysqli_prepare($conn, $update);
      mysqli_stmt_bind_param($stmt, "ssssss", $fname, $lname, $email, $address, $contact, $username);
    

    mysqli_stmt_execute($stmt);
    $success = mysqli_stmt_affected_rows($stmt) > 0;

    if ($success) {
        header('location: profile.php');
        exit();
    } else {
        echo "Update failed!";
    }

    mysqli_close($conn);
}
?>