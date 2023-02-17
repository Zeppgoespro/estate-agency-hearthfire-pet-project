<?php

  include './components/connect.php';

  if (isset($_COOKIE['user_id'])):
    $user_id = $_COOKIE['user_id'];
  else:
    $user_id = '';
  endif;

  if (isset($_GET['get_id'])):
    $get_id = $_GET['get_id'];
  else:
    $get_id = '';
    header('location: ./home.php');
    return;
  endif;

  include './components/save-send.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View property</title>

  <!-- swiper cdn link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>

  <!-- header section starts -->

  <?php include './components/user-header.php' ?>

  <!-- header section ends -->


  <!-- view section starts -->

    <section class="view-property">

      <?php

        $select_property = $conn->prepare("SELECT * FROM `properties` WHERE id = ? LIMIT 1");
        $select_property->execute([$get_id]);

        if ($select_property->rowCount() > 0):
          while ($fetch_property = $select_property->fetch(PDO::FETCH_ASSOC)):

            $property_id = $fetch_property['id'];

            $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
            $select_user->execute([$fetch_property['user_id']]);
            $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

            $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE property_id = ? AND user_id = ?");
            $select_saved->execute([$property_id, $user_id]);

      ?>

      <div class="details">

        <div class="swiper images-container">
          <div class="swiper-wrapper">
            <img src="./uploaded-files/<?= $fetch_property['image_1'] ?>" alt="Property image" class="swiper-slide">
            <?php
            switch (!empty($fetch_property['image_2'])):
              case true:
                echo '<img src="./uploaded-files/'.$fetch_property['image_2'].'" alt="Property image" class="swiper-slide">';
              break;
            endswitch;
            ?>
            <?php
            switch (!empty($fetch_property['image_3'])):
              case true:
                echo '<img src="./uploaded-files/'.$fetch_property['image_3'].'" alt="Property image" class="swiper-slide">';
              break;
            endswitch;
            ?>
            <?php
            switch (!empty($fetch_property['image_4'])):
              case true:
                echo '<img src="./uploaded-files/'.$fetch_property['image_4'].'" alt="Property image" class="swiper-slide">';
              break;
            endswitch;
            ?>
            <?php
            switch (!empty($fetch_property['image_5'])):
              case true:
                echo '<img src="./uploaded-files/'.$fetch_property['image_5'].'" alt="Property image" class="swiper-slide">';
              break;
            endswitch;
            ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

      <?php

          endwhile;
        else:
          echo '<p class="empty">property not found</p>';
        endif;

      ?>

    </section>

  <!-- view section ends -->


  <!-- footer section starts -->

  <?php include './components/footer.php' ?>

  <!-- footer section ends -->

  <!-- swiper script -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <!-- sweetalert cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- custom js file link -->
  <script src="./scripts/script.js"></script>

  <?php include './components/messages.php' ?>

  <script>
    var swiper = new Swiper(".images-container", {
      loop: true,
      effect: "coverflow",
      grabCursor: true,
      slidesPerView: "auto",
      coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 200,
        modifier: 2,
        slideShadows: true,
      },
      pagination: {
        el: ".swiper-pagination",
      },
    });
  </script>

</body>
</html>