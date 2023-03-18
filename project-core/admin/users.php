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
  <title>Users</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="../styles/admin.css">

</head>
<body>

  <!-- header section starts -->

  <?php include '../components/admin-header.php' ?>

  <!-- header section ends -->


  <!-- users section starts -->

  <section class="grid">

    <form action="" method="post" class="search-form">

      <input type="text" name="search_box" placeholder="search listings" maxlength="100">
      <button type="submit" name="search_btn" class="fas fa-search"></button>

    </form>

    <?php

      if (isset($_POST['search_box']) || isset($_POST['search_btn'])):

        $search_box = $_POST['search_box'];

        $select_users = $conn->prepare("SELECT * FROM `users` WHERE name LIKE '%{$search_box}%' OR email LIKE '%{$search_box}%' OR number LIKE '%{$search_box}%'");
        $select_users->execute();

      else:

        $select_users = $conn->prepare("SELECT * FROM `users`");
        $select_users->execute();

        if ($select_users->rowCount() > 0):

          while ($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)):
            $count_property = $conn->prepare("SELECT * FROM `properties` WHERE user_id = ?");
            $count_property->execute([$fetch_users['id']]);

            $total_properties = $count_property->rowCount();

    ?>

    <div class="box">

      <p>name: <span><?= $fetch_users['name'] ?></span></p>
      <p>email: <a href="mailto:<?= $fetch_users['email'] ?>"><?= $fetch_users['email'] ?></a></p>
      <p>number: <a href="tel:<?= $fetch_users['number'] ?>"><?= $fetch_users['number'] ?></a></p>
      <p>properties listed: <span><?= $total_properties ?></span></p>

      <form action="" method="post">
        <input type="hidden" name="delete_id" value="<?= $fetch_users['id'] ?>">
        <input type="submit" value="delete user" class="delete-btn">
      </form>

    </div>

    <?php

          endwhile;

        elseif (isset($_POST['search_box']) || isset($_POST['search_btn'])):
          echo '<p class="empty">no results found</p>';
        else:
          echo '<p class="empty">no users yet</p>';
        endif;

      endif;

    ?>

  </section>

  <!-- users section ends -->


  <!-- sweetalert cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- custom js file link -->
  <script src="../scripts/admin.js"></script>

  <?php include '../components/messages.php' ?>

</body>
</html>