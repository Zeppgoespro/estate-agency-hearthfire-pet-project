<?php

  include '../components/connect.php';

  if (isset($_COOKIE['admin_id'])):
    $admin_id = $_COOKIE['admin_id'];
  else:
    $admin_id = '';
    header('location: ../login.php');
    return;
  endif;

  if (isset($_POST['delete_id'])):

    $delete_id = $_POST['delete_id'];

    $verify_delete = $conn->prepare("SELECT * FROM `messages` WHERE id = ?");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0):
      $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
      $delete_message->execute([$delete_id]);

      $success_msg[] = 'message deleted';
    else:
      $warning_msg[] = 'message already deleted';
    endif;

  endif;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Messages</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="../styles/admin.css">

</head>
<body>

  <!-- header section starts -->

  <?php include '../components/admin-header.php' ?>

  <!-- header section ends -->


  <!-- messages section starts -->

  <section class="grid">

    <h1 class="heading"></h1>

    <form action="" method="post" class="search-form">
      <input type="text" name="search_box" placeholder="search messages" required maxlength="100">
      <button type="submit" name="search_btn" class="fas fa-search"></button>
    </form>

    <div class="box-container">

      <?php

        if (isset($_POST['search_box']) || isset($_POST['search_btn'])):

          $search_box = $_POST['search_box'];

          $select_messages = $conn->prepare("SELECT * FROM `messages` WHERE name LIKE '%{$search_box}%' OR email LIKE '%{$search_box}%' OR number LIKE '%{$search_box}%'");
          $select_messages->execute();

        else:

          $select_messages = $conn->prepare("SELECT * FROM `messages`");
          $select_messages->execute();

        endif;

        if ($select_messages->rowCount() > 0):

          while ($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)):

      ?>

      <div class="box">

        <p>name: <span><?= $fetch_messages['name'] ?></span></p>
        <p>email: <a href="mailto:<?= $fetch_messages['email'] ?>"><?= $fetch_messages['email'] ?></a></p>
        <p>number: <a href="tel:<?= $fetch_messages['number'] ?>"><?= $fetch_messages['number'] ?></a></p>
        <p>message: <span><?= $fetch_messages['message'] ?></span></p>

        <form action="" method="post">
          <input type="hidden" name="delete_id" value="<?= $fetch_messages['id'] ?>">
          <input type="submit" value="delete message" name="delete" class="delete-btn" onclick="return confirm('delete this message?');">
        </form>

      </div>

      <?php

          endwhile;

        elseif (isset($_POST['search_box']) || isset($_POST['search_btn'])):

          echo '<p class="empty">no results found</p>';

        else:

          echo '<p class="empty">no messages yet</p>';

        endif;

      ?>

    </div>

  </section>

  <!-- messages section ends -->


  <!-- sweetalert cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- custom js file link -->
  <script src="../scripts/admin.js"></script>

  <?php include '../components/messages.php' ?>

</body>
</html>