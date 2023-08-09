<?php

  include '../components/connect.php';
  session_start();

  if (isset($_POST['submit'])):

    $name = $_POST['name'];
    $pass = sha1($_POST['pass']);

    $verify_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ? LIMIT 1");
    $verify_admin->execute([$name, $pass]);
    $row = $verify_admin->fetch(PDO::FETCH_ASSOC);

    if ($verify_admin->rowCount() > 0):
      setcookie('admin_id', $row['id'], time() + 60*60*24*30, '/');
      $_SESSION['scss_msg'] = 'Logged in successfully!';
      header('location: ./dashboard.php');
      exit;
    else:
      $_SESSION['wrnng_msg'] = 'Incorrect name or password';
      header('location:./login.php');
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

      <input type="text" class="box" name="name" required placeholder="enter your name" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" class="box" name="pass" required placeholder="enter your password" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="submit" value="login" name="submit" class="btn">

      <p style="margin-top: 1rem;">You can also <a href="./register.php">register</a> a new admin</p>
      <p>Or go the the <a href="../home.php">main page</a></p>

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