<?php
include('config.php');

if(isset($_POST['cart_id']) && isset($_POST['quantity'])) {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    // Update the quantity in the cart
// update_quantity.php (Use cart_id)
$update_query = "UPDATE cart SET quantity = '$quantity' WHERE cart_id = '$cart_id' AND user_id = '$_SESSION[user_id]'";
    mysqli_query($con, $update_query);
}

// Redirect back to the cart page
header('Location: cart.php');
exit();
?>
