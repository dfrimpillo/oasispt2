<?php
session_start(); 
include "dbconnection.php";

$errormsg = isset($_SESSION["errormsg"]) ? $_SESSION["errormsg"] : ''; 
unset($_SESSION["errormsg"]); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Oasis Cafe</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>
  <?php include "header.php"; ?>

  <section class="login">
      <div class="login-container">
        <div class="title">
        <h2>RESET PASSWORD</h2>
        </div>
        <form method="POST" action="resetpw.php" id="customer-login" autocomplete="off">
          <div class="form-field">
            <i class="fa fa-solid fa-user"></i>
            <input type="text" id="customer-username" name="username" required>
            <label for="">Username</label>
          </div>
          <div class="form-field">
            <i class="fa fa-lock"></i>
            <input type="password" id="customer-password"  name="password" required>
            <label for="">New Password</label>
          </div>
          <div class="form-field">
            <i class="fa fa-lock"></i>
            <input type="password" id="customer-password"  name="repassword" required>
            <label for="">Re-enter New Password</label>
          </div>
          <?php if (isset($errormsg)) { ?>
            <div class="errordiv">
             <p class="error-message"> <?php echo $errormsg; ?> </p>

            </div>
          <?php  } ?>
          
          <div class="reset-button">
            <input type="submit" class="login-btn" value="RESET" name="reset">
          </div>

        </form>
        <div class="signup-link">
        <p>Don't have an account? <span><a href="signup.php">Sign up here.</a></span></p>
        </div>
      </div>
  </section>

  
</body>
</html>