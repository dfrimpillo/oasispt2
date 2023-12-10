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
      <button class="edit-button">Edit</button>
    </div>
    
  </div>

  </div>
  <div class="profile-update-popup">
  <div class="profile-update">
    <div class="update-title">
      <p>Update Account</p>
    </div>
        <form action="updateprofile.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
          <div class="update-form">
              <label for="image">Profile Picture</label>
              <input type="file" name="image" accept=".jpg, .jpeg, .png">
              <input type="text"
                   hidden="hidden" 
                   name="old_pp"
                   value="<?=$userProfilePicture;?>" >
            </div>
            <div class="update-form">
              <label for="firstname">First Name</label>
              <input type="text" name="firstname" value="<?php echo $userFirstName; ?>">
            </div>
            <div class="update-form">
              <label for="lastname">Last Name</label>
              <input type="text" name="lastname" value="<?php echo $userLastName; ?>">
            </div>
            <div class="update-form">
              <label for="contactno">Contact No.</label>
              <input type="text" name="contact" value="<?php echo $userContact; ?>" placeholder="Contact number not set">
            </div>
            <div class="update-form">
              <label for="email">Email</label>
              <input type="email" name="email" value="<?php echo $userEmail; ?>">
            </div>
            <div class="update-form">
              <label for="address">Address</label>
              <input type="text" name="address" value="<?php echo $userAddress; ?>" placeholder="Address not set">
            </div>
            <div class="submit">
              <input type="submit" name="update" value="Update" class="update-button">
              <input type="button" name="cancel" value="Cancel" class="cancel-button">
            </div>
        </form>
          </div>

      </div>
  </div>      
  
  
  </section>
  <?php include "footer.php";?>
</body>
<script>
   var popupViews = document.querySelectorAll('.profile-update-popup');
   var popupBtns = document.querySelectorAll('.edit-button');
   var closeBtns = document.querySelectorAll('.cancel-button');

   var popup = function(popupClick){
  popupViews[popupClick].classList.add('active');
  }

popupBtns.forEach((popupBtn, i) => {
  popupBtn.addEventListener("click", () => {
    popup(i);
  });
});
closeBtns.forEach((closeBtn) => {
  closeBtn.addEventListener("click", () => {
    popupViews.forEach((popupView) => {
      popupView.classList.remove('active');
    });
  });
});

var closePopup = function() {
  popupViews.forEach((popupView) => {
    popupView.classList.remove('active');
  });
};

  </script>
</html>