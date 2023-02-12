<?php

  include './components/connect.php';

  if (isset($_COOKIE['user_id'])):
    $user_id = $_COOKIE['user_id'];
  else:
    $user_id = '';
  endif;

  include './components/save-send.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All listings</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>

  <!-- header section starts -->

  <?php include './components/user-header.php' ?>

  <!-- header section ends -->


  <!-- listings section starts -->

    <section class="listings">

      <h1 class="heading">latest listings</h1>

      <div class="box-container">

        <?php

          $select_listings = $conn->prepare("SELECT * FROM `properties` ORDER BY date DESC");
          $select_listings->execute();

          if ($select_listings->rowCount() > 0):
            while ($fetch_listing = $select_listings->fetch(PDO::FETCH_ASSOC)):
              $property_id = $fetch_listing['id'];

              $select_users = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
              $select_users->execute([$fetch_listing['user_id']]);
              $fetch_users = $select_users->fetch(PDO::FETCH_ASSOC);

              if (!empty($fetch_listing['image_2'])):
                $count_image_2 = 1;
              else:
                $count_image_2 = 0;
              endif;

              if (!empty($fetch_listing['image_3'])):
                $count_image_3 = 1;
              else:
                $count_image_3 = 0;
              endif;

              if (!empty($fetch_listing['image_4'])):
                $count_image_4 = 1;
              else:
                $count_image_4 = 0;
              endif;

              if (!empty($fetch_listing['image_5'])):
                $count_image_5 = 1;
              else:
                $count_image_5 = 0;
              endif;

              $total_images = (1 + $count_image_2 + $count_image_3 + $count_image_4 + $count_image_5);

              $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE property_id = ? AND user_id = ?");
              $select_saved->execute([$property_id, $user_id]);
        ?>

        <form action="" method="post">
          <div class="box">
            <input type="hidden" name="property_id" value="<?= $property_id ?>">
            <?php if ($select_saved->rowCount() > 0): ?>
              <button type="submit" name="save" class="save"><i class="fas fa-heart"></i><span>saved</span></button>
            <?php else: ?>
              <button type="submit" name="save" class="save"><i class="far fa-heart"></i><span>save</span></button>
            <?php endif; ?>
            <div class="thumb">
              <p><i class="fas fa-image"></i><span><?= $total_images ?></span></p>
              <img src="./uploaded-files/<?= $fetch_listing['image_1'] ?>" alt="Estate photo">
            </div>
            <div class="admin">
              <h3><?= substr($fetch_users['name'], 0, 1) ?></h3>
              <div>
                <p><?= $fetch_users['name'] ?></p>
                <span><?= $fetch_listing['date'] ?></span>
              </div>
            </div>
          </div>
          <div class="box">
            <p class="price"><i class="fa-solid fa-dollar-sign"></i><span><?= $fetch_listing['price'] ?></span></p>
            <h3 class="name"><?= $fetch_listing['property_name'] ?></h3>
            <p class="address"><i class="fas fa-map-marker-alt"></i><span><?= $fetch_listing['address'] ?></span></p>
            <div class="flex">
              <p><i class="fas fa-house"></i><span><?= $fetch_listing['type'] ?></span></p>
              <p><i class="fas fa-tag"></i><span><?= $fetch_listing['offer'] ?></span></p>
              <p><i class="fas fa-bed"></i><span><?= $fetch_listing['bhk'] ?> BHK</span></p>
              <p><i class="fas fa-trowel"></i><span><?= $fetch_listing['status'] ?></span></p>
              <p><i class="fas fa-couch"></i><span><?= $fetch_listing['furnished'] ?></span></p>
              <p><i class="fas fa-maximize"></i><span><?= $fetch_listing['carpet'] ?></span> sqft</p>
            </div>
            <div class="flex-btn">
              <a href="./view-property.php?get_id=<?= $property_id ?>" class="btn">view property</a>
              <input type="submit" value="send request" name="send" class="btn">
            </div>
          </div>
        </form>

        <?php
            endwhile;
          else:
            echo '<p class="empty">no property listed yet</p>';
          endif;

        ?>

      </div>

    </section>

  <!-- listings section ends -->


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