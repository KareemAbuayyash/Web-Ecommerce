<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit product</title>
<link rel="stylesheet" href="inde.css">
</head>
<body>
    <?php
    include('config.php');
    $ID = $_GET['id'];
    $up = mysqli_query($con, "SELECT * FROM prodd WHERE id=$ID");
    $data = mysqli_fetch_array($up);
    ?>
    <center>
        <div class="main">
            <form action="up.php" method="post" enctype="multipart/form-data">
                <h2>Edit product</h2>
                <input type="hidden" name='id' value='<?php echo $data['id'] ?>'>
                <br>
                <img id="currentImage" src="<?php echo $data['image']; ?>" width="150">
                <img id="output" width="150" style="display:none;" />
                <br>
                <input type="text" name='name' value='<?php echo $data['name'] ?>' placeholder="Name Product">
                <br>
                <input type="text" name='des' value='<?php echo $data['des'] ?>' placeholder="Description">
                <br>
                <input type="text" name='price' value='<?php echo $data['price'] ?>' placeholder="Price Product">
                <br>
                <input type="file" id="file" name='image' style='display:none;' onchange="loadFile(event)">
                <br>
                <label for="file">Update Image</label>
                <br><br>
                <button name='update' type='submit'>Edit Product</button>
                <br><br>
                <a href="products.php">Show All Products</a>
            </form>
        </div>
        <p>Developer By Kareem Abuayyash</p>
    </center>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.style.display = 'block';

            // Hide the current image when a new one is selected
            document.getElementById('currentImage').style.display = 'none';
        };
    </script>
</body>
</html>
