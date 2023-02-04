<?php

  include './components/connect.php';

  if (isset($_COOKIE['user_id'])):
    $user_id = $_COOKIE['user_id'];
  else:
    $user_id = '';
    header('location: ./login.php');
  endif;

  if (isset($_POST['post'])):
    $id = create_unique_id();
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

    $image_1 = $_FILES['image_1']['name'];
    $image_1_ext = pathinfo($image_1, PATHINFO_EXTENSION);
    $rename_image_1 = create_unique_id().'.'.$image_1_ext;
    $image_1_tmp_name = $_FILES['image_1']['tmp_name'];
    $image_1_size = $_FILES['image_1']['size'];
    $image_1_folder = './uploaded-files/'.$rename_image_1;

    $image_2 = $_FILES['image_2']['name'];
    $image_2_ext = pathinfo($image_2, PATHINFO_EXTENSION);
    $rename_image_2 = create_unique_id().'.'.$image_2_ext;
    $image_2_tmp_name = $_FILES['image_2']['tmp_name'];
    $image_2_size = $_FILES['image_2']['size'];
    $image_2_folder = './uploaded-files/'.$rename_image_2;

    if (!empty($image_2)):
      if ($image_2_size > 2000000) {
        $warning_msg[] = 'Image 2 size is too large';
      }else{
        move_uploaded_file($image_2_tmp_name, $image_2_folder);
      }
    else:
      $rename_image_2 = '';
    endif;

    $image_3 = $_FILES['image_3']['name'];
    $image_3_ext = pathinfo($image_3, PATHINFO_EXTENSION);
    $rename_image_3 = create_unique_id().'.'.$image_3_ext;
    $image_3_tmp_name = $_FILES['image_3']['tmp_name'];
    $image_3_size = $_FILES['image_3']['size'];
    $image_3_folder = './uploaded-files/'.$rename_image_3;

    if (!empty($image_3)):
      if ($image_3_size > 2000000) {
        $warning_msg[] = 'Image 3 size is too large';
      }else{
        move_uploaded_file($image_3_tmp_name, $image_3_folder);
      }
    else:
      $rename_image_3 = '';
    endif;

    $image_4 = $_FILES['image_4']['name'];
    $image_4_ext = pathinfo($image_4, PATHINFO_EXTENSION);
    $rename_image_4 = create_unique_id().'.'.$image_4_ext;
    $image_4_tmp_name = $_FILES['image_4']['tmp_name'];
    $image_4_size = $_FILES['image_4']['size'];
    $image_4_folder = './uploaded-files/'.$rename_image_4;

    if (!empty($image_4)):
      if ($image_4_size > 2000000) {
        $warning_msg[] = 'Image 4 size is too large';
      }else{
        move_uploaded_file($image_4_tmp_name, $image_4_folder);
      }
    else:
      $rename_image_4 = '';
    endif;

    $image_5 = $_FILES['image_5']['name'];
    $image_5_ext = pathinfo($image_5, PATHINFO_EXTENSION);
    $rename_image_5 = create_unique_id().'.'.$image_5_ext;
    $image_5_tmp_name = $_FILES['image_5']['tmp_name'];
    $image_5_size = $_FILES['image_5']['size'];
    $image_5_folder = './uploaded-files/'.$rename_image_5;

    if (!empty($image_5)):
      if ($image_5_size > 2000000) {
        $warning_msg[] = 'Image 5 size is too large';
      }else{
        move_uploaded_file($image_5_tmp_name, $image_5_folder);
      }
    else:
      $rename_image_5 = '';
    endif;

    if ($image_1_size > 2000000) {
      $warning_msg[] = 'Image 1 size is too large';
    } else {
      $post_property = $conn->prepare("INSERT INTO `properties` (id, user_id, property_name, address, price, type, offer, status, furnished, bhk, deposite, bedroom, bathroom, balcony, carpet, age, total_floors, room_floor, loan, lift, security_guard, play_ground, garden, water_supply, power_backup, parking_area, gym, shopping_mall, hospital, school, market_area, image_1, image_2, image_3, image_4, image_5, description) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $post_property->execute([$id, $user_id, $property_name, $address, $price, $type, $offer, $status, $furniture, $bhk, $deposite, $bedroom, $bathroom, $balcony, $carpet, $age, $total_floors, $room_floor, $loan, $lift, $security, $play_ground, $garden, $water_supply, $power_backup, $parking, $gym, $shopping_mall, $hospital, $school, $market_area, $rename_image_1, $rename_image_2, $rename_image_3, $rename_image_4, $rename_image_5, $description]);
      move_uploaded_file($image_1_tmp_name, $image_1_folder);

      $success_msg[] = 'Property posted';

      header('location: ./home.php');
      return;
    }

  endif;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post property</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>

  <!-- header section starts -->

  <?php include './components/user-header.php' ?>

  <!-- header section ends -->


  <!-- post property section starts -->

  <section class="property-form">

    <form action="post-property.php" method="post" enctype="multipart/form-data">
      <h3>property details</h3>
      <div class="box">
        <p>property name <span>*</span></p>
        <input type="text" name="property_name" maxlength="50" required placeholder="enter property name" class="input">
      </div>
      <div class="flex">
        <div class="box">
          <p>property price <span>*</span></p>
          <input type="number" name="price" maxlength="10" min="0" max="9999999999" required placeholder="enter property price" class="input">
        </div>
        <div class="box">
          <p>deposite amount <span>*</span></p>
          <input type="number" name="deposite" maxlength="10" min="0" max="9999999999" required placeholder="enter deposite amount" class="input">
        </div>
        <div class="box">
          <p>property address <span>*</span></p>
          <input type="text" name="address" maxlength="100" required placeholder="enter property address" class="input">
        </div>
        <div class="box">
          <p>offer type <span>*</span></p>
          <select name="offer" class="input" required>
            <option value="sale">sale</option>
            <option value="resale">resale</option>
            <option value="rent">rent</option>
          </select>
        </div>
        <div class="box">
          <p>property type <span>*</span></p>
          <select name="type" class="input" required>
            <option value="flat">flat</option>
            <option value="house">house</option>
            <option value="shop">shop</option>
          </select>
        </div>
        <div class="box">
          <p>property status <span>*</span></p>
          <select name="status" class="input" required>
            <option value="ready">ready</option>
            <option value="under construction">under construction</option>
          </select>
        </div>
        <div class="box">
          <p>furniture status <span>*</span></p>
          <select name="furniture" class="input" required>
            <option value="furnished">furnished</option>
            <option value="semi-furnished">semi-furnished</option>
            <option value="unfurnished">unfurnished</option>
          </select>
        </div>
        <div class="box">
          <p>how many BHK <span>*</span></p>
          <select name="bhk" class="input" required>
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
          <p>how many bedrooms <span>*</span></p>
          <select name="bedroom" class="input" required>
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
          <p>how many bathrooms <span>*</span></p>
          <select name="bathroom" class="input" required>
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
          <p>how many balconys <span>*</span></p>
          <select name="balcony" class="input" required>
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
          <p>carpet area (sqft) <span>*</span></p>
          <input type="number" name="carpet" maxlength="10" min="0" max="9999999999" required placeholder="how many squarefits?" class="input">
        </div>
        <div class="box">
          <p>property age <span>*</span></p>
          <input type="number" name="age" maxlength="2" min="0" max="99" required placeholder="how old is property?" class="input">
        </div>
        <div class="box">
          <p>total floors <span>*</span></p>
          <input type="number" name="total_floors" maxlength="2" min="0" max="99" required placeholder="how many floors available?" class="input">
        </div>
        <div class="box">
          <p>rooms per floor <span>*</span></p>
          <input type="number" name="room_floor" maxlength="2" min="0" max="99" required placeholder="property floor number" class="input">
        </div>
        <div class="box">
          <p>loan <span>*</span></p>
          <select name="loan" class="input" required>
            <option value="available">available</option>
            <option value="not available">not available</option>
          </select>
        </div>
      </div>
      <div class="box">
        <p>description <span>*</span></p>
        <textarea name="description" cols="30" rows="10" maxlength="1000" required placeholder="enter property description" class="input"></textarea>
      </div>
      <div class="checkbox">
        <div class="box">
          <p><input type="checkbox" name="lift" value="yes">lift</p>
          <p><input type="checkbox" name="security" value="yes">security</p>
          <p><input type="checkbox" name="play_ground" value="yes">play ground</p>
          <p><input type="checkbox" name="garden" value="yes">garden</p>
          <p><input type="checkbox" name="water_supply" value="yes">water supply</p>
          <p><input type="checkbox" name="power_backup" value="yes">power backup</p>
        </div>
        <div class="box">
          <p><input type="checkbox" name="parking" value="yes">parking</p>
          <p><input type="checkbox" name="gym" value="yes">gym</p>
          <p><input type="checkbox" name="shopping_mall" value="yes">shoping mall</p>
          <p><input type="checkbox" name="hospital" value="yes">hospital</p>
          <p><input type="checkbox" name="school" value="yes">school</p>
          <p><input type="checkbox" name="market_area" value="yes">market area</p>
        </div>
      </div>
      <div class="flex">
        <div class="box">
          <p>image 1 <span>*</span></p>
          <input type="file" name="image_1" class="input" accept="image/*" required>
        </div>
        <div class="box">
          <p>image 2</p>
          <input type="file" name="image_2" class="input" accept="image/*">
        </div>
        <div class="box">
          <p>image 3</p>
          <input type="file" name="image_3" class="input" accept="image/*">
        </div>
        <div class="box">
          <p>image 4</p>
          <input type="file" name="image_4" class="input" accept="image/*">
        </div>
        <div class="box">
          <p>image 5</p>
          <input type="file" name="image_5" class="input" accept="image/*">
        </div>
      </div>
      <input type="submit" name="post" value="post property" class="btn">
    </form>

  </section>

  <!-- post property section ends -->


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