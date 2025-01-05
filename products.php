<?php

include('config.php');
// Check if the user is logged in
$admin_logged_in = false;
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        $admin_logged_in = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <meta charset="UTF-8">
    <link rel="stylesheet" href="ww.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        body {
            background-color: #200016;
            font-family: "Cairo", sans-serif;
            margin-top: 50px;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            background-color: #291b24;
            color: #f1f1f1;
            border: 1px solid #e0e0e0;
            border-radius: 15px;
            box-shadow: 3px 3px 30px silver;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
            
        }
        .card img {
            width: 100%;
            height: 200px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .card-body {
            padding: 20px;
            text-align: center;
        }
        .search-bar {
            margin-bottom: 20px;
        }
        .btn-primary {
            border-radius: 50px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .category-filter {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .category-filter button {
            margin: 5px;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: bold;
        }
        .category-filter button.active {
            background-color: #0056b3;
            color: white;
        }
        h2 {
            color:white;
        }
    </style>
</head>
<body>
<header>
        <h2><a href="home.php" class="logo"> Kareem</a></h2>
        <ul>
            <li><a href="home.php"><i class="fa-solid fa-house"></i>Home</a></li>
            <li><a><i class="fas fa-box"></i>Product</a>
                <ul class="submenu">
                    <li><a href="phone.php">Phones</a></li>
                    <li><a href="headphone.php">Headphones</a></li>
                    <li><a href="accessories.php">Accessories</a></li>
                </ul>
            </li>
            <li><a href="#about-section"><i class="fas fa-info-circle"></i>About</a></li>
            <li><a href="#"><i class="fas fa-envelope"></i>Contact</a></li>
            <li><a  class="" href="cart.php"><i class="fa-solid fa-cart-shopping"></i>MyCart</a></li>
            <li><a  class="" href="index.php"><i class="fa-solid fa-circle-plus"></i>AddProduct</a></li>
            <?php if($admin_logged_in): ?>
                <li class="user-menu">
                    <a href="#" class="user-name"><i class="fas fa-user"></i> <?php echo $user['name']; ?></a>
                    <ul class="submenu">
                    <a href="logout.php">Logout</a>
                </ul>
                </li>
            <?php endif; ?>
        </ul>
    </header>
    <div class="container">
        <center>
            <h2>All Products to Admin</h2>
            
            <form method="GET" action="products.php" class="search-bar">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control" placeholder="Search for products..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                        

                    </div>
                </div>
            </form>

            <div class="category-filter">
                <button class="btn btn-outline-primary <?php echo !isset($_GET['category']) ? 'active' : ''; ?>" onclick="window.location.href='products.php'">All</button>
                <button class="btn btn-outline-primary <?php echo isset($_GET['category']) && $_GET['category'] == 'phone' ? 'active' : ''; ?>" onclick="window.location.href='products.php?category=phone'">Phones</button>
                <button class="btn btn-outline-primary <?php echo isset($_GET['category']) && $_GET['category'] == 'headphone' ? 'active' : ''; ?>" onclick="window.location.href='products.php?category=headphone'">Headphones</button>
                <button class="btn btn-outline-primary <?php echo isset($_GET['category']) && $_GET['category'] == 'accessories' ? 'active' : ''; ?>" onclick="window.location.href='products.php?category=accessories'">Accessories</button>
            </div>
        </center>

        <div class="row">
            <?php
            include('config.php');
            
            // Get the search term and category
            $search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
            $category = isset($_GET['category']) ? mysqli_real_escape_string($con, $_GET['category']) : '';

            // Determine the query based on the selected category and search term
            if ($category) {
                $table = mysqli_real_escape_string($con, $category);
                $query = "SELECT * FROM $table WHERE name LIKE '%$search%'";
            } else {
                $query = "SELECT * FROM prodd WHERE name LIKE '%$search%'";
            }
            
            $result = mysqli_query($con, $query);
            
            while($row = mysqli_fetch_array($result)) {
                echo "
                <div class='col-lg-3 col-md-4 col-sm-6 mb-4'>
                    <div class='card'>
                        <img src='{$row['image']}' class='card-img-top'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$row['name']}</h5>
                            <p class='card-text'>{$row['des']}</p>
                            <p class='card-text'>{$row['price']}₪</p>
                            <a href='delete.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                            <a href='update.php?id={$row['id']}' class='btn btn-primary'>Edit</a>
                         </div>
                    </div>
                </div>
                ";
            }
            ?>
        </div>
    </div>
</body>
</html>
