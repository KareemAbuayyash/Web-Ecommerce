<?php

include('config.php');

if (isset($_POST['update'])) {
    $ID = $_POST['id'];
    $NAME = $_POST['name'];
    $DES = $_POST['des'];
    $PRICE = $_POST['price'];
    $IMAGE = $_FILES['image'];
    $image_location = $_FILES['image']['tmp_name'];
    $image_name = $_FILES['image']['name'];
    $image_up = "iamges/" . $image_name;

    // Fetch the existing image path if no new image is uploaded
    if (empty($image_name)) {
        $existing_product = mysqli_query($con, "SELECT * FROM prodd WHERE id=$ID");
        $existing_product_data = mysqli_fetch_array($existing_product);
        $image_up = $existing_product_data['image'];
    } else {
        if (!move_uploaded_file($image_location, $image_up)) {
            echo "<script>alert('Failed to upload image');</script>";
            exit;
        }
    }

    // Update the product in the prodd table
    $update = "UPDATE prodd SET name='$NAME', des='$DES', price='$PRICE', image='$image_up' WHERE id=$ID";
    if (!mysqli_query($con, $update)) {
        echo "<script>alert('Failed to update product');</script>";
        exit;
    }

    // Function to update the product in the specific category table(s)
    $update_category_tables = function($con, $table, $ID, $NAME, $DES, $PRICE, $image_up) {
        $check_product = mysqli_query($con, "SELECT * FROM $table WHERE id='$ID'");
        if (mysqli_num_rows($check_product) > 0) {
            $update_category = "UPDATE $table SET name='$NAME', des='$DES', price='$PRICE', image='$image_up' WHERE id='$ID'";
            if (!mysqli_query($con, $update_category)) {
                echo "<script>alert('Failed to update product in $table');</script>";
                exit;
            }
        }
    };

    $update_category_tables($con, 'phone', $ID, $NAME, $DES, $PRICE, $image_up);
    $update_category_tables($con, 'headphone', $ID, $NAME, $DES, $PRICE, $image_up);
    $update_category_tables($con, 'accessories', $ID, $NAME, $DES, $PRICE, $image_up);

    echo "<script>alert('Update Product Complete');</script>";
    header('location: products.php');
}
?>
