<?php

include 'functions.php';

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
   header('location:login.php');
};

if (isset($_POST['add_product'])) {
   $book_title = mysqli_real_escape_string($db, $_POST['book_title']);
   $author = mysqli_real_escape_string($db, $_POST['author']);
   $category = mysqli_real_escape_string($db, $_POST['category']);
   $book_description = mysqli_real_escape_string($db, $_POST['book_description']);
   $image = addslashes(file_get_contents($_FILES['book_image']['tmp_name']));
   $select_product_name = mysqli_query($db, "SELECT book_title FROM books WHERE book_title = '$book_title'") or die('query failed');
   $comment = " add book with title " . $book_title;
   $id = $_SESSION["admin_id"];
   $date = date("Y-m-d h:i:sa");
   $log_query = mysqli_query($db, "INSERT INTO log (adminID,  time, logComment) VALUES ('$id', '$date', '$comment')");

   if (mysqli_num_rows($select_product_name) > 0) {
      $message[] = 'product name already added';
   } else {
      $add_product_query = mysqli_query($db, "INSERT INTO books (book_title, author, category, book_description, book_image) VALUES('$book_title','$author','$category', '$book_description', '$image')") or die('query failed');
      if ($add_product_query) {
      } else {
         $message[] = 'product could not be added!';
      }
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($db, "SELECT book_image FROM books WHERE book_id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   $comment = "delete Book with title " . $delete_id;
   $id = $_SESSION["admin_id"];
   $date = date("Y-m-d h:i:sa");
   $log_query = mysqli_query($db, "INSERT INTO log (adminID, time, logComment) VALUES ('$id',  '$date', '$comment')");
   mysqli_query($db, "DELETE FROM books WHERE book_id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if (isset($_POST['update_product'])) {
   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_author = $_POST['update_author'];
   $update_category = $_POST['update_category'];
   $update_description = $_POST['update_description'];
   $update_image = addslashes(file_get_contents($_FILES['update_image']['tmp_name']));
   $select_product_name = mysqli_query($db, "SELECT book_title FROM books WHERE book_title = '$book_title'") or die('query failed');

   if (!empty($update_image)) {
      if ($update_image_size > 2000000) {
         $message[] = 'image file size is too large';
      } else {
         mysqli_query($db, "UPDATE books SET book_title = '$update_name', author = '$update_author', category = '$update_category', book_description = '$update_description', book_image = '$update_image' WHERE book_id = '$update_p_id'") or die('query failed');
      }
   }
   header('location:admin_products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Books | Admin</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/category.css">

</head>

<body>

   <?php include 'admin_header.php'; ?>
   <!-- product CRUD section starts  -->
   <section class="add-products">
      <h1 class="title">BOOKS</h1>
      <form action="" method="post" enctype="multipart/form-data">
         <h3>add book</h3>
         <input type="text" name="book_title" class="box" placeholder="enter book name" required>
         <input type="text" name="author" class="box" placeholder="enter book author" required>
         <input type="text" name="category" class="box" placeholder="enter book category" required>
         <input type="text" name="book_description" class="box" placeholder="enter book description" required>
         <input type="file" name="book_image" accept="image/jpg, image/jpeg, image/png" class="box" required>
         <input type="submit" value="add book" name="add_product" class="btn">
      </form>
   </section>

   <!-- product CRUD section ends -->
   <!-- show products  -->

   <section class="show-products">
      <div class="box-container">
         <?php
         $select_products = mysqli_query($db, "SELECT * FROM books") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
         ?>
               <div class="box">
                  <img class="active" src="data:image;base64,<?php echo base64_encode($fetch_products['book_image']); ?> ">
                  <div class="book_title"><?php echo $fetch_products['book_title']; ?></div>
                  <div class="author"><?php echo $fetch_products['author']; ?></div>
                  <div class="category"><?php echo $fetch_products['category']; ?></div>
                  <a href="admin_products.php?update=<?php echo $fetch_products['book_id']; ?>" class="option-btn">update</a>
                  <a href="admin_products.php?delete=<?php echo $fetch_products['book_id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>
   </section>

   <section class="edit-product-form">
      <?php
      if (isset($_GET['update'])) {
         $update_id = $_GET['update'];
         $update_query = mysqli_query($db, "SELECT * FROM books WHERE book_id = '$update_id'") or die('query failed');
         if (mysqli_num_rows($update_query) > 0) {
            while ($fetch_update = mysqli_fetch_assoc($update_query)) {
      ?>
               <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['book_id']; ?>">
                  <img class="active" src="data:image;base64,<?php echo base64_encode($fetch_update['book_image']); ?> ">
                  <input type="text" name="update_name" value="<?php echo $fetch_update['book_title']; ?>" class="box" required placeholder="enter book name">
                  <input type="text" name="update_author" value="<?php echo $fetch_update['author']; ?>" class="box" required placeholder="enter book author">
                  <input type="text" name="update_category" value="<?php echo $fetch_update['category']; ?>" class="box" required placeholder="enter book category">
                  <input type="text" name="update_description" value="<?php echo $fetch_update['book_description']; ?>" class="box" required placeholder="enter book description">
                  <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
                  <input type="submit" value="update" name="update_product" class="btn">
                  <input type="reset" value="cancel" id="close-update" class="option-btn">
               </form>
      <?php
            }
         }
      } else {
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
      ?>
   </section>
   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>
</body>

</html>