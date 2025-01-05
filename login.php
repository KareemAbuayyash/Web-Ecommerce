<?php
include('config.php');
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($con, $_POST['email']);
$pass = mysqli_real_escape_string($con, $_POST['password']);

$select = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email'") or die('Query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      if(password_verify($pass, $row['password'])){
          $_SESSION['user_id'] = $row['id'];
          $_SESSION['role'] = $row['role'];
          if($row['role'] == 'admin'){
              header('location:products.php'); // Redirect admin to the admin page
          } else {
              header('location:home.php'); // Redirect user to the user page
          }
      } else {
          $message[] = 'Incorrect email or password!';
      }
  } else {
      $message[] = 'Incorrect email or password!';
  }

}
?>

 <!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '<div class="message">'.$msg.'</div>';
   }
}
?>

<div class="form-container">
   <form action="" method="post">
      <h3>Login</h3>
      <input type="email" name="email" required placeholder="Email" class="box">
      <input type="password" name="password" required placeholder="Password" class="box">
      <input type="submit" name="submit" class="btn" value="Login">
      <p>Don't have an account? <a href="register.php">Register</a></p>
   </form>
</div>

</body>
</html>
