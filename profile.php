<?php 
session_start();

include "get_user_info.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
</head>
<body>
  <?php include "header.php";?>
  <section id="profile">

  
  <?php if (isset($_POST['edit'])):?>
    <form action="updateprofile.php" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="profile-info">
        <div class="picture">
          <img src="<?php echo $userProfilePicture;?>" alt="">
          <div class="round">
            <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
            <i class="fa fa-camera" style="color: #fff;"></i>
          </div>
        </div>
        <div class="user">
          <div class="name-div">
            <div class="fname">
              <input type="text" name="firstname" placeholder="First Name" value="<?php echo $userFirstName; ?>"  class="growing-input" oninput="expandInput(this)">
            </div>
            <div class="lname">
              <input type="text" name="lastname" placeholder="Last Name" value="<?php echo $userLastName; ?>"  class="growing-input" oninput="expandInput(this)">
            </div>
          </div>
          <div class="others">
            <input type="text" name="contact" placeholder="Contact" value="<?php echo $userContact; ?>" class="growing-input" oninput="expandInput(this)">
            <input type="text" name="email" placeholder="Email" value="<?php echo $userEmail; ?>" class="growing-input" oninput="expandInput(this)">
            <input type="text" name="address" placeholder="Address" value="<?php echo $userAddress; ?>" class="growing-input" oninput="expandInput(this)">
          </div>
          <div class="form">
          <a href="profile.php" class="edit-button">Cancel</a>

          <input type="submit" name="update" value="Update" class="edit-button">

          </div>
        </div>
      </div>
  
  
    </form>
    
  <?php else: ?>
  <div class="profile-info">
    <div class="picture">
      <img src="<?php echo $userProfilePicture;?>" alt="">
    </div>
    <div class="user">
      <div class="name-div">
        <div class="fname">
        <p class="name"><?php echo $userFirstName;?></p>
        </div>
        <div class="lname">
        <p class="name"><?php echo $userLastName; ?></p>
        </div>
      </div>
      <div class="others">
        <p><?php if (!empty($userContact)) {
          echo "<p>$userContact</p>";
        } else {
          echo "<p class='blank'>Contact number not set</p>";
        }?></p>
        <p><?php if (!empty($userEmail)) {
          echo "<p>$userEmail</p>";
        } else {
          echo "<p class='blank'>Email address not set</p>";
        } ?></p>
        <p><?php if (!empty($userAddress)) {
          echo "<p >$userAddress</p>";
        } else {
          echo "<p class='blank'>Address not set</p>";
        } ?></p>
      </div>
      <div class="form">
  <form action="" method="post">
    <input type="submit" name="edit" value="Edit" class="edit-button">
  </form>
    </div>
    
  </div>

  </div>
  
  <?php endif; ?>
  </section>
  <?php include "footer.php";?>
</body>
<script>
    function expandInput(input) {
      input.style.width = input.value.length + "ch";
    }
  </script>
</html>