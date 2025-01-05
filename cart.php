<?php
include('config.php');

// Check if the user is logged in
$user_logged_in = false;
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        $user_logged_in = true;
    }
}

// Fetch the cart items for the logged-in user
$cart_items = [];
$total_price = 0; // Initialize total price
if ($user_logged_in) {
// cart.php (Fetching items)
$cart_query = "SELECT * FROM cart WHERE user_id = '$user_id'";
    $cart_result = mysqli_query($con, $cart_query);
    while($row = mysqli_fetch_array($cart_result)) {
        $cart_items[] = $row;
        $total_price += $row['price'] * $row['quantity']; // Calculate the total price based on quantity
    }
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
<link rel="stylesheet" href="ww.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyCart</title>
    <style>
        body{
            background-color:#200016;
        }
        h3 {
            font-family: 'Cairo', sans-serif;
            font-weight: bold;
            color: white;
        }
        main {
            width: 40%;
            margin-top: 30px;
        }
        table {
            box-shadow: 1px 1px 10px silver;
            margin-top: 50px;
        }
        thead {
            background-color: blanchedalmond;
            color: darkblue;
            text-align: center;
        }
        tbody {
            text-align: center;
            color: white;
        }
        a{
            text-decoration: none;
            font-size: 15px;
            color:whitesmoke;
            font-family: "Cairo", sans-serif;
            font-weight: bold;
        }   
        footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px;
            position: fixed;
            left: 0;
            bottom: 0;
        }
        .navbar-brand{
            color: black;
            font-size: 15px;
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
        <li><a href="home.php#about-section"><i class="fas fa-info-circle"></i>About</a></li>
        <li><a href="#"><i class="fas fa-envelope"></i>Contact</a></li>
        <li><a  class="" href="cart.php"><i class="fa-solid fa-cart-shopping"></i>MyCart</a></li>

        <?php if($user_logged_in): ?>
                <li class="user-menu">
                    <a href="#" class="user-name"><i class="fas fa-user"></i> <?php echo $user['name']; ?></a>
                    <ul class="submenu">
                    <a href="logout.php">Logout</a>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </header>
    <center>
        <h3>Your reserved products</h3>
    </center>
    <center>
    <main>
        <table class='table'>
            <thead>
                <tr>
                    <th scope='col'>Product photo</th>
                    <th scope='col'>Product name</th>
                    <th scope='col'>Product price</th>
                    <th scope='col'>Quantity</th>
                    <th scope='col'>Total</th>
                    <th scope='col'>Delete product</th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($cart_items as $item) { ?>
    <tr>
        <td><img src="<?php echo $item['image']; ?>" height="45" width="60"></td>
        <td><?php echo $item['name']; ?></td>
        <td><?php echo $item['price']; ?>₪</td>
        
        <!-- Quantity update form -->
        <td>
            <form action="update_quantity.php" method="POST">
                <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </td>

        <!-- Total price for this item -->
        <td><?php echo $item['price'] * $item['quantity']; ?>₪</td>
        
        <!-- Delete button -->
        <td><a href="del_cart.php?id=<?php echo $item['cart_id']; ?>" class="btn btn-danger">Delete</a></td>
    </tr>
<?php } ?>
</tbody>
        </table>
        <!-- Display Total Price -->
        <h4 style="color: white;">Total: <?php echo $total_price; ?>₪</h4>
    </main>
</center>
    <footer>
<a id="aa" class="navbar-brand" href="https://www.instagram.com/kareem_abuayyash/">Developer By Kareem Abuayyash</a>
  </footer>
</body>
</html>
