<?php
include('config.php');


if (isset($_POST['add']) && isset($_SESSION['user_id'])) {
    $NAME = $_POST['name'];
    $PRICE = $_POST['price'];
    $IMAGE = $_POST['image'];
    $CATEGORY = $_POST['category'];
    $user_id = $_SESSION['user_id']; // Get the user ID from the session

    // Ensure the image path is not empty
    if (!empty($IMAGE)) {
        // Copy the current image to the cart images folder
        $image_up = "iamges/" . basename($IMAGE);
        if (!file_exists('iamges')) {
            mkdir('iamges', 0777, true);
        }
        copy($IMAGE, $image_up);

        // Insert the product with the user ID
        $insert = "INSERT INTO cart (user_id, name, price, image, category) VALUES ('$user_id', '$NAME', '$PRICE', '$image_up', '$CATEGORY')";
        if (mysqli_query($con, $insert)) {
            header('Location: cart.php');
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Image path is empty.";
    }
}
?>
