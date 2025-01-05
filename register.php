<?php
include('config.php');

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($con, $_POST['name']);
   $email = mysqli_real_escape_string($con, $_POST['email']);
   $pass = mysqli_real_escape_string($con, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($con, md5($_POST['cpassword']));

   $role = 'user'; // Default role is 'user'
   if(isset($_POST['role']) && $_POST['role'] == 'admin') {
       $role = 'admin'; // Set role to 'admin' if specified
   }

   $select = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email'") or die('Query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'User already exists!';
   }else{
         if ($pass !== $cpass) {
            $message[] = 'Passwords do not match!';
         } else {
            $hashed_password = password_hash($pass, PASSWORD_BCRYPT);
            mysqli_query($con, "INSERT INTO `users`(name, email, password, role) VALUES('$name', '$email', '$hashed_password', '$role')") or die('Query failed');
            $message[] = 'Registered successfully!';
            header('location:login.php');
         }
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
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
      <h3>Create a New Account</h3>
      <input type="text" name="name" required placeholder="Username" class="box">
      <input type="email" name="email" required placeholder="Email" class="box">
      <input type="password" name="password" required placeholder="Password" class="box">
      <input type="password" name="cpassword" required placeholder="Confirm Password" class="box">
      <input type="hidden" name="role" value="user"> <!-- Change to 'admin' for admin registration -->
      <input type="submit" name="submit" class="btn" value="Create Account">
      <p>Already have an account? <a href="login.php">Login</a></p>
   </form>
</div>

</body>
</html>
