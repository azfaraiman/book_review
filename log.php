<?php


@include 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Log | Admin</title>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style2.css">
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/category.css">
</head>

<body>

   <?php include 'admin_header.php'; ?>
   <div class="container">
      <section class="display-product-table">
         <table>
            <thead>
               <th>Admin Name</th>
               <th>description</th>
               <th>Time</th>
            </thead>
            <tbody>
               <?php
               $select_log = mysqli_query($db, "SELECT * FROM log JOIN users ON log.adminID = users.id");
               if (mysqli_num_rows($select_log) > 0) {
                  while ($row = mysqli_fetch_assoc($select_log)) {
               ?>
                     <tr>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['logComment']; ?></td>
                        <td><?php echo $row['time']; ?></td>
                     </tr>
               <?php
                  };
               };
               ?>
            </tbody>
         </table>
      </section>
   </div>
</body>

</html>