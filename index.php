<?php
 include('config.php');
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
   header('location:login.php');
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping</title>
    <link rel="stylesheet" href="inde.css">
    <style>
        img#preview {
            display: none;
            max-width: 310px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <center>
        <div class="main">
            <form action="insert.php" method="post" enctype="multipart/form-data">
                <h2>موقع تسويقي اونلاين </h2>
                <img src="logo.png" alt="logo" width="310px">
                <img id="preview" src="#" alt="Image Preview" width="200px">
                <br>
                <input type="text" name="name" placeholder="Name Product">
                <br>
                <input type="text" name="des" placeholder="Description">
                <br>
                <input type="text" name="price" placeholder="Price Product">
                <br><br>
                <input type="file" id="file" name="image" style="display:none;" onchange="previewImage(event);">
                <label for="file">Choose Image</label>
                <br><br>
                <button name="uploadphone"> Upload to Phone</button>
                <button name="uploadheadphone"> Upload to HeadPhone</button>
                <button name="uploadaccessories"> Upload to Accessories</button>
                <br><br>
                <a href="products.php">Show All Products</a>
                <br>
                <a href="home.php"><i class="fa-solid fa-house"></i>Home</a>
                <br>
                <a href="logout.php">Logout</a>
            </form>
        </div>
        <p>Developer By Kareem Abuayyash</p>
    </center>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = document.getElementById('file').files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "#";
                preview.style.display = 'none';
            }
        }
    </script>
</body>
</html>
