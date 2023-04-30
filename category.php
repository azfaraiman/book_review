<?php
$count = 0;
// connecto database
require_once "functions.php";
$con = mysqli_connect("localhost", "root", "", "book_review");

$query = "SELECT * FROM books WHERE category = 'Romance'";
$result = mysqli_query($con, $query);
if (!$result) {
  echo "Can't retrieve data " . mysqli_error($con);
  exit;
}

$query2 = "SELECT * FROM books WHERE category = 'Fantasy'";
$result2 = mysqli_query($con, $query2);
if (!$result2) {
  echo "Can't retrieve data " . mysqli_error($con);
  exit;
}

$query3 = "SELECT * FROM books WHERE category = 'Science Fiction'";
$result3 = mysqli_query($con, $query3);
if (!$result3) {
  echo "Can't retrieve data " . mysqli_error($con);
  exit;
}

$query4 = "SELECT * FROM books WHERE category = 'Thriller'";
$result4 = mysqli_query($con, $query4);
if (!$result4) {
  echo "Can't retrieve data " . mysqli_error($con);
  exit;
}

$query5 = "SELECT * FROM books WHERE category = 'Horror'";
$result5 = mysqli_query($con, $query5);
if (!$result5) {
  echo "Can't retrieve data " . mysqli_error($con);
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Category</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/category.css">
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

  <!-- bottom navbar  -->

  <nav class="bottom-navbar">
    <a href="#home" class="fas fa-home"></a>
    <a href="#featured" class="fas fa-list"></a>
    <a href="#arrivals" class="fas fa-tags"></a>
    <a href="#reviews" class="fas fa-comments"></a>
    <a href="#feedback" class="fas fa-feedback"></a>
  </nav>


  <section class="bookcategory" id="bookcategory">
    <h1 class="heading"><span>Book Categories</span></h1>
    <div class="bookcategory-slider">
      <div class="wrapper">
        <div class="box">
          <div class="image">
            <img src="image/romance/lovedeception.jpg" alt="">
          </div>
          <h1 style="margin-top:30px">Romance</h1>
          <!--Btn will bring to romance book section-->
          <a href="#romance" class="btn">View</a>
        </div>

        <div class="box">
          <div class="image">
            <img src="image/fantasy/shadowbone.jpg" alt="">
          </div>
          <h1 style="margin-top:30px">Fantasy</h1>
          <!--Btn will bring to fantasy book section-->
          <a href="#fantasy" class="btn">View</a>
        </div>

        <div class="box">
          <div class="image">
            <img src="image/sci-fi/loveHypothesis1.png" alt="">
          </div>
          <h1 style="margin-top:30px">Science Fiction</h1>
          <!--Btn will bring to sci-fiction book section-->
          <a href="#sci-fi" class="btn">View</a>
        </div>

        <div class="box">
          <div class="image">
            <img src="image/thriller/rebecca.jpg" alt="">
          </div>
          <h1 style="margin-top:30px">Thriller</h1>
          <!--Btn will bring to thriller book section-->
          <a href="#thriller" class="btn">View</a>
        </div>

        <div class="box">
          <div class="image">
            <img src="image/horror/hide-dont-seek.jpg" alt="">
          </div>
          <h1 style="margin-top:30px">Horror</h1>
          <!--Btn will bring to horror book section-->
          <a href="#horror" class="btn">View</a>
        </div>

      </div>
    </div>
    </div>
      
  </section>
  <!--ROMANCE BOOK-->
  <section class="bookview" id="bookview">
    <h1 id="romance" class="heading"><span>Romance Books</span></h1>
    <div class="bookview-slider">
      <div class="wrapper">
        <?php while ($query_row = mysqli_fetch_assoc($result)) { ?>
          <div class="row">
            <div class="box">
              <a href="book.php?book_id=<?php echo $query_row['book_id']; ?>">
                <img class="image" style="width:200px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($query_row['book_image']); ?> ">
                <h1 style="margin-top:30px"><?php echo ($query_row['book_title']); ?><h1>
                    <!--Btn will bring to book review-->
                    <a href="book.php?book_id=<?php echo $query_row['book_id']; ?>" class="btn">View</a>
              </a>
            </div>
          </div>
        <?php
          $count++;
          if ($count >= 100) {
            $count = 0;
            break;
          }
        } ?>

      </div>
    </div>
  </section>

  <!--FANTASY BOOK-->
  <section class="bookview" id="bookview">
    <h1 id="fantasy" class="heading"><span>Fantasy books</span></h1>
    <div class="bookview-slider">
      <div class="wrapper">
        <?php while ($query2_row = mysqli_fetch_assoc($result2)) { ?>
          <div class="row">
            <div class="box">
              <a href="book.php?book_id=<?php echo $query2_row['book_id']; ?>">
                <img class="image" style="width:200px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($query2_row['book_image']); ?> ">
                <h1 style="margin-top:30px"><?php echo ($query2_row['book_title']); ?><h1>
                    <!--Btn will bring to book review-->
                    <a href="book.php?book_id=<?php echo $query2_row['book_id']; ?>" class="btn">View</a>
              </a>
            </div>
          </div>
        <?php
          $count++;
          if ($count >= 100) {
            $count = 0;
            break;
          }
        } ?>
      </div>
    </div>
  </section>

  <!--SCIENCE FICTION-->
  <section class="bookview" id="bookview">
    <h1 id="sci-fi" class="heading"><span>Science Fiction books</span></h1>

    <div class="bookview-slider">
      <div class="wrapper">
        <?php while ($query3_row = mysqli_fetch_assoc($result3)) { ?>
          <div class="row">
            <div class="box">
              <a href="book.php?book_id=<?php echo $query3_row['book_id']; ?>">
                <img class="image" style="width:200px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($query3_row['book_image']); ?> ">
                <h1 style="margin-top:30px"><?php echo ($query3_row['book_title']); ?><h1>
                    <!--Btn will bring to book review-->
                    <a href="book.php?book_id=<?php echo $query3_row['book_id']; ?>" class="btn">View</a>
              </a>
            </div>
          </div>
        <?php
          $count++;
          if ($count >= 100) {
            $count = 0;
            break;
          }
        } ?>
      </div>
    </div>
  </section>

  <!--THRILLER-->
  <section class="bookview" id="bookview">
    <h1 id="thriller" class="heading"><span>Thriller books</span></h1>
    <div class="bookview-slider">
      <div class="wrapper">
        <?php while ($query4_row = mysqli_fetch_assoc($result4)) { ?>
          <div class="row">
            <div class="box">
              <a href="book.php?book_id=<?php echo $query4_row['book_id']; ?>">
                <img class="image" style="width:200px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($query4_row['book_image']); ?> ">
                <h1 style="margin-top:30px"><?php echo ($query4_row['book_title']); ?><h1>
                    <!--Btn will bring to book review-->
                    <a href="book.php?book_id=<?php echo $query4_row['book_id']; ?>" class="btn">View</a>
              </a>
            </div>
          </div>
        <?php
          $count++;
          if ($count >= 100) {
            $count = 0;
            break;
          }
        } ?>
      </div>
    </div>
  </section>

  <!--HORROR-->
  <section class="bookview" id="bookview">
    <h1 id="horror" class="heading"><span>Horror books</span></h1>
    <div class="bookview-slider">
      <div class="wrapper">
        <?php while ($query5_row = mysqli_fetch_assoc($result5)) { ?>
          <div class="row">
            <div class="box">
              <a href="book.php?book_id=<?php echo $query5_row['book_id']; ?>">
                <img class="image" style="width:200px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($query5_row['book_image']); ?> ">
                <h1 style="margin-top:30px"><?php echo ($query5_row['book_title']); ?><h1>
                    <!--Btn will bring to book review-->
                    <a href="book.php?book_id=<?php echo $query5_row['book_id']; ?>" class="btn">View</a>
              </a>
            </div>
          </div>
        <?php
          $count++;
          if ($count >= 100) {
            $count = 0;
            break;
          }
        } ?>
      </div>
    </div>
  </section>
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

</body>

</html>