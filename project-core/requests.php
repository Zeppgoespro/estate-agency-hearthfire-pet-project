<?php

  include './components/connect.php';

  if (isset($_COOKIE['user_id'])):
    $user_id = $_COOKIE['user_id'];
  else:
    $user_id = '';
  endif;

  if (isset($_POST['delete'])):

    $delete_id = $_POST['request_id'];

    $verify_request = $conn->prepare("SELECT * FROM `requests` WHERE id = ?");
    $verify_request->execute([$delete_id]);

    if ($verify_request->rowCount() > 0):

      $delete_request = $conn->prepare("DELETE FROM `requests` WHERE id = ?");
      $delete_request->execute([$delete_id]);
      $success_msg = 'request deleted';

    else:
      $warning_msg[] = 'request deleted already';
    endif;

  endif;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Requests</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>

  <!-- header section starts -->

  <?php include './components/user-header.php' ?>

  <!-- header section ends -->


  <!-- received requests section starts -->

  <section class="requests">

    <h1 class="heading">requests received</h1>

    <div class="box-container">

      <?php

        $select_requests = $conn->prepare("SELECT * FROM `requests` WHERE receiver = ? ORDER BY date DESC");
        $select_requests->execute([$user_id]);

        if ($select_requests->rowCount() > 0):
          while ($fetch_requests = $select_requests->fetch(PDO::FETCH_ASSOC)):

            $select_sender = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_sender->execute([$fetch_requests['sender']]);
            $fetch_sender = $select_sender->fetch(PDO::FETCH_ASSOC);

            $select_properties = $conn->prepare("SELECT * FROM `properties` WHERE id = ?");
            $select_properties->execute([$fetch_requests['property_id']]);
            $fetch_property = $select_properties->fetch(PDO::FETCH_ASSOC);

      ?>

      <div class="box">

        <p>name: <span><?= $fetch_sender['name'] ?></span></p>
        <p>number: <a href="tel:<?= $fetch_sender['number'] ?>"><?= $fetch_sender['number'] ?></a></p>
        <p>email: <a href="tel:<?= $fetch_sender['email'] ?>"><?= $fetch_sender['email'] ?></a></p>
        <p>requests for: <a href="./view-property.php?get_id=<?= $fetch_property['id'] ?>"><?= $fetch_property['property_name'] ?></a></p>

        <form action="" method="post">
          <input type="hidden" name="request_id" value="<?= $fetch_requests['id'] ?>">
          <input type="submit" value="delete request" name="delete" class="btn" onclick="return confirm('Delete this request?');">
        </form>

      </div>

      <?php

          endwhile;
        else:
          echo '<p class="empty">you have no requests</p>';
        endif;

      ?>

    </div>

  </section>

  <!-- received requests section ends -->


  <!-- footer section starts -->

  <?php include './components/footer.php' ?>

  <!-- footer section ends -->


  <!-- sweetalert cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- custom js file link -->
  <script src="./scripts/script.js"></script>

  <?php include './components/messages.php' ?>

</body>
</html>