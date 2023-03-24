<?php

  include '../components/connect.php';

  if (isset($_COOKIE['admin_id'])):
    $admin_id = $_COOKIE['admin_id'];
  else:
    $admin_id = '';
    header('location: ../login.php');
    return;
  endif;

  if (isset($_POST['delete'])):

    $delete_id = $_POST['delete_id'];

    $verify_delete = $conn->prepare("SELECT * FROM `admins` WHERE id = ? LIMIT 1");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0):

      $delete_admin = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
      $delete_admin->execute([$delete_id]);
      $success_msg[] = 'admin deleted';

    else:
      $warning_msg[] = 'admin deleted already';
    endif;

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

            if ($fetch_admins['id'] == $admin_id):

      ?>

      <div class="box" style="order: -1;">
        <p>name: <span><?= $fetch_admins['name'] ?></span></p>
        <div class="flex-btn">
          <a href="./update.php" class="btn">update</a>
          <a href="./register.php" class="option-btn">register</a>
        </div>
      </div>

      <?php

            else:

      ?>

      <div class="box">
        <p>name: <span><?= $fetch_admins['name'] ?></span></p>
        <form action="" method="post">
          <input type="hidden" name="delete_id" value="<?= $fetch_admins['id'] ?>">
          <input type="submit" value="delete admin" name="delete" class="delete-btn" onclick="return confirm('delete this admin?');">
        </form>
      </div>

      <?php

            endif;

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