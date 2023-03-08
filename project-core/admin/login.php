<?php

  include '../components/connect.php';

  if (isset($_POST['submit'])):

    $name = $_POST['name'];
    $pass = $_POST['pass'];

    $verify_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ? LIMIT 1");
    $verify_admin->execute([$name, $pass]);
    $row = $verify_admin->fetch(PDO::FETCH_ASSOC);



  endif;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="../styles/admin.css">

</head>
<body style="padding-left: 0;">

  <!-- header section starts -->

  <?php #include '../components/admin-header.php' ?>

  <!-- header section ends -->


  <!-- login section starts -->

  <section class="form-container">

    <form action="" method="post">

      <h3>welcome back</h3>
      <p>default password = <span>999</span> | | default name = <span>admin</span></p>

      <input type="text" class="box" name="name" required placeholder="enter your name" maxlength="20" oninput="this.value.replace(/\s/g, '')">
      <input type="password" class="box" name="pass" required placeholder="enter your password" maxlength="20" oninput="this.value.replace(/\s/g, '')">
      <input type="submit" value="login" name="submit" class="btn">
    </form>

  </section>

  <!-- login section ends -->


  <!-- sweetalert cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- custom js file link -->
  <!-- <script src="../scripts/admin.js"></script> -->

  <?php include '../components/messages.php' ?>

</body>
</html>