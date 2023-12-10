<?php
session_start();

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

if (isset($_POST['update'])) {
    include "dbconnection.php";
    $username = $_SESSION['username'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // File upload handling
    $target_dir = "imgs/uploads/";
    $uploadOk = 1;
    $userProfilePicture = "";  

    if (!empty($_FILES["image"]["name"])) {
        $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $random_string = generateRandomString();
        $file_name = $username . "_" . $random_string . "." . $file_extension;
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        $allowed_formats = ["jpg", "jpeg", "png"];
        if (!in_array($imageFileType, $allowed_formats)) {
            echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                $userProfilePicture = $target_file;  // Update the profile picture path
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update user information in the database
    $update = "UPDATE userinfo SET firstname=?, lastname=?, email=?, useraddress=?, contactno=?";
    
    if (!empty($userProfilePicture)) {
        $update .= ", userimg=?";
    }
    
    $update .= " WHERE username=?";
    
    $stmt = mysqli_prepare($conn, $update);

    if (!empty($userProfilePicture)) {
        mysqli_stmt_bind_param($stmt, "sssssss", $fname, $lname, $email, $address, $contact, $userProfilePicture, $username);
    } else {
        mysqli_stmt_bind_param($stmt, "ssssss", $fname, $lname, $email, $address, $contact, $username);
    }

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
