<?php

include 'functions.php';

if (isset($_POST['submit'])) {
   $name = mysqli_real_escape_string($db, $_POST['username']);
   $email = mysqli_real_escape_string($db, $_POST['email']);
   $pass = mysqli_real_escape_string($db, hash('sha256',$_POST['password']));
   $cpass = mysqli_real_escape_string($db, hash('sha256', $_POST['cpassword']));
   $user_type = $_POST['user_type'];
   $pass2 = $_POST['password'];

   $uppercase    = preg_match('@[A-Z]@', $pass2);
   $lowercase    = preg_match('@[a-z]@', $pass2);
   $number       = preg_match('@[0-9]@', $pass2);
   $specialchars = preg_match('@[^\w]@', $pass2);

   $comment = " add admin  " . $name;
   $id = $_SESSION["admin_id"];
   $date = date("Y-m-d h:i:sa");
   $log_query = mysqli_query($db, "INSERT INTO log (adminID,  time, logComment) VALUES ('$id', '$date', '$comment')");

   if (!$uppercase || !$lowercase || !$number || !$specialchars || strlen($pass2) < 8) {
      $message[] = 'Password not strong';
   }else{
      $select_users = mysqli_query($db, "SELECT * FROM users WHERE email = '$email' AND password = '$pass'") or die('query failed');

      if(mysqli_num_rows($select_users) > 0){
         $message[] = 'admin already exist!';
      }else{
         if($pass != $cpass){
            $message[] = 'confirm password not matched!';
         }else{
            mysqli_query($db, "INSERT INTO users (username, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
            $message[] = 'new admin registered successfully!';
            header('location:admin_users.php');
         }
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register | Admin</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/registerlogin.css">
</head>

<body>

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      }
   }
   ?>

   <div class="form-container">
      <form action="" method="post">
         <h3>Add Admin</h3>
         <input type="text" name="username" placeholder="enter your name" autocomplete="off" required class="box">
         <input type="email" name="email" placeholder="enter your email" autocomplete="off" required class="box">
         <input type="password" name="password" placeholder="enter your password" autocomplete="off" required class="box">
         <input type="password" name="cpassword" placeholder="confirm your password" autocomplete="off" required class="box">
         <select name="user_type" class="box">
            <option value="admin">admin</option>
         </select>
         <input type="submit" name="submit" value="Add admin" class="btn">
      </form>
   </div>
</body>

</html>