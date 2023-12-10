<?php
session_start();
include "dbconnection.php";

$errormsg = isset($_SESSION["errormsg"]) ? $_SESSION["errormsg"] : '';
unset($_SESSION["errormsg"]);

if (isset($_POST["reset"])) {
    $username = $_POST["username"];
    $newPassword = $_POST["password"];
    $confirmPassword = $_POST["repassword"];

    // Validate input (you may add more validation)
    if ($newPassword !== $confirmPassword) {
        $errormsg = "Passwords do not match.";
    } else {
        // Hash the new password (you should use a more secure hashing algorithm)
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $stmt = $conn->prepare("UPDATE userinfo SET password = ? WHERE username = ?");
        $stmt->bind_param('ss', $hashedPassword, $username);

        if ($stmt->execute()) {
            header('location: login.php');
        } else {
           echo "Error updating password. Please try again.";
        }

        // Close the statement
        $stmt->close();
    }
}
?>