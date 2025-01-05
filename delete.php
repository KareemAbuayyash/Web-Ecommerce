<?php
include('config.php');
$ID = $_GET['id'];

// Retrieve the product details to determine the category
$product_result = mysqli_query($con, "SELECT * FROM prodd WHERE id=$ID");
$product = mysqli_fetch_array($product_result);

if ($product) {
    $product_name = $product['name'];

    // Delete the product from the prodd table
    mysqli_query($con, "DELETE FROM prodd WHERE id=$ID");

    // Delete the product from the specific category tables
    mysqli_query($con, "DELETE FROM phone WHERE name='$product_name'");
    mysqli_query($con, "DELETE FROM headphone WHERE name='$product_name'");
    mysqli_query($con, "DELETE FROM accessories WHERE name='$product_name'");
}

header('location: products.php');
?>
