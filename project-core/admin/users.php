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

  if (isset($_POST['delete'])):

    $delete_id = $_POST['delete_id'];

    $verify_delete = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0):

      $select_images = $conn->prepare("SELECT * FROM `properties` WHERE user_id = ?");
      $select_images->execute([$delete_id]);

      while ($fetch_images = $select_images->fetch(PDO::FETCH_ASSOC)):

        $delete_image_1 = $fetch_images['image_1'];
        $delete_image_2 = $fetch_images['image_2'];
        $delete_image_3 = $fetch_images['image_3'];
        $delete_image_4 = $fetch_images['image_4'];
        $delete_image_5 = $fetch_images['image_5'];

        unlink('../uploaded-files/' . $delete_image_1);

        if (!empty($delete_image_2)):
          unlink('../uploaded-files/' . $delete_image_2);
        endif;

        if (!empty($delete_image_3)):
          unlink('../uploaded-files/' . $delete_image_3);
        endif;

        if (!empty($delete_image_4)):
          unlink('../uploaded-files/' . $delete_image_4);
        endif;

        if (!empty($delete_image_5)):
          unlink('../uploaded-files/' . $delete_image_5);
        endif;

      endwhile;

      $delete_listings = $conn->prepare("DELETE FROM `properties` WHERE user_id = ?");
      $delete_listings->execute([$delete_id]);

      $delete_saved = $conn->prepare("DELETE FROM `saved` WHERE user_id = ?");
      $delete_saved->execute([$delete_id]);

      $delete_requests = $conn->prepare("DELETE FROM `requests` WHERE sender = ? OR receiver = ?");
      $delete_requests->execute([$delete_id, $delete_id]);

      $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
      $delete_users->execute([$delete_id]);

      $_SESSION['scss_msg'] = 'User deleted!';
      header('location: ./users.php');
      exit;
    else:
      $_SESSION['wrnng_msg'] = 'User deleted already';
      header('location: ./users.php');
      exit;
    endif;

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

    <h1 class="heading">users</h1>

    <form action="" method="post" class="search-form">

      <input type="text" name="search_box" placeholder="search users" maxlength="100">
      <button type="submit" name="search_btn" class="fas fa-search"></button>

    </form>

    <div class="box-container">

      <?php

        if (isset($_POST['search_box']) || isset($_POST['search_btn'])):

          $search_box = $_POST['search_box'];

          $select_users = $conn->prepare("SELECT * FROM `users` WHERE name LIKE '%{$search_box}%' OR email LIKE '%{$search_box}%' OR number LIKE '%{$search_box}%'");
          $select_users->execute();

        else:

          $select_users = $conn->prepare("SELECT * FROM `users`");
          $select_users->execute();

        endif;

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
          <input type="submit" value="delete user" name="delete" class="delete-btn" onclick="return confirm('delete this user?');">
        </form>

      </div>

      <?php

          endwhile;

        elseif (isset($_POST['search_box']) || isset($_POST['search_btn'])):
          echo '<p class="empty">no results found</p>';
        else:
          echo '<p class="empty">no users yet</p>';
        endif;

      ?>

    </div>

  </section>

  <!-- users section ends -->


  <!-- sweetalert cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- custom js file link -->
  <script src="../scripts/admin.js"></script>

  <?php include '../components/messages.php' ?>

</body>
</html>