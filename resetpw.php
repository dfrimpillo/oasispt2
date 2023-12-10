<?php
session_start();
include "dbconnection.php";

$errormsg = isset($_SESSION["errormsg"]) ? $_SESSION["errormsg"] : '';
unset($_SESSION["errormsg"]);

if (isset($_POST["reset"])) {
    $username = $_POST["username"];
    $newPassword = $_POST["password"];
    $confirmPassword = $_POST["repassword"];

    if ($newPassword !== $confirmPassword) {
        $errormsg = "Passwords do not match.";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE userinfo SET password = ? WHERE username = ?");
        $stmt->bind_param('ss', $hashedPassword, $username);

        if ($stmt->execute()) {
            header('location: login.php');
        } else {
           echo "Error updating password. Please try again.";
        }

        $stmt->close();
    }
}
?>