<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="ww.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Kareem</title>
   
</head>
<header>
    <h2><a href="home.php" class="logo">Kareem</a></h2>
    <ul>
        <li><a href="home.php"><i class="fa-solid fa-house"></i>Home</a></li>
        <li><a><i class="fas fa-box"></i>Product</a>
            <ul class="submenu">
                <li><a href="phone.php">Phones</a></li>
                <li><a href="headphone.php">Headphones</a></li>
                <li><a href="accessories.php">Accessories</a></li>
            </ul>
        </li>
        <li><a href="home.php#about-section"><i class="fas fa-info-circle"></i>About</a></li>
        <li><a href="#"><i class="fas fa-envelope"></i>Contact</a></li>
        <li><a class="" href="cart.php"><i class="fa-solid fa-cart-shopping"></i>MyCart</a></li>
        <li>
            <form method="GET" action="phone.php">
                <input type="text" name="search" placeholder="Search for phone...">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </li>
    </ul>
</header>
<body>
<div class="container">
    <div class="row">
        <?php
        
        include('config.php');

        $search_query = "";
        if (isset($_GET['search'])) {
            $search = mysqli_real_escape_string($con, $_GET['search']);
            $search_query = "WHERE name LIKE '%$search%'";
        }

        $result = mysqli_query($con, "SELECT * FROM phone $search_query");
        while($row = mysqli_fetch_array($result)) {
            echo "
            <div class='col-lg-3 col-md-4 col-sm-6 mb-4'>
                <div class='card'>
                    <img src='{$row['image']}' class='card-img-top'>
                    <div class='card-body'>
                        <h2 class='card-title'>{$row['name']}</h2>
                        <h5 class='card-text'>{$row['des']}</h5>
                        <p class='card-text'>{$row['price']}₪</p>
                        <a href='val.php?id=$row[id]&category=phone' class='btn btn-success'>Add Product To Cart</a>
                    </div>
                </div>
            </div>
            ";
        }
        ?>
        
    </div>
</div>
<footer>
            <a id="aa" class="navbar-brand" href="https://www.instagram.com/kareem_abuayyash/">Developer By Kareem Abuayyash</a>
        </footer>
</body>
</html>
