<?php
$min  = 1;
$max  = 10;
$num1 = rand( $min, $max );
$num2 = rand( $min, $max );
include 'functions.php';

if (isset($_POST['submit_email'])) {

   $email = mysqli_real_escape_string($db, $_POST['email']);

   $select_users = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {

      $row = mysqli_fetch_assoc($select_users);

      if ($row['user_type'] == 'admin') {

         $_SESSION['admin_name'] = $row['username'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');
      }
   } else {
      $message[] = 'incorrect email or password!';
   }
}

if (isset($_POST['submit'])) {

   $test=$_REQUEST["test"];
   $number1=$_REQUEST["no1"];
   $number2=$_REQUEST["no2"];
   $total=$number1+$number2;

   $email = mysqli_real_escape_string($db, $_POST['email']);
   $pass = mysqli_real_escape_string($db, hash('sha256', $_POST['password']));

   $select_users = mysqli_query($db, "SELECT * FROM users WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0 && $total==$test) {

      $row = mysqli_fetch_assoc($select_users);

      if ($row['user_type'] == 'admin') {

         $comment = "Login at ";
         $id = $row['id'];
         $date = date("Y-m-d h:i:sa");
         $log_query = mysqli_query($db, "INSERT INTO log (adminID, logComment, time) VALUES ('$id', '$comment', '$date')");

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');
      }
   } 
   
   else if ($total!=$test){
      $message[] = 'incorrect captcha!';
   }
   else {
      $message[] = 'incorrect email or password!';
   }

   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login | Admin</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/registerlogin.css">
   <script type='text/javascript'>
function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
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

     
<form method="POST">
         <h3>Login Admin</h3>
         <input type="email" name="email" placeholder="enter your email" class="box" autocomplete="off" required >
         <input type="password" name="password" placeholder="enter your password"  class="box" autocomplete="off" required>
         <p style="margin-bottom: 10px;">Math Captcha</p>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <label style="font-size:x-large;" for="quiz"
                                   class="col-sm-3 col-form-label">
                                <?php echo $num1 . '+' . $num2; ?>
                            </label>
                            <div class="col-sm-9">
                                <input type="hidden" name="no1" value="<?php echo $num1 ?>">
                                <input type="hidden" name="no2" value="<?php echo $num2 ?>">
                                <input type="text" name="test" placeholder="enter captcha answer" class="box" autocomplete="off" id="quiz" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input style="margin-bottom: 30px;" type="submit" name="submit" class="btn" id="submit">
            <p>Don't have an account? <a href="register.php">register now</a></p>
         <p><a href="index.php">To Website</a></p>
      </form>
</body>
</html>