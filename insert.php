<?php

include('config.php');
if(isset($_POST['uploadphone'])){
    $NAME = $_POST['name'];
    $DES = $_POST['des'];
    $PRICE = $_POST['price'];
    $IMAGE = $_FILES['image'];
    $image_location = $_FILES['image']['tmp_name'];
    $image_name = $_FILES['image']['name'];
    $image_up =  "iamges/".$image_name;
    
    // Insert into prodd table first to get the id
    $insert_prodd = "INSERT INTO prodd (name, des, price, image) VALUES ('$NAME', '$DES', '$PRICE', '$image_up')";
    mysqli_query($con, $insert_prodd);
    $id = mysqli_insert_id($con);
    
    $insert_phone = "INSERT INTO phone (id, name, des, price, image) VALUES ('$id', '$NAME', '$DES',  '$PRICE', '$image_up')";
    mysqli_query($con, $insert_phone);

    if(move_uploaded_file($image_location, 'iamges/'.$image_name)){
        echo "<script>alert('Upload Product Complete')</script>";
    }else{
        echo "<script>alert('Upload Product Not Complete')</script>";
    }
    header('location: index.php');
}

if(isset($_POST['uploadheadphone'])){
    $NAME = $_POST['name'];
    $DES = $_POST['des'];
    $PRICE = $_POST['price'];
    $IMAGE = $_FILES['image'];
    $image_location = $_FILES['image']['tmp_name'];
    $image_name = $_FILES['image']['name'];
    $image_up =  "iamges/".$image_name;
    
    $insert_prodd = "INSERT INTO prodd (name, des, price, image) VALUES ('$NAME', '$DES', '$PRICE', '$image_up')";
    mysqli_query($con, $insert_prodd);
    $id = mysqli_insert_id($con);
    
    $insert_headphone = "INSERT INTO headphone (id, name, des, price, image) VALUES ('$id', '$NAME', '$DES',  '$PRICE', '$image_up')";
    mysqli_query($con, $insert_headphone);

    if(move_uploaded_file($image_location, 'iamges/'.$image_name)){
        echo "<script>alert('Upload Product Complete')</script>";
    }else{
        echo "<script>alert('Upload Product Not Complete')</script>";
    }
    header('location: index.php');
}

if(isset($_POST['uploadaccessories'])){
    $NAME = $_POST['name'];
    $DES = $_POST['des'];
    $PRICE = $_POST['price'];
    $IMAGE = $_FILES['image'];
    $image_location = $_FILES['image']['tmp_name'];
    $image_name = $_FILES['image']['name'];
    $image_up =  "iamges/".$image_name;
    
    $insert_prodd = "INSERT INTO prodd (name, des, price, image) VALUES ('$NAME', '$DES', '$PRICE', '$image_up')";
    mysqli_query($con, $insert_prodd);
    $id = mysqli_insert_id($con);
    
    $insert_accessories = "INSERT INTO accessories (id, name, des, price, image) VALUES ('$id', '$NAME', '$DES',  '$PRICE', '$image_up')";
    mysqli_query($con, $insert_accessories);

    if(move_uploaded_file($image_location, 'iamges/'.$image_name)){
        echo "<script>alert('Upload Product Complete')</script>";
    }else{
        echo "<script>alert('Upload Product Not Complete')</script>";
    }
    header('location: index.php');
}

?>
