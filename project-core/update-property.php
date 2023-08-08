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

  if (isset($_GET['get_id'])):
    $get_id = $_GET['get_id'];
    $_COOKIE['u-p_get_id'] = $_GET['get_id'];
  else:
    $get_id = '';
    $_SESSION['wrnng_msg'] = 'There is no property selected';
    header('location: my-listings.php');
    exit;
  endif;

  if (isset($_POST['update'])):
    $update_id = $_POST['property_id'];
    $property_name = $_POST['property_name'];
    $price = $_POST['price'];
    $deposite = $_POST['deposite'];
    $address = $_POST['address'];
    $offer = $_POST['offer'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $furniture = $_POST['furniture'];
    $bhk = $_POST['bhk'];
    $bedroom = $_POST['bedroom'];
    $bathroom = $_POST['bathroom'];
    $balcony = $_POST['balcony'];
    $carpet = $_POST['carpet'];
    $age = $_POST['age'];
    $total_floors = $_POST['total_floors'];
    $room_floor = $_POST['room_floor'];
    $loan = $_POST['loan'];
    $description = $_POST['description'];

    $words = array("lift", "security", "play_ground", "garden", "water_supply", "power_backup", "parking", "gym", "shopping_mall", "hospital", "school", "market_area");

    foreach ($words as $word) {
      if (isset($_POST[$word])) {
        $$word = $_POST[$word];
      } else {
        $$word = "no";
      }
    }

    $old_image_1 = $_POST['old_image_1'];
    $image_1 = $_FILES['image_1']['name'];
    $image_1_ext = pathinfo($image_1, PATHINFO_EXTENSION);
    $rename_image_1 = create_unique_id().'.'.$image_1_ext;
    $image_1_tmp_name = $_FILES['image_1']['tmp_name'];
    $image_1_size = $_FILES['image_1']['size'];
    $image_1_folder = './uploaded-files/'.$rename_image_1;

    if (!empty($image_1)):
      if ($image_1_size > 2000000):
        $_SESSION['wrnng_msg'] = 'Image 1 size is too large';
        header('location: update-property.php' . '?get_id='. $_COOKIE['u-p_get_id']);
        exit;
      else:
        $update_image_1 = $conn->prepare("UPDATE `properties` SET image_1 = ? WHERE id = ?");
        $update_image_1->execute([$rename_image_1, $update_id]);
        move_uploaded_file($image_1_tmp_name, $image_1_folder);

        if ($old_image_1 != ''):
          unlink('./uploaded-files/'.$old_image_1);
        endif;

      endif;
    endif;

    $old_image_2 = $_POST['old_image_2'];
    $image_2 = $_FILES['image_2']['name'];
    $image_2_ext = pathinfo($image_2, PATHINFO_EXTENSION);
    $rename_image_2 = create_unique_id().'.'.$image_2_ext;
    $image_2_tmp_name = $_FILES['image_2']['tmp_name'];
    $image_2_size = $_FILES['image_2']['size'];
    $image_2_folder = './uploaded-files/'.$rename_image_2;

    if (!empty($image_2)):
      if ($image_2_size > 2000000):
        $_SESSION['wrnng_msg'] = 'Image 2 size is too large';
        header('location: update-property.php' . '?get_id='. $_COOKIE['u-p_get_id']);
        exit;
      else:
        $update_image_2 = $conn->prepare("UPDATE `properties` SET image_2 = ? WHERE id = ?");
        $update_image_2->execute([$rename_image_2, $update_id]);
        move_uploaded_file($image_2_tmp_name, $image_2_folder);

        if ($old_image_2 != ''):
          unlink('./uploaded-files/'.$old_image_2);
        endif;

      endif;
    endif;

    $old_image_3 = $_POST['old_image_3'];
    $image_3 = $_FILES['image_3']['name'];
    $image_3_ext = pathinfo($image_3, PATHINFO_EXTENSION);
    $rename_image_3 = create_unique_id().'.'.$image_3_ext;
    $image_3_tmp_name = $_FILES['image_3']['tmp_name'];
    $image_3_size = $_FILES['image_3']['size'];
    $image_3_folder = './uploaded-files/'.$rename_image_3;

    if (!empty($image_3)):
      if ($image_3_size > 2000000):
        $_SESSION['wrnng_msg'] = 'Image 3 size is too large';
        header('location: update-property.php' . '?get_id='. $_COOKIE['u-p_get_id']);
        exit;
      else:
        $update_image_3 = $conn->prepare("UPDATE `properties` SET image_3 = ? WHERE id = ?");
        $update_image_3->execute([$rename_image_3, $update_id]);
        move_uploaded_file($image_3_tmp_name, $image_3_folder);

        if ($old_image_3 != ''):
          unlink('./uploaded-files/'.$old_image_3);
        endif;

      endif;
    endif;

    $old_image_4 = $_POST['old_image_4'];
    $image_4 = $_FILES['image_4']['name'];
    $image_4_ext = pathinfo($image_4, PATHINFO_EXTENSION);
    $rename_image_4 = create_unique_id().'.'.$image_4_ext;
    $image_4_tmp_name = $_FILES['image_4']['tmp_name'];
    $image_4_size = $_FILES['image_4']['size'];
    $image_4_folder = './uploaded-files/'.$rename_image_4;

    if (!empty($image_4)):
      if ($image_4_size > 2000000):
        $_SESSION['wrnng_msg'] = 'Image 4 size is too large';
        header('location: update-property.php' . '?get_id='. $_COOKIE['u-p_get_id']);
        exit;
      else:
        $update_image_4 = $conn->prepare("UPDATE `properties` SET image_4 = ? WHERE id = ?");
        $update_image_4->execute([$rename_image_4, $update_id]);
        move_uploaded_file($image_4_tmp_name, $image_4_folder);

        if ($old_image_4 != ''):
          unlink('./uploaded-files/'.$old_image_4);
        endif;

      endif;
    endif;

    $old_image_5 = $_POST['old_image_5'];
    $image_5 = $_FILES['image_5']['name'];
    $image_5_ext = pathinfo($image_5, PATHINFO_EXTENSION);
    $rename_image_5 = create_unique_id().'.'.$image_5_ext;
    $image_5_tmp_name = $_FILES['image_5']['tmp_name'];
    $image_5_size = $_FILES['image_5']['size'];
    $image_5_folder = './uploaded-files/'.$rename_image_5;

    if (!empty($image_5)):
      if ($image_5_size > 2000000):
        $_SESSION['wrnng_msg'] = 'Image 5 size is too large';
        header('location: update-property.php' . '?get_id='. $_COOKIE['u-p_get_id']);
        exit;
      else:
        $update_image_5 = $conn->prepare("UPDATE `properties` SET image_5 = ? WHERE id = ?");
        $update_image_5->execute([$rename_image_5, $update_id]);
        move_uploaded_file($image_5_tmp_name, $image_5_folder);

        if ($old_image_5 != ''):
          unlink('./uploaded-files/'.$old_image_5);
        endif;

      endif;
    endif;

    $update_listing = $conn->prepare("UPDATE `properties` SET property_name = ?, address = ?, price = ?, type = ?, offer = ?, status = ?, furnished = ?, bhk = ?, deposite = ?, bedroom = ?, bathroom = ?, balcony = ?, carpet = ?, age = ?, total_floors = ?, room_floor = ?, loan = ?, lift = ?, security_guard = ?, play_ground = ?, garden = ?, water_supply = ?, power_backup = ?, parking_area = ?, gym = ?, shopping_mall = ?, hospital = ?, school = ?, market_area = ?, description = ? WHERE id = ?");

    $update_listing->execute([$property_name, $address, $price, $type, $offer, $status, $furniture, $bhk, $deposite, $bedroom, $bathroom, $balcony, $carpet, $age, $total_floors, $room_floor, $loan, $lift, $security, $play_ground, $garden, $water_supply, $power_backup, $parking, $gym, $shopping_mall, $hospital, $school, $market_area, $description, $update_id]);

    $_SESSION['scss_msg'] = 'Listing updated!';
    header('location: update-property.php' . '?get_id='. $_COOKIE['u-p_get_id']);
    exit;
  endif;

  if (isset($_POST['delete_image_2'])):
    $old_image_2 = $_POST['old_image_2'];
    $update_image_2 = $conn->prepare("UPDATE `properties` SET image_2 = ? WHERE id = ?");
    $update_image_2->execute(['', $get_id]);

    if ($old_image_2 != ''):
      unlink('./uploaded-files/'.$old_image_2);
      $_SESSION['scss_msg'] = 'Image 2 deleted!';
      header('location: update-property.php' . '?get_id='. $_COOKIE['u-p_get_id']);
      exit;
    endif;

  endif;

  if (isset($_POST['delete_image_3'])):
    $old_image_3 = $_POST['old_image_3'];
    $update_image_3 = $conn->prepare("UPDATE `properties` SET image_3 = ? WHERE id = ?");
    $update_image_3->execute(['', $get_id]);

    if ($old_image_3 != ''):
      unlink('./uploaded-files/'.$old_image_3);
      $_SESSION['scss_msg'] = 'Image 3 deleted!';
      header('location: update-property.php' . '?get_id='. $_COOKIE['u-p_get_id']);
      exit;
    endif;

  endif;

  if (isset($_POST['delete_image_4'])):
    $old_image_4 = $_POST['old_image_4'];
    $update_image_4 = $conn->prepare("UPDATE `properties` SET image_4 = ? WHERE id = ?");
    $update_image_4->execute(['', $get_id]);

    if ($old_image_4 != ''):
      unlink('./uploaded-files/'.$old_image_4);
      $_SESSION['scss_msg'] = 'Image 4 deleted!';
      header('location: update-property.php' . '?get_id='. $_COOKIE['u-p_get_id']);
      exit;
    endif;

  endif;

  if (isset($_POST['delete_image_5'])):
    $old_image_5 = $_POST['old_image_5'];
    $update_image_5 = $conn->prepare("UPDATE `properties` SET image_5 = ? WHERE id = ?");
    $update_image_5->execute(['', $get_id]);

    if ($old_image_5 != ''):
      unlink('./uploaded-files/'.$old_image_5);
      $_SESSION['scss_msg'] = 'Image 5 deleted!';
      header('location: update-property.php' . '?get_id='. $_COOKIE['u-p_get_id']);
      exit;
    endif;

  endif;

  if (isset($_SESSION['wrnng_msg'])) {
    $warning_msg[] = $_SESSION['wrnng_msg'];
    unset($_SESSION['wrnng_msg']);
    unset($_COOKIE['u-p_get_id']);
  }

  if (isset($_SESSION['scss_msg'])) {
    $success_msg[] = $_SESSION['scss_msg'];
    unset($_SESSION['scss_msg']);
    unset($_COOKIE['u-p_get_id']);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update property</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>

  <!-- header section starts -->

  <?php include './components/user-header.php' ?>

  <!-- header section ends -->

  <!-- update-property section starts -->

  <section class="property-form">

    <?php
      $select_property = $conn->prepare("SELECT * FROM `properties` WHERE id = ? LIMIT 1");
      $select_property->execute([$get_id]);

      if ($select_property->rowCount() > 0):
        while ($fetch_property = $select_property->fetch(PDO::FETCH_ASSOC)):

          $property_id = $fetch_property['id'];
    ?>

    <form action="" method="post" enctype="multipart/form-data">
      <h3>property details</h3>
      <input type="hidden" name="property_id" value="<?= $property_id ?>">
      <input type="hidden" name="old_image_1" value="<?= $fetch_property['image_1'] ?>">
      <input type="hidden" name="old_image_2" value="<?= $fetch_property['image_2'] ?>">
      <input type="hidden" name="old_image_3" value="<?= $fetch_property['image_3'] ?>">
      <input type="hidden" name="old_image_4" value="<?= $fetch_property['image_4'] ?>">
      <input type="hidden" name="old_image_5" value="<?= $fetch_property['image_5'] ?>">
      <div class="box">
        <p>property name</p>
        <input type="text" name="property_name" maxlength="50" required placeholder="enter property name" class="input" value="<?= htmlentities($fetch_property['property_name']) ?>">
      </div>
      <div class="flex">
        <div class="box">
          <p>property price</p>
          <input type="number" name="price" maxlength="10" min="0" max="9999999999" required placeholder="enter property price" class="input" value="<?= htmlentities($fetch_property['price']) ?>">
        </div>
        <div class="box">
          <p>deposite amount</p>
          <input type="number" name="deposite" maxlength="10" min="0" max="9999999999" required placeholder="enter deposite amount" class="input" value="<?= htmlentities($fetch_property['deposite']) ?>">
        </div>
        <div class="box">
          <p>property address</p>
          <input type="text" name="address" maxlength="100" required placeholder="enter property address" class="input" value="<?= htmlentities($fetch_property['address']) ?>">
        </div>
        <div class="box">
          <p>offer type</p>
          <select name="offer" class="input" required>
            <option value="<?= htmlentities($fetch_property['offer']) ?>" selected><?= htmlentities($fetch_property['offer']) ?></option>
            <option value="sale">sale</option>
            <option value="resale">resale</option>
            <option value="rent">rent</option>
          </select>
        </div>
        <div class="box">
          <p>property type</p>
          <select name="type" class="input" required>
            <option value="<?= htmlentities($fetch_property['type']) ?>" selected><?= htmlentities($fetch_property['type']) ?></option>
            <option value="flat">flat</option>
            <option value="house">house</option>
            <option value="shop">shop</option>
          </select>
        </div>
        <div class="box">
          <p>property status</p>
          <select name="status" class="input" required>
            <option value="<?= htmlentities($fetch_property['status']) ?>" selected><?= htmlentities($fetch_property['status']) ?></option>
            <option value="ready">ready</option>
            <option value="under construction">under construction</option>
          </select>
        </div>
        <div class="box">
          <p>furniture status</p>
          <select name="furniture" class="input" required>
            <option value="<?= htmlentities($fetch_property['furnished']) ?>" selected><?= htmlentities($fetch_property['furnished']) ?></option>
            <option value="furnished">furnished</option>
            <option value="semi-furnished">semi-furnished</option>
            <option value="unfurnished">unfurnished</option>
          </select>
        </div>
        <div class="box">
          <p>how many BHK</p>
          <select name="bhk" class="input" required>
            <option value="<?= htmlentities($fetch_property['bhk']) ?>" selected><?= htmlentities($fetch_property['bhk']) ?></option>
            <option value="1">1 BHK</option>
            <option value="2">2 BHK</option>
            <option value="3">3 BHK</option>
            <option value="4">4 BHK</option>
            <option value="5">5 BHK</option>
            <option value="6">6 BHK</option>
            <option value="7">7 BHK</option>
            <option value="8">8 BHK</option>
            <option value="9">9 BHK</option>
          </select>
        </div>
        <div class="box">
          <p>how many bedrooms</p>
          <select name="bedroom" class="input" required>
            <option value="<?= htmlentities($fetch_property['bedroom']) ?>" selected><?= htmlentities($fetch_property['bedroom']) ?></option>
            <option value="1">1 bedroom</option>
            <option value="2">2 bedrooms</option>
            <option value="3">3 bedrooms</option>
            <option value="4">4 bedrooms</option>
            <option value="5">5 bedrooms</option>
            <option value="6">6 bedrooms</option>
            <option value="7">7 bedrooms</option>
            <option value="8">8 bedrooms</option>
            <option value="9">9 bedrooms</option>
          </select>
        </div>
        <div class="box">
          <p>how many bathrooms</p>
          <select name="bathroom" class="input" required>
            <option value="<?= htmlentities($fetch_property['bathroom']) ?>" selected><?= htmlentities($fetch_property['bathroom']) ?></option>
            <option value="1">1 bathroom</option>
            <option value="2">2 bathrooms</option>
            <option value="3">3 bathrooms</option>
            <option value="4">4 bathrooms</option>
            <option value="5">5 bathrooms</option>
            <option value="6">6 bathrooms</option>
            <option value="7">7 bathrooms</option>
            <option value="8">8 bathrooms</option>
            <option value="9">9 bathrooms</option>
          </select>
        </div>
        <div class="box">
          <p>how many balconys</p>
          <select name="balcony" class="input" required>
            <option value="<?= htmlentities($fetch_property['balcony']) ?>" selected><?= htmlentities($fetch_property['balcony']) ?></option>
            <option value="0">0 balcony</option>
            <option value="1">1 balcony</option>
            <option value="2">2 balconys</option>
            <option value="3">3 balconys</option>
            <option value="4">4 balconys</option>
            <option value="5">5 balconys</option>
            <option value="6">6 balconys</option>
            <option value="7">7 balconys</option>
            <option value="8">8 balconys</option>
            <option value="9">9 balconys</option>
          </select>
        </div>
        <div class="box">
          <p>carpet area (sqft)</p>
          <input type="number" name="carpet" maxlength="10" min="0" max="9999999999" required placeholder="how many squarefits?" class="input" value="<?= htmlentities($fetch_property['carpet']) ?>">
        </div>
        <div class="box">
          <p>property age</p>
          <input type="number" name="age" maxlength="2" min="0" max="99" required placeholder="how old is property?" class="input" value="<?= htmlentities($fetch_property['age']) ?>">
        </div>
        <div class="box">
          <p>total floors</p>
          <input type="number" name="total_floors" maxlength="2" min="0" max="99" required placeholder="how many floors available?" class="input" value="<?= htmlentities($fetch_property['total_floors']) ?>">
        </div>
        <div class="box">
          <p>rooms per floor</p>
          <input type="number" name="room_floor" maxlength="2" min="0" max="99" required placeholder="property floor number" class="input"  value="<?= htmlentities($fetch_property['room_floor']) ?>">
        </div>
        <div class="box">
          <p>loan</p>
          <select name="loan" class="input" required>
            <option value="<?= htmlentities($fetch_property['loan']) ?>" selected><?= htmlentities($fetch_property['loan']) ?></option>
            <option value="available">available</option>
            <option value="not available">not available</option>
          </select>
        </div>
      </div>
      <div class="box">
        <p>description</p>
        <textarea name="description" cols="30" rows="10" maxlength="1000" required placeholder="enter property description" class="input"><?= htmlentities($fetch_property['description']) ?></textarea>
      </div>
      <div class="checkbox">
        <div class="box">
          <p><input type="checkbox" name="lift" value="yes" <?php if ($fetch_property['lift'] == 'yes') echo 'checked' ?>>lift</p>
          <p><input type="checkbox" name="security" value="yes" <?php if ($fetch_property['security_guard'] == 'yes') echo 'checked' ?>>security</p>
          <p><input type="checkbox" name="play_ground" value="yes" <?php if ($fetch_property['play_ground'] == 'yes') echo 'checked' ?>>play ground</p>
          <p><input type="checkbox" name="garden" value="yes" <?php if ($fetch_property['garden'] == 'yes') echo 'checked' ?>>garden</p>
          <p><input type="checkbox" name="water_supply" value="yes" <?php if ($fetch_property['water_supply'] == 'yes') echo 'checked' ?>>water supply</p>
          <p><input type="checkbox" name="power_backup" value="yes" <?php if ($fetch_property['power_backup'] == 'yes') echo 'checked' ?>>power backup</p>
        </div>
        <div class="box">
          <p><input type="checkbox" name="parking" value="yes" <?php if ($fetch_property['parking_area'] == 'yes') echo 'checked' ?>>parking</p>
          <p><input type="checkbox" name="gym" value="yes" <?php if ($fetch_property['gym'] == 'yes') echo 'checked' ?>>gym</p>
          <p><input type="checkbox" name="shopping_mall" value="yes" <?php if ($fetch_property['shopping_mall'] == 'yes') echo 'checked' ?>>shoping mall</p>
          <p><input type="checkbox" name="hospital" value="yes" <?php if ($fetch_property['hospital'] == 'yes') echo 'checked' ?>>hospital</p>
          <p><input type="checkbox" name="school" value="yes" <?php if ($fetch_property['school'] == 'yes') echo 'checked' ?>>school</p>
          <p><input type="checkbox" name="market_area" value="yes" <?php if ($fetch_property['market_area'] == 'yes') echo 'checked' ?>>market area</p>
        </div>
      </div>

      <div class="box">
        <img src="./uploaded-files/<?= $fetch_property['image_1'] ?>" alt="Estate photo">
        <p>update image 1</p>
        <input type="file" name="image_1" class="input" accept="image/*">
      </div>

      <div class="flex">
        <div class="box">
          <?php
            if (!empty($fetch_property['image_2'])):
          ?>
          <img src="./uploaded-files/<?= $fetch_property['image_2'] ?>" alt="Estate photo">
          <input type="submit" value="delete image 2" name="delete_image_2" class="btn" onclick="return confirm('delete image 2?');">
          <?php
            endif;
          ?>
          <p>update image 2</p>
          <input type="file" name="image_2" class="input" accept="image/*">
        </div>
        <div class="box">
          <?php
            if (!empty($fetch_property['image_3'])):
          ?>
          <img src="./uploaded-files/<?= $fetch_property['image_3'] ?>" alt="Estate photo">
          <input type="submit" value="delete image 3" name="delete_image_3" class="btn" onclick="return confirm('delete image 3?');">
          <?php
            endif;
          ?>
          <p>update image 3</p>
          <input type="file" name="image_3" class="input" accept="image/*">
        </div>
        <div class="box">
        <?php
            if (!empty($fetch_property['image_4'])):
          ?>
          <img src="./uploaded-files/<?= $fetch_property['image_4'] ?>" alt="Estate photo">
          <input type="submit" value="delete image 4" name="delete_image_4" class="btn" onclick="return confirm('delete image 4?');">
          <?php
            endif;
          ?>
          <p>update image 4</p>
          <input type="file" name="image_4" class="input" accept="image/*">
        </div>
        <div class="box">
        <?php
            if (!empty($fetch_property['image_5'])):
          ?>
          <img src="./uploaded-files/<?= $fetch_property['image_5'] ?>" alt="Estate photo">
          <input type="submit" value="delete image 5" name="delete_image_5" class="btn" onclick="return confirm('delete image 5?');">
          <?php
            endif;
          ?>
          <p>update image 5</p>
          <input type="file" name="image_5" class="input" accept="image/*"
        </div>
      </div>
      <input type="submit" name="update" value="update property" class="btn">
    </form>

    <?php
        endwhile;
      else:
        echo '<p class="empty">property was not found</p>';
      endif;
    ?>

  </section>

  <!-- update-property section ends -->

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