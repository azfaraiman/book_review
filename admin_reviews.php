<?php

include 'functions.php';

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $comment = " delete reviews with ID " . $delete_id;
   $id = $_SESSION["admin_id"];
   $date = date("Y-m-d h:i:sa");
   $log_query = mysqli_query($db, "INSERT INTO log (adminID,  time, logComment) VALUES ('$id', '$date', '$comment')");
   mysqli_query($db, "DELETE FROM reviews WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_reviews.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reviews | Admin</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <?php include 'admin_header.php'; ?>

   <section class="users">
      <h1 class="title"> Reviews </h1>
      <div class="box-container">
         <?php
         $select_users = mysqli_query($db, "SELECT r.id, b.book_title, r.name, r.rating, r.content FROM reviews r, books b WHERE r.book_id = b.book_id;") or die('query failed');
         while ($fetch_users = mysqli_fetch_assoc($select_users)) {
         ?>
            <div class="box">
               <p> Book : <span><?php echo $fetch_users['book_title']; ?></span> </p>
               <p> id : <span><?php echo $fetch_users['id']; ?></span> </p>
               <p> username : <span><?php echo $fetch_users['name']; ?></span> </p>
               <p> rating : <span><?php echo $fetch_users['rating']; ?></span> </p>
               <p> content : <span><?php echo $fetch_users['content']; ?></span> </p>
               <a href="admin_reviews.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this review?');" class="delete-btn">delete review</a>
            </div>
         <?php
         };
         ?>
      </div>
   </section>
   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>
</body>

</html>