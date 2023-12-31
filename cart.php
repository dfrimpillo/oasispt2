<?php
session_start();
include('dbconnection.php');

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit();
}

$username = $_SESSION['username'];

$query = "SELECT * FROM cart WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
  mysqli_stmt_bind_param($stmt, 's', $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
}

$totalQuantity = 0;
$totalPrice = 0.00;
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
    $totalQuantity += $row['quantity'];
    $totalPrice += $row['price'] * $row['quantity'];
}


mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart - Oasis Cafe</title>
</head>
<body>
  <?php include "header.php"; ?>
  <div class="cart-main">
  <section class="cart">
            <div class="cart-title">
                <h1>MY CART</h1>
            </div>
            <div class="carttitle-container">
                <div class="cart-column product-detail">
                    <p>PRODUCT DETAILS</p>
                </div>
                <div class="cart-column">
                    <p>SIZE</p>
                </div>
                <div class="cart-column">
                    <p>PRICE</p>
                </div>
                <div class="cart-column">
                    <p>QUANTITY</p>
                </div>
                <div class="cart-column">
                    <p>TOTAL</p>
                </div>
                <div class="cart-column">

                </div>
            </div>
  <div class="cart-items">
    <?php
    if (count($data) > 0) {
        foreach ($data as $row) {
            ?>
             <div class="cart-container">
                <div class="cart-column product-detail">
                    <img src="<?php echo $row['img']; ?>" class="cart-img"> 
                    <h3><?php echo $row['prodname']; ?></h3>
                </div>
                <div class="cart-column">
                    <p><?php echo $row['size']; ?></p>
                </div>
                <div class="cart-column">
                    <p>₱<?php echo number_format($row['price'], 2); ?></p>
                </div>
                <div class="cart-column">
                    <p><?php echo $row['quantity']; ?></p>
                </div>
                <div class="cart-column">
                    <p>₱<?php echo number_format($row['price'] * $row['quantity'], 2); ?></p>
                </div>
                <div class="cart-column">
                    <form action="cart_delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="delete" value="DELETE" id="delete-cart"> 
                    </form>
                </div>
            </div>
            

            <?php
        }
        
    } else {
      echo '<p class="empty-cart-content">Your cart is empty.</p>';
    }
    ?>
   
  </div>
  <div class="cart-total">
            <p>Total: ₱<?php echo number_format($totalPrice, 2); ?></p>
      </div>

  </section>
  </div>
  
  <?php include "footer.php"; ?>


</body>
</html>
