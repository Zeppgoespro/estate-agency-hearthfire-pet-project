<?php

  include './components/connect.php';
  session_start();

  if (isset($_COOKIE['user_id'])):
    $user_id = $_COOKIE['user_id'];
  else:
    $user_id = '';
  endif;

  $thisFilePath = str_replace('/var/www/', '', __FILE__ . '#listings');
  include './components/save-send.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>

  <!-- header section starts -->

  <?php include './components/user-header.php' ?>

  <!-- header section ends -->


  <!-- home section starts -->

  <div class="home">

    <section class="center">

      <form action="search.php" method="post">
        <h3>find your perfect home</h3>
        <div class="box">
          <p>enter location <span>*</span></p>
          <input type="text" name="h_location" maxlength="100" required placeholder="enter city name" class="input">
        </div>
        <div class="flex">
          <div class="box">
            <p>property type <span>*</span></p>
            <select name="h_type" class="input" required>
              <option value="flat">flat</option>
              <option selected value="house">house</option>
              <option value="shop">shop</option>
            </select>
          </div>
          <div class="box">
            <p>offer type <span>*</span></p>
            <select name="h_offer" class="input" required>
              <option value="sale">sale</option>
              <option value="resale">resale</option>
              <option value="rent">rent</option>
            </select>
          </div>
          <div class="box">
            <p>minimum budget <span>*</span></p>
            <select name="h_min" class="input" required>
              <option value="0">0</option>
              <option value="5000" selected>5k</option>
              <option value="10000">10k</option>
              <option value="15000">15k</option>
              <option value="20000">20k</option>
              <option value="25000">25k</option>
              <option value="30000">30k</option>
              <option value="35000">35k</option>
              <option value="40000">40k</option>
              <option value="45000">45k</option>
              <option value="50000">50k</option>
              <option value="75000">75k</option>
              <option value="100000">100k</option>
              <option value="150000">150k</option>
            </select>
          </div>
          <div class="box">
            <p>maximum budget <span>*</span></p>
            <select name="h_max" class="input" required>
              <option value="5000">5k</option>
              <option value="10000">10k</option>
              <option value="15000">15k</option>
              <option value="20000">20k</option>
              <option value="25000">25k</option>
              <option value="30000">30k</option>
              <option value="35000">35k</option>
              <option value="40000">40k</option>
              <option value="45000">45k</option>
              <option value="50000">50k</option>
              <option value="75000">75k</option>
              <option value="100000">100k</option>
              <option value="150000">150k</option>
              <option value="100000000000" selected>no limit</option>
            </select>
          </div>
        </div>
        <input type="submit" name="h_search" value="search property" class="btn">
      </form>

    </section>

  </div>

  <!-- home section ends -->


  <!-- services section starts -->

    <section class="services">

      <h1 class="heading">our services</h1>

      <div class="box-container">

        <div class="box">
          <img src="./images/icon-1.png" alt="This is icon">
          <h3>buy house</h3>
          <p>Description...</p>
        </div>

        <div class="box">
          <img src="./images/icon-2.png" alt="This is icon">
          <h3>rent house</h3>
          <p>Description...</p>
        </div>

        <div class="box">
          <img src="./images/icon-3.png" alt="This is icon">
          <h3>sell house</h3>
          <p>Description...</p>
        </div>

        <div class="box">
          <img src="./images/icon-4.png" alt="This is icon">
          <h3>flats and buildings</h3>
          <p>Description...</p>
        </div>

        <div class="box">
          <img src="./images/icon-5.png" alt="This is icon">
          <h3>shops and malls</h3>
          <p>Description...</p>
        </div>

        <div class="box">
          <img src="./images/icon-6.png" alt="This is icon">
          <h3>24/7 service</h3>
          <p>Description...</p>
        </div>

      </div>

    </section>

  <!-- services section ends -->


  <!-- listings section starts -->

    <section class="listings" id="listings">

      <h1 class="heading">latest listings</h1>

      <div class="box-container">

        <?php

          $select_listings = $conn->prepare("SELECT * FROM `properties` ORDER BY date DESC LIMIT 6");
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

      <div style="margin-top: 2rem; text-align: center;">
        <a href="./listings.php" class="inline-btn">view all</a>
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