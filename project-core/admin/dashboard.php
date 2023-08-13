<?php

  include '../components/connect.php';
  session_start();

  if (isset($_COOKIE['admin_id'])):
    $admin_id = $_COOKIE['admin_id'];
  else:
    $admin_id = '';
    $_SESSION['wrnng_msg'] = 'You need to login as an admin first';
    header('location: ./login.php');
    exit;
  endif;

  if (isset($_SESSION['wrnng_msg'])) {
    $warning_msg[] = $_SESSION['wrnng_msg'];
    unset($_SESSION['wrnng_msg']);
  }

  if (isset($_SESSION['scss_msg'])) {
    $success_msg[] = $_SESSION['scss_msg'];
    unset($_SESSION['scss_msg']);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="../styles/admin.css">

</head>
<body>

  <!-- header section starts -->

  <?php include '../components/admin-header.php' ?>

  <!-- header section ends -->


  <!-- dashboard section starts -->

    <section class="dashboard">

      <h1 class="heading">dashboard</h1>

      <div class="box-container">

        <div class="box">

          <?php

            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ? LIMIT 1");
            $select_profile->execute([$admin_id]);

            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

          ?>

          <h3>Welcome!</h3>
          <p><?= $fetch_profile['name'] ?></p>
          <a href="./update.php" class="btn">update profile</a>

        </div>

        <div class="box">

          <?php

            $count_listings = $conn->prepare("SELECT * FROM `properties`");
            $count_listings->execute();
            $total_listings = $count_listings->rowCount();

          ?>

          <h3><?= $total_listings ?></h3>
          <p>total listings</p>
          <a href="./listings.php" class="btn">view listings</a>

        </div>

        <div class="box">

          <?php

            $count_users = $conn->prepare("SELECT * FROM `users`");
            $count_users->execute();
            $total_users = $count_users->rowCount();

          ?>

          <h3><?= $total_users ?></h3>
          <p>total users</p>
          <a href="./users.php" class="btn">view users</a>

        </div>

        <div class="box">

          <?php

            $count_admins = $conn->prepare("SELECT * FROM `admins`");
            $count_admins->execute();
            $total_admins = $count_admins->rowCount();

          ?>

          <h3><?= $total_admins ?></h3>
          <p>total admins</p>
          <a href="./admins.php" class="btn">view admins</a>

        </div>

        <div class="box">

          <?php

            $count_messages = $conn->prepare("SELECT * FROM `messages`");
            $count_messages->execute();
            $total_messages = $count_messages->rowCount();

          ?>

          <h3><?= $total_messages ?></h3>
          <p>total messages</p>
          <a href="./messages.php" class="btn">view messages</a>

        </div>

      </div>

    </section>

  <!-- dashboard section ends -->


  <!-- sweetalert cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- custom js file link -->
  <script src="../scripts/admin.js"></script>

  <?php include '../components/messages.php' ?>

</body>
</html>