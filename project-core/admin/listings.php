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

      $success_msg[] = 'property deleted';

    else:
      $warning_msg[] = 'property already deleted';
    endif;

  endif;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listings</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="../styles/admin.css">

</head>
<body>

  <!-- header section starts -->

  <?php include '../components/admin-header.php' ?>

  <!-- header section ends -->


  <!-- listings section starts -->

    <section class="listings">

      <h1 class="heading"> properties listed</h1>

      <form action="" method="post" class="search-form">

        <input type="text" name="search_box" placeholder="search listings" maxlength="100">
        <button type="submit" name="search_btn" class="fas fa-search"></button>

      </form>

      <div class="box-container">

        <?php

          if (isset($_POST['search_box']) || isset($_POST['search_btn'])):

            $search_box = $_POST['search_box'];
            $select_listings = $conn->prepare("SELECT * FROM `properties` WHERE property_name LIKE '%{$search_box}%' OR address LIKE '%{$search_box}%' ORDER BY date DESC");
            $select_listings->execute();

          else:

            $select_listings = $conn->prepare("SELECT * FROM `properties` ORDER BY date DESC");
            $select_listings->execute();

          endif;

          if ($select_listings->rowCount() > 0):

            while ($fetch_property = $select_listings->fetch(PDO::FETCH_ASSOC)):

              $property_id = $fetch_property['id'];

              $select_users = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
              $select_users->execute([$fetch_property['user_id']]);
              $fetch_users = $select_users->fetch(PDO::FETCH_ASSOC);

              if (!empty($fetch_property['image_2'])):
                $count_image_2 = 1;
              else:
                $count_image_2 = 0;
              endif;

              if (!empty($fetch_property['image_3'])):
                $count_image_3 = 1;
              else:
                $count_image_3 = 0;
              endif;

              if (!empty($fetch_property['image_4'])):
                $count_image_4 = 1;
              else:
                $count_image_4 = 0;
              endif;

              if (!empty($fetch_property['image_5'])):
                $count_image_5 = 1;
              else:
                $count_image_5 = 0;
              endif;

              $total_images = (1 + $count_image_2 + $count_image_3 + $count_image_4 + $count_image_5);

        ?>

        <div class="box">

          <div class="thumb">

            <p><i class="fas fa-image"></i><span><?= $total_images ?></span></p>
            <img src="../uploaded-files/<?= $fetch_property['image_1'] ?>" alt="Estate photo">

          </div>

          <p class="price"><i class="fa-solid fa-dollar-sign"></i><span><?= $fetch_property['price'] ?></span></p>
          <h3 class="name"><?= $fetch_property['property_name'] ?></h3>
          <p class="address"><i class="fas fa-map-marker-alt"></i><span><?= $fetch_property['address'] ?></span></p>

          <form action="" method="post" class="flex-btn">

            <input type="hidden" name="delete_id" value="<?= $property_id ?>">
            <a href="./view-property.php?get_id=<?= $property_id ?>" class="btn">view</a>
            <input type="submit" value="delete" name="delete" class="delete-btn" onclick="return confirm('delete this property?');">

          </form>

        </div>

        <?php

            endwhile;

          elseif (isset($_POST['search_box']) || isset($_POST['search_btn'])):

            echo '<p class="empty">no results found</p>';

          else:

            echo '<p class="empty">no properties listed yet</p>';

          endif;

        ?>

      </div>

    </section>

  <!-- listings section ends -->


  <!-- sweetalert cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- custom js file link -->
  <script src="../scripts/admin.js"></script>

  <?php include '../components/messages.php' ?>

</body>
</html>