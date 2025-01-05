<?php
include('config.php');

// del_cart.php (Use cart_id)
// del_cart.php
$ID = $_GET['id'];
mysqli_query($con, "DELETE FROM cart WHERE cart_id = $ID");

header('location: cart.php');

?>
