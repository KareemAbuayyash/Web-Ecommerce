<?php
include('config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['add'])) {
    $product_id = $_POST['id'];
    $category = $_POST['category'];
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

   // Check if the product is already in the cart
$check_query = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id' AND category = '$category'";
$check_result = mysqli_query($con, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // If the product exists in the cart, increase the quantity
    $update_query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id' AND category = '$category'";
    mysqli_query($con, $update_query);
} else {
    // If the product is not in the cart, insert it with quantity 1
    $insert_query = "INSERT INTO cart (user_id, product_id, name, price, image, category, quantity) VALUES ('$user_id', '$product_id', '$name', '$price', '$image', '$category', 1)";
    mysqli_query($con, $insert_query);
}


    // Redirect to the cart page after successful operation
    header('Location: cart.php');
    exit();
}

// Retrieve product details for display
if (!isset($_GET['id']) || !isset($_GET['category'])) {
    die("Invalid request. Missing product ID or category.");
}

$ID = $_GET['id'];
$category = $_GET['category'];

switch ($category) {
    case 'phone':
        $up = mysqli_query($con, "SELECT * FROM phone WHERE id=$ID");
        break;
    case 'headphone':
        $up = mysqli_query($con, "SELECT * FROM headphone WHERE id=$ID");
        break;
    case 'accessories':
        $up = mysqli_query($con, "SELECT * FROM accessories WHERE id=$ID");
        break;
    default:
        die("Invalid category!");
}

$data = mysqli_fetch_array($up);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm To Buy Product</title>
    <style>
        .main {
            width: 50%;
            padding: 40px;
            box-shadow: 3px 3px 30px silver;
            margin-top: 50px;
            color: white;
        }
        body {
            background-color:#200016;
        }
        blockquote {
            color: white;
            width: 20%;
            padding: 20px;
            box-shadow: 3px 3px 30px silver;
            margin-top: 20px;
        }
        a {
            text-decoration: none;
            font-size: 20px;
            color: white;
            font-family: "Cairo", sans-serif;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <center>
        <div class="main">
             <form action="val.php" method="post">
                 <h2>Do you really want to buy the product?</h2>
                 <input type="hidden" name="id" value='<?php echo $data['id']?>'>
                 <input type="hidden" name="name" value='<?php echo $data['name']?>'>
                 <input type="hidden" name="price" value='<?php echo $data['price']?>'>
                 <input type="hidden" name="image" value="<?php echo $data['image']; ?>">
                 <input type="hidden" name="category" value="<?php echo $category; ?>">
                 <blockquote><img src="<?php echo $data['image']; ?>" height="75" width="75"></blockquote>
                 <blockquote><?php echo $data['name']; ?></blockquote>
                 <blockquote><?php echo $data['price']; ?></blockquote>
                 <button name="add" type="submit" class='btn btn-warning'>Confirm adding the product to the cart</button>
                 <br>
                 <a href="<?php echo $category; ?>.php">Back To Products</a>
             </form>
        </div>
    </center>
</body>
</html>
