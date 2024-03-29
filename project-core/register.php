<?php

  include './components/connect.php';
  session_start();

  if (isset($_COOKIE['user_id'])):
    $user_id = $_COOKIE['user_id'];
  else:
    $user_id = '';
  endif;

  if (isset($_POST['submit'])):

    $id = create_unique_id();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $pass = sha1($_POST['pass']);
    $con_pass = sha1($_POST['con_pass']);

    $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_email->execute([$email]);

    if ($select_email->rowCount() > 0):
      $_SESSION['wrnng_msg'] = 'Email already taken';
      header('location: register.php');
      exit;
    else:
      if ($pass != $con_pass):
        $_SESSION['wrnng_msg'] = 'Password not matched';
        header('location: register.php');
        exit;
      else:
        $insert_user = $conn->prepare("INSERT INTO `users` (id, name, number, email, password) VALUES (?,?,?,?,?)");
        $insert_user->execute([$id, $name, $number, $email, $con_pass]);

        if ($insert_user):
          $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
          $verify_user->execute([$email, $pass]);
          $row = $verify_user->fetch(PDO::FETCH_ASSOC);

          if ($verify_user->rowCount() > 0):
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            $_SESSION['scss_msg'] = 'Registered successfully!';
            header('location: home.php');
            exit;
          else:
            $_SESSION['errr_msg'] = 'Something went wrong!';
            header('location: register.php');
            exit;
          endif;
        endif;
      endif;
    endif;
  endif;

  if (isset($_SESSION['errr_msg'])) {
    $error_msg[] = $_SESSION['errr_msg'];
    unset($_SESSION['errr_msg']);
  }

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
  <title>Register</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>

  <!-- header section starts -->

  <?php include './components/user-header.php' ?>

  <!-- header section ends -->


  <!-- register section starts -->

  <section class="form-container">

    <form action="register.php" method="post">
      <h3>create an account</h3>
      <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
      <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
      <input type="number" name="number" required placeholder="enter your number" min="0" max="999999999999" maxlength="12" class="box">
      <input type="password" name="pass" required maxlength="50" placeholder="enter your password" class="box">
      <input type="password" name="con_pass" required maxlength="50" placeholder="confirm your password" class="box">
      <p>already have an account? <a href="./login.php">login now</a></p>
      <input type="submit" value="register" name="submit" class="btn">
    </form>

  </section>

  <!-- register section ends -->


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