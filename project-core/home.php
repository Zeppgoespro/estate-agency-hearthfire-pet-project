<?php

  include './components/connect.php';

  if (isset($_COOKIE['user_id'])):
    $user_id = $_COOKIE['user_id'];
  else:
    $user_id = '';
  endif;

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

      <form action="search.php" method="POST">
        <h3>find your perfect home</h3>
        <div class="box">
          <p>property address <span>*</span></p>
          <input type="text" name="h_address" maxlength="100" required placeholder="enter property address" class="input">
        </div>
        <div class="flex">
          <div class="box">
            <p>property type <span>*</span></p>
            <select name="type" class="input" required>
              <option value="flat">flat</option>
              <option value="house">house</option>
              <option value="shop">shop</option>
            </select>
          </div>
          <div class="box">
            <p>property type <span>*</span></p>
            <select name="h_type" class="input" required>
              <option value="flat">flat</option>
              <option value="house">house</option>
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
            </select>
          </div>
        </div>
        <input type="text" name="h_search" value="search property" class="btn">
      </form>

    </section>

  </div>

  <!-- home section ends -->


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