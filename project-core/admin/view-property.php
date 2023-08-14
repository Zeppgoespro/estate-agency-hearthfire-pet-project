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

  if (isset($_GET['get_id'])):
    $get_id = $_GET['get_id'];
  else:
    $get_id = '';
    $_SESSION['wrnng_msg'] = 'No property selected';
    header('location: ./listings.php');
    exit;
  endif;

  if (isset($_POST['delete'])):

    $delete_id = $_POST['delete_id'];

    $verify_delete = $conn->prepare("SELECT * FROM `properties` WHERE id = ? LIMIT 1");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0):

      $fetch_images = $verify_delete->fetch(PDO::FETCH_ASSOC);

      $delete_image_1 = $fetch_images['image_1'];
      $delete_image_2 = $fetch_images['image_2'];
      $delete_image_3 = $fetch_images['image_3'];
      $delete_image_4 = $fetch_images['image_4'];
      $delete_image_5 = $fetch_images['image_5'];

      unlink('../uploaded-files/'.$delete_image_1);

      if (!empty($delete_image_2)):
        unlink('../uploaded-files/'.$delete_image_2);
      endif;

      if (!empty($delete_image_3)):
        unlink('../uploaded-files/'.$delete_image_3);
      endif;

      if (!empty($delete_image_4)):
        unlink('../uploaded-files/'.$delete_image_4);
      endif;

      if (!empty($delete_image_5)):
        unlink('../uploaded-files/'.$delete_image_5);
      endif;

      $delete_saved = $conn->prepare("DELETE FROM `saved` WHERE property_id = ?");
      $delete_saved->execute([$delete_id]);

      $delete_requests = $conn->prepare("DELETE FROM `requests` WHERE property_id = ?");
      $delete_requests->execute([$delete_id]);

      $delete_listings = $conn->prepare("DELETE FROM `properties` WHERE id = ?");
      $delete_listings->execute([$delete_id]);

      $_SESSION['scss_msg'] = 'Property deleted!';
      header('location: ./listings.php');
      exit;

    else:

      $_SESSION['wrnng_msg'] = 'Property already deleted';
      header('location: ./listings.php');
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
  <title>View Property</title>

  <!-- swiper cdn link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="../styles/admin.css">

</head>
<body>

  <!-- header section starts -->

  <?php include '../components/admin-header.php' ?>

  <!-- header section ends -->


  <!-- view section starts -->

    <section class="view-property">

      <h1 class="heading">property details</h1>

      <?php

        $select_property = $conn->prepare("SELECT * FROM `properties` WHERE id = ? LIMIT 1");
        $select_property->execute([$get_id]);

        if ($select_property->rowCount() > 0):
          while ($fetch_property = $select_property->fetch(PDO::FETCH_ASSOC)):

            $property_id = $fetch_property['id'];

            $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
            $select_user->execute([$fetch_property['user_id']]);
            $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
      ?>

      <div class="details">

        <div class="swiper images-container">
          <div class="swiper-wrapper">
            <img src="../uploaded-files/<?= $fetch_property['image_1'] ?>" alt="Property image" class="swiper-slide">
            <?php
            switch (!empty($fetch_property['image_2'])):
              case true:
            ?>
            <img src="../uploaded-files/<?= $fetch_property['image_2'] ?>" alt="Property image" class="swiper-slide">;
            <?php
              break;
            endswitch;
            ?>
            <?php
            switch (!empty($fetch_property['image_3'])):
              case true:
            ?>
            <img src="../uploaded-files/<?= $fetch_property['image_3'] ?>" alt="Property image" class="swiper-slide">;
            <?php
              break;
            endswitch;
            ?>
            <?php
            switch (!empty($fetch_property['image_4'])):
              case true:
            ?>
            <img src="../uploaded-files/<?= $fetch_property['image_4'] ?>" alt="Property image" class="swiper-slide">;
            <?php
              break;
            endswitch;
            ?>
            <?php
            switch (!empty($fetch_property['image_5'])):
              case true:
            ?>
            <img src="../uploaded-files/<?= $fetch_property['image_5'] ?>" alt="Property image" class="swiper-slide">;
            <?php
              break;
            endswitch;
            ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>

        <h3 class="name"><?= $fetch_property['property_name'] ?></h3>
        <p class="address"><i class="fas fa-map-marker-alt"></i><span><?= $fetch_property['address'] ?></span></p>
        <div class="info">

          <p><i class="fa-solid fa-dollar-sign"></i><span><?= $fetch_property['price'] ?></span></p>
          <p><i class="fas fa-user"></i><span><?= $fetch_user['name'] ?></span></p>
          <p><i class="fas fa-phone"></i><a href="tel:<?= $fetch_user['number'] ?>"><?= $fetch_user['number'] ?></a></p>
          <p><i class="fas fa-building"></i><span><?= $fetch_property['offer'] ?></span></p>
          <p><i class="fas fa-house"></i><span><?= $fetch_property['type'] ?></span></p>
          <p><i class="fas fa-calendar"></i><span><?= $fetch_property['date'] ?></span></p>

        </div>

        <h3 class="title">details</h3>
        <div class="flex">

          <div class="box">
            <p><i>bhk:</i><span><?= $fetch_property['bhk'] ?> BHK</span></p>
            <p><i>deposit amount:</i><span><span class="fa-solid fa-dollar-sign" style="margin-right: .5rem;"></span><?= $fetch_property['deposite'] ?></span></p>
            <p><i>status:</i><span><?= $fetch_property['status'] ?></span></p>
            <p><i>bedroom:</i><span><?= $fetch_property['bedroom'] ?></span></p>
            <p><i>bathroom:</i><span><?= $fetch_property['bathroom'] ?></span></p>
            <p><i>balcony:</i><span><?= $fetch_property['balcony'] ?></span></p>
          </div>
          <div class="box">
            <p><i>carpet area:</i><span><?= $fetch_property['carpet'] ?>sqft</span></p>
            <p><i>age:</i><span><?= $fetch_property['age'] ?> years</span></p>
            <p><i>total floors:</i><span><?= $fetch_property['total_floors'] ?></span></p>
            <p><i>rooms per floor:</i><span><?= $fetch_property['room_floor'] ?></span></p>
            <p><i>furniture:</i><span><?= $fetch_property['furnished'] ?></span></p>
            <p><i>loan:</i><span><?= $fetch_property['loan'] ?></span></p>
          </div>
        </div>

        <h3 class="title">amenities</h3>
        <div class="flex">

          <div class="box">
            <p><i class="fas fa-<?php if($fetch_property['lift'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>lift</span></p>
            <p><i class="fas fa-<?php if($fetch_property['security_guard'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>security guard</span></p>
            <p><i class="fas fa-<?php if($fetch_property['play_ground'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>play ground</span></p>
            <p><i class="fas fa-<?php if($fetch_property['garden'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>garden</span></p>
            <p><i class="fas fa-<?php if($fetch_property['water_supply'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>water supply</span></p>
            <p><i class="fas fa-<?php if($fetch_property['power_backup'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>power backup</span></p>
          </div>
          <div class="box">
            <p><i class="fas fa-<?php if($fetch_property['parking_area'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>parking area</span></p>
            <p><i class="fas fa-<?php if($fetch_property['gym'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>gym</span></p>
            <p><i class="fas fa-<?php if($fetch_property['shopping_mall'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>shopping mall</span></p>
            <p><i class="fas fa-<?php if($fetch_property['hospital'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>hospital</span></p>
            <p><i class="fas fa-<?php if($fetch_property['school'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>school</span></p>
            <p><i class="fas fa-<?php if($fetch_property['market_area'] == 'yes'){echo 'check';}else{echo 'times';} ?>"></i><span>market area</span></p>
          </div>

        </div>

        <h3 class="title">description</h3>
        <p class="description"><?= $fetch_property['description'] ?></p>

        <form action="" method="post" class="flex-btn">

          <input type="hidden" name="property_id" value="<?= $property_id ?>">
          <a href="./listings.php" class="option-btn">return</a>
          <input type="submit" value="delete" name="delete" class="delete-btn" onclick="return confirm('delete this property?');">

        </form>

      </div>

      <?php
          endwhile;
        else:
          echo '<p class="empty">property not found</p>';
        endif;

      ?>

    </section>

  <!-- view section ends -->


  <!-- sweetalert cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- custom js file link -->
  <script src="../scripts/admin.js"></script>

  <!-- swiper script -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <?php include '../components/messages.php' ?>

  <script>

    let swiper = new Swiper(".images-container", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      loop:true,
      coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 200,
        modifier: 1,
        slideShadows: true,
      },
      pagination: {
        el: ".swiper-pagination",
      },
    });

  </script>

</body>
</html>