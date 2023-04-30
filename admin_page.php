<?php

include 'functions.php';

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Page | Admin</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/category.css">
</head>

<body>

   <?php include 'admin_header.php'; ?>
   <!-- admin dashboard section starts  -->
   <section class="dashboard">
      <h1 class="title">dashboard</h1>
      <div class="box-container">
         <div class="box">
            <?php
            $select_products = mysqli_query($db, "SELECT * FROM books") or die('query failed');
            $number_of_products = mysqli_num_rows($select_products);
            ?>
            <h3><?php echo $number_of_products; ?></h3>
            <p>products added</p>
         </div>

         <div class="box">
            <?php
            $select_admins = mysqli_query($db, "SELECT * FROM users WHERE user_type = 'admin'") or die('query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
            ?>
            <h3><?php echo $number_of_admins; ?></h3>
            <p>admin users</p>
         </div>

         <div class="box">
            <?php
            $select_account = mysqli_query($db, "SELECT * FROM users") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
            ?>
            <h3><?php echo $number_of_account; ?></h3>
            <p>total accounts</p>
         </div>
      </div>
   </section>

   <!-- admin dashboard section ends -->
   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>
</body>

</html>