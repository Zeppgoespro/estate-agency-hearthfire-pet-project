<?php

  include './components/connect.php';
  session_start();

  if (isset($_COOKIE['user_id'])):
    $user_id = $_COOKIE['user_id'];
  else:
    $user_id = '';
    $_SESSION['wrnng_msg'] = 'You need to login first';
    header('location: login.php');
    exit;
  endif;

  if (isset($_POST['delete'])):
    $delete_id = $_POST['property_id'];

    $verify_delete = $conn->prepare("SELECT * FROM `properties` WHERE id = ?");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0):
      $select_images = $conn->prepare("SELECT * FROM `properties` WHERE id = ? LIMIT 1");
      $select_images->execute([$delete_id]);
      $fetch_images = $select_images->fetch(PDO::FETCH_ASSOC);
      $delete_image_1 = $fetch_images['image_1'];
      $delete_image_2 = $fetch_images['image_2'];
      $delete_image_3 = $fetch_images['image_3'];
      $delete_image_4 = $fetch_images['image_4'];
      $delete_image_5 = $fetch_images['image_5'];

      unlink('./uploaded-files/'.$delete_image_1);

      if (!empty($delete_image_2)):
        unlink('./uploaded-files/'.$delete_image_2);
      endif;

      if (!empty($delete_image_3)):
        unlink('./uploaded-files/'.$delete_image_3);
      endif;

      if (!empty($delete_image_4)):
        unlink('./uploaded-files/'.$delete_image_4);
      endif;

      if (!empty($delete_image_5)):
        unlink('./uploaded-files/'.$delete_image_5);
      endif;

      $delete_saved = $conn->prepare("DELETE FROM `saved` WHERE property_id = ?");
      $delete_saved->execute([$delete_id]);
      $delete_requests = $conn->prepare("DELETE FROM `requests` WHERE property_id = ?");
      $delete_requests->execute([$delete_id]);
      $delete_listings = $conn->prepare("DELETE FROM `properties` WHERE id = ?");
      $delete_listings->execute([$delete_id]);

      $_SESSION['scss_msg'] = 'Listing deleted!';
      header('location: my-listings.php');
      exit;
    else:
      $_SESSION['wrnng_msg'] = 'Listing deleted already';
      header('location: my-listings.php');
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
  <title>My listings</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>

  <!-- header section starts -->

  <?php include './components/user-header.php' ?>

  <!-- header section ends -->


  <!-- my listings section starts here -->

  <section class="my-listings">

    <h1 class="heading">my listings</h1>

    <div class="box-container">

      <?php
        $select_listings = $conn->prepare("SELECT * FROM `properties` WHERE user_id = ? ORDER BY date DESC");
        $select_listings->execute([$user_id]);

        if ($select_listings->rowCount() > 0):
          while ($fetch_listing = $select_listings->fetch(PDO::FETCH_ASSOC)):
            $listing_id = $fetch_listing['id'];

            if (!empty($fetch_listing['image_2'])):
              $image_2 = 1;
            else:
              $image_2 = 0;
            endif;

            if (!empty($fetch_listing['image_3'])):
              $image_3 = 1;
            else:
              $image_3 = 0;
            endif;

            if (!empty($fetch_listing['image_4'])):
              $image_4 = 1;
            else:
              $image_4 = 0;
            endif;

            if (!empty($fetch_listing['image_5'])):
              $image_5 = 1;
            else:
              $image_5 = 0;
            endif;

            $total_images = (1 + $image_2 + $image_3 + $image_4 + $image_5);

      ?>

      <form action="my-listings.php" method="post" class="box">
        <input type="hidden" name="property_id" value="<?= $listing_id ?>">
        <div class="thumb">
          <p><i class="far fa-image"></i><span><?= $total_images ?></span></p>
          <img src="./uploaded-files/<?= $fetch_listing['image_1'] ?>" alt="Property image">
        </div>
        <p class="price"><i class="fa-solid fa-dollar-sign"></i><?= $fetch_listing['price'] ?></p>
        <h3 class="name"><?= $fetch_listing['property_name'] ?></h3>
        <p class="address"><i class="fas fa-map-marker-alt"></i><?= $fetch_listing['address'] ?></p>
        <div class="flex-btn">
          <a href="./update-property.php?get_id=<?= $listing_id ?>" class="btn">update</a>
          <input type="submit" value="delete" name="delete" class="btn" onclick="return confirm('Delete this listing?');">
        </div>
        <a href="./view-property.php?get_id=<?= $listing_id ?>" class="btn">view property</a>
      </form>

      <?php
          endwhile;
        else:
          echo '<p class="empty">no listings found</p>';
        endif;
      ?>

    </div>

  </section>

  <!-- my listings section ends here -->


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