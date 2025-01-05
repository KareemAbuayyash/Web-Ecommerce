<?php

include('config.php');

// Check if the user is logged in
$user_logged_in = false;
$role = ''; // Initialize role
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        $user_logged_in = true;
        $role = $user['role']; // Get the user's role
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Kareem </title>
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
            <?php if($user_logged_in): ?>
                <li class="user-menu">
                    <a href="#" class="user-name"><i class="fas fa-user"></i> <?php echo $user['name']; ?></a>
                    <ul class="submenu">
                        <?php if($role === 'admin'): ?> <!-- Check if the user is an admin -->
                            <li><a href="products.php"><i class="fas fa-cogs"></i> Admin Dashboard</a></li>
                        <?php endif; ?>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </header>

    <section class="main">
        <img src="img/stars1.png" id="stars">
        <h2 class=" al">Kareem </h2>
        <img src="img/moon2.png" id="moon">
        <img src="img/mountains3.png" id="mountains3">
        <img src="img/mountains4.png" id="mountains4">
        <img src="img/river5.png" id="river">
        <img src="img/boat6.png" id="boat">
        <img src="img/mountains7.png" id="mountains7">

    </section>
    <section class="popular-items py-5">
    <div class="container">
        <h2 class="mb-4 text-center">Popular items this season</h2>
        <div id="popularCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                include('config.php');

                // Fetch popular items from the database
                $popular_query = "SELECT * FROM prodd ORDER BY id DESC LIMIT 9"; // Adjust to fetch the desired number of items
                $popular_result = mysqli_query($con, $popular_query);

                $products = [];
                while ($row = mysqli_fetch_assoc($popular_result)) {
                    $products[] = $row;
                }

                $chunks = array_chunk($products, 3); // Group products into chunks of 3
                $active = true;

                foreach ($chunks as $chunk) {
                    echo '<div class="carousel-item' . ($active ? ' active' : '') . '">';
                    echo '<div class="d-flex justify-content-center">';
                    foreach ($chunk as $product) {
                        echo '<div class="mx-2 text-center">';
                        echo '<img src="' . htmlspecialchars($product['image']) . '" class="img-fluid rounded" style="height: 200px; width: auto; object-fit: cover;" alt="' . htmlspecialchars($product['name']) . '">';
                        echo '<p class="mt-2">' . htmlspecialchars($product['name']) . '</p>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '</div>';
                    $active = false;
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#popularCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#popularCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

    <section class="content" id="about-section">
        <h2>Lorem ipsum dolor sit amet.</h2>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi quam incidunt voluptatem! Iste,
            perspiciatis
            in. Aut, ratione asperiores pariatur culpa fugit inventore molestiae ab. Exercitationem numquam vero
            omnis
            hic eligendi a iure earum similique sed inventore, atque ab quis doloremque quibusdam aliquam labore
            repellendus dolor vitae? Delectus magni nobis commodi laboriosam, aperiam aspernatur numquam deserunt,
            excepturi saepe nam debitis, consequatur provident minima quia architecto sunt reiciendis ex sit id.
            Quidem
            minus voluptas, atque numquam facere perferendis, adipisci animi officiis suscipit, illo nisi
            consequatur
            ducimus. Dolore, libero magnam tempora aspernatur natus ex saepe molestias labore nobis architecto
            optio,
            assumenda, incidunt vero!</p><br>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi quam incidunt voluptatem! Iste,
            perspiciatis
            in. Aut, ratione asperiores pariatur culpa fugit inventore molestiae ab. Exercitationem numquam vero
            omnis
            hic eligendi a iure earum similique sed inventore, atque ab quis doloremque quibusdam aliquam labore
            repellendus dolor vitae? Delectus magni nobis commodi laboriosam, aperiam aspernatur numquam deserunt,
            excepturi saepe nam debitis, consequatur provident minima quia architecto sunt reiciendis ex sit id.
            Quidem
            minus voluptas, atque numquam facere perferendis, adipisci animi officiis suscipit, illo nisi
            consequatur
            ducimus. Dolore, libero magnam tempora aspernatur natus ex saepe molestias labore nobis architecto
            optio,
            assumenda, incidunt vero!</p><br>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi quam incidunt voluptatem! Iste,
            perspiciatis
            in. Aut, ratione asperiores pariatur culpa fugit inventore molestiae ab. Exercitationem numquam vero
            omnis
            hic eligendi a iure earum similique sed inventore, atque ab quis doloremque quibusdam aliquam labore
            repellendus dolor vitae? Delectus magni nobis commodi laboriosam, aperiam aspernatur numquam deserunt,
            excepturi saepe nam debitis, consequatur provident minima quia architecto sunt reiciendis ex sit id.
            Quidem
            minus voluptas, atque numquam facere perferendis, adipisci animi officiis suscipit, illo nisi
            consequatur
            ducimus. Dolore, libero magnam tempora aspernatur natus ex saepe molestias labore nobis architecto
            optio,
            assumenda, incidunt vero!</p><br>
    </section>
    <script>
        // Check for the about-section fragment identifier in the URL and scroll to it
        window.addEventListener('DOMContentLoaded', function () {
            var targetSection = window.location.hash.substring(1); // Remove the '#' from the hash
            if (targetSection === 'about-section') {
                var element = document.getElementById(targetSection);
                if (element) {
                    element.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    </script>
    

    <script src="main.js"></script>
    <footer>
<a id="aa" class="navbar-brand" href="https://www.instagram.com/kareem_abuayyash/">Developer By Kareem Abuayyash</a>
  </footer>
</body>


</html>