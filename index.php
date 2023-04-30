<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/qrStyle.css">

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
    <main class="container">
        <section class="home" id="home">
            <div class="row">

                <div class="content">
                    <h3>Start Reviewing Book With Us</h3>
                    <p>If you’re want to be one of us to give a review towards book that have you read !</p>
                    <a href="category.php" class="book-btn">Review</a>
                </div>

                <div class="swiper books-slider">
                    <div class="swiper-wrapper">
                        <a href="#" class="swiper-slide"><img src="image/horror/hide-dont-seek.jpg" alt=""></a>
                        <a href="#" class="swiper-slide"><img src="image/romance/lovedeception.jpg" alt=""></a>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <<div class="container">
        <div class="text-qr">
            <h2>The Highest Rated Book</h1>
             <div>
                    <?php

                        include('functions.php');
                        include('phpqrcode/qrlib.php');
                        //global $db;

                        $tempDir = "image/";

                        $query = mysqli_query($db, "SELECT AVG(reviews.rating), books.book_title FROM books JOIN reviews WHERE books.book_id = reviews.book_id GROUP BY reviews.book_id ORDER BY AVG(reviews.rating) DESC limit 5");
                        $num = 1;
                        $ayat = "Top average rating\n\n";

                        while($result = mysqli_fetch_assoc($query)){
                            $ayat.="$num.$result[book_title]\n";
                            $num++;
                        }
                        QRcode::png($ayat, $tempDir.'010_merged.png');
                        echo "<img src='$tempDir"."010_merged.png'' />";

                        ?>
                </div>
        </div>
    </div>
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