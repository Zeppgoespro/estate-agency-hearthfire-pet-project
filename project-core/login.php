<?php

  include './components/connect.php';

  if (isset($_COOKIE['user_id'])):
    $user_id = $_COOKIE['user_id'];
  else:
    $user_id = '';
  endif;

  if (isset($_POST['submit'])):

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = sha1($_POST['pass']);

    $verify_user = $conn->prepare("SELECT * FROM `users` WHERE name = ? AND email = ? AND password = ? LIMIT 1");
    $verify_user->execute([$name, $email, $pass]);
    $row = $verify_user->fetch(PDO::FETCH_ASSOC);

    if ($verify_user->rowCount() > 0):
      setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
      header('location: home.php');
      return;
    else:
      $warning_msg[] = 'Incorrect name, email or password';
    endif;
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
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>

  <!-- header section starts -->

  <?php include './components/user-header.php' ?>

  <!-- header section ends -->


  <!-- login section ends -->

  <section class="form-container">

    <form action="login.php" method="post">
      <h3>welcome back</h3>
      <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
      <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
      <input type="password" name="pass" required maxlength="50" placeholder="enter your password" class="box">
      <p>don't have an account? <a href="./register.php">register now</a></p>
      <input type="submit" value="login" name="submit" class="btn">
    </form>

  </section>

  <!-- login section ends -->


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