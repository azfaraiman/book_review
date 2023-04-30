<?php
include('functions.php');

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['user']);
  header("location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Books </title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/product.css">
  <link rel="stylesheet" href="css/reviews.css">
</head>

<body>
  <!-- header section starts  -->
  <header class="header">
    <div class="header-1">
      <a href="#" class="logo"> <i class="fas fa-book"></i> BooksShow </a>
      <div class="icons">
        <a href="login.php">
          <div id="login-btn" class="fas fa-user"></div>
        </a>
      </div>
    </div>

    <div class="header-2">
      <nav class="navbar">
        <a href="./index.php">home</a>
        <a href="./category.php">category</a>
        <a href="./aboutUs.php">About Us</a>
      </nav>
    </div>
  </header>

  <!-- header section ends -->
  <?php
  $con = mysqli_connect("localhost", "root", "", "book_review");
  $id = $_GET['book_id'];
  $sel = "SELECT * FROM books WHERE book_id='$id'";
  $sl = $con->query($sel);
  while ($row = $sl->fetch_assoc()) {

  ?>
    <!-- bottom navbar  -->
    <nav class="bottom-navbar">
      <a href="#home" class="fas fa-home"></a>
      <a href="#featured" class="fas fa-list"></a>
      <a href="#arrivals" class="fas fa-tags"></a>
      <a href="#reviews" class="fas fa-comments"></a>
      <a href="#feedback" class="fas fa-feedback"></a>
    </nav>
    <main class="container">
      <!-- Left Column / Headphones Image -->
      <div class="left-column">
        <img class="active" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['book_image']); ?> ">
      </div>

      <!-- Right Column -->
      <div class="right-column">
        <!-- Product Description -->
        <div class="product-description">
          <span><?php echo $row['category']; ?></span>
          <h1><?php echo $row['book_title']; ?></h1>
          <h2><?php echo $row['author']; ?></h2><br>
          <p><?php echo $row['book_description']; ?></p>
          <p style="margin-top:100px;"> Scroll down to review &nbsp;&nbsp;&nbsp; v</p>
        </div>
      </div>
    </main>

    <script>
      reviews_book_id = <?= $row['book_id'] ?>;
      fetch("reviews.php?book_id=" + reviews_book_id).then(response => response.text()).then(data => {
        document.querySelector(".reviews").innerHTML = data;
        document.querySelector(".reviews .write_review_btn").onclick = event => {
          event.preventDefault();
          document.querySelector(".reviews .write_review").style.display = 'block';
          document.querySelector(".reviews .write_review input[name='name']").focus();
        };
        document.querySelector(".reviews .write_review form").onsubmit = event => {
          event.preventDefault();
          fetch("reviews.php?book_id=" + reviews_book_id, {
            method: 'POST',
            body: new FormData(document.querySelector(".reviews .write_review form"))
          }).then(response => response.text()).then(data => {
            document.querySelector(".reviews .write_review").innerHTML = data;
          });
        };
      });
    </script>

  <?php } ?>
  <!-- reviews section starts  -->
  <div style="margin-top:200px;" class="reviews"></div>
  <!-- reviews section ends -->
  <!-- footer section starts  -->
  <section class="footer">
    <div class="box-container">

      <div class="box">
        <h3>quick links</h3>
        <a href="index.php"> <i class="fas fa-arrow-right"></i> Home </a>
        <a href="category.php"> <i class="fas fa-arrow-right"></i> Category </a>
        <a href="aboutUs.php"> <i class="fas fa-arrow-right"></i> About Us </a>
      </div>

      <div class="box">
        <h3>contact info</h3>
        <a href="#"> <i class="fas fa-phone"></i> 0194407695 </a>
        <a href="#"> <i class="fas fa-envelope"></i> azfaraiman02@gmail.com </a>
      </div>
    </div>
    <div class="share">
    </div>
  </section>

  <!-- footer section ends -->
  <!-- Scripts -->
  <script src="js/script.js" charset="utf-8"></script>
  <script src="js/product.js"></script>
</body>

</html>