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
  <title>About</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>

  <!-- header section starts -->

  <?php include './components/user-header.php' ?>

  <!-- header section ends -->


  <!-- about us section starts -->

    <section class="about">

      <div class="row">
        <div class="image">
          <img src="./images/about-img.svg">
        </div>
        <div class="content">
          <h3>why choose us?</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis molestiae debitis facilis eum in perferendis error nam repellendus, quam maiores. Voluptas quisquam numquam sapiente quas.</p>
          <a href="./contact.php" class="inline-btn">contact us</a>
        </div>
      </div>

    </section>

  <!-- about us section ends -->


  <!-- steps section starts -->

    <section class="steps">

      <h1 class="heading">3 simple steps</h1>

      <div class="box-container">

        <div class="box">
          <img src="./images/step-1.png">
          <h3>search property</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, dolores.</p>
        </div>

        <div class="box">
          <img src="./images/step-2.png">
          <h3>contact dealer</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, dolores.</p>
        </div>

        <div class="box">
          <img src="./images/step-3.png">
          <h3>enjoy property</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, dolores.</p>
        </div>

      </div>

    </section>

  <!-- steps section ends -->


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