<?php

  include '../components/connect.php';

  if (isset($_COOKIE['admin_id'])):
    $admin_id = $_COOKIE['admin_id'];
  else:
    $admin_id = '';
    header('location: ../login.php');
    return;
  endif;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admins</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="../styles/admin.css">

</head>
<body>

  <!-- header section starts -->

  <?php include '../components/admin-header.php' ?>

  <!-- header section ends -->


  <!-- admins section starts -->

  <section class="grid">

    <h1 class="heading">admins</h1>

    <form action="" method="post" class="search-form">

      <input type="text" name="search_box" placeholder="search listings" maxlength="100">
      <button type="submit" name="search_btn" class="fas fa-search"></button>

    </form>

    <div class="box-container">

      <?php

        if (isset($_POST['search_box']) || isset($_POST['search_btn'])):

          $search_box = $_POST['search_box'];

          $select_admins = $conn->prepare("SELECT * FROM `admins` WHERE name LIKE '%{$search_box}%'");
          $select_admins->execute();

        else:

          $select_admins = $conn->prepare("SELECT * FROM `admins`");
          $select_admins->execute();

        endif;

        if ($select_admins->rowCount() > 0):

          while ($fetch_admins = $select_admins->fetch(PDO::FETCH_ASSOC)):

      ?>



      <?php

          endwhile;

        elseif (isset($_POST['search_box']) || isset($_POST['search_btn'])):
          echo '<p class="empty">no results found</p>';
        else:
          echo '<p class="empty">no admins yet</p>';
        endif;

      ?>

    </div>

  </section>

  <!-- admins section ends -->


  <!-- sweetalert cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- custom js file link -->
  <script src="../scripts/admin.js"></script>

  <?php include '../components/messages.php' ?>

</body>
</html>