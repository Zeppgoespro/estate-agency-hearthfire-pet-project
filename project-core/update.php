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

  $select_account = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
  $select_account->execute([$user_id]);
  $fetch_account = $select_account->fetch(PDO::FETCH_ASSOC);

  if (isset($_POST['submit'])):

    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];

    if (!empty($email)):
      $verify_email = $conn->prepare("SELECT email FROM `users` WHERE email = ?");
      $verify_email->execute([$email]);

      if ($verify_email->rowCount() > 0):
        $_SESSION['wrnng_msg'] = 'Email already taken';
        header('location: update.php');
        exit;
      else:
        $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
        $update_email->execute([$email, $user_id]);
        // $_SESSION['scss_msg'] = 'Email updated';
        // header('location: update.php');
        // exit;
      endif;
    endif;

    if (!empty($number)):
      $update_number = $conn->prepare("UPDATE `users` SET number = ? WHERE id = ?");
      $update_number->execute([$number, $user_id]);
      // $_SESSION['scss_msg'] = 'Number updated';
      // header('location: update.php');
      // exit;
    endif;

    if (!empty($name)):
      $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $user_id]);
      // $_SESSION['scss_msg'] = 'Name updated';
      // header('location: update.php');
      // exit;
    endif;

    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $prev_pass = $fetch_account['password'];
    $old_pass = sha1($_POST['old_pass']);
    $new_pass = sha1($_POST['new_pass']);
    $con_pass = sha1($_POST['con_pass']);

    if ($old_pass != $empty_pass):
      if ($old_pass != $prev_pass):
        $_SESSION['wrnng_msg'] = 'Old password not matched';
        header('location: update.php');
        exit;
      elseif ($new_pass != $empty_pass && $con_pass == $empty_pass):
        $_SESSION['wrnng_msg'] = 'Confirmed password required';
        header('location: update.php');
        exit;
      elseif ($con_pass != $new_pass):
        $_SESSION['wrnng_msg'] = 'Confirmed password not matched';
        header('location: update.php');
        exit;
      else:
        if ($new_pass != $empty_pass):
          $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
          $update_pass->execute([$con_pass, $user_id]);
          // $_SESSION['scss_msg'] = 'Password updated';
          // header('location: update.php');
          // exit;
        elseif ($name == '' && $email == '' && $number == '' && $new_pass == $empty_pass && $con_pass == $empty_pass && $old_pass != $empty_pass):
          $_SESSION['wrnng_msg'] = 'Nothing changed';
          header('location: update.php');
          exit;
        endif;
      endif;
    endif;

    $_SESSION['scss_msg'] = 'Profile updated!';
    header('location: update.php');
    exit;

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
  <title>Update user</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>

  <!-- header section starts -->

  <?php include './components/user-header.php' ?>

  <!-- header section ends -->


  <!-- update section starts -->

  <section class="form-container">

    <form action="update.php" method="post">
      <h3>update your account</h3>
      <input type="text" name="name" maxlength="50" placeholder="<?= htmlentities($fetch_account['name']) ?>" class="box">
      <input type="email" name="email" maxlength="50" placeholder="<?= htmlentities($fetch_account['email']) ?>" class="box">
      <input type="number" name="number" placeholder="<?= htmlentities($fetch_account['number']) ?>" min="0" max="999999999999" maxlength="12" class="box">
      <input type="password" name="old_pass" required maxlength="50" placeholder="enter your old password" class="box">
      <input type="password" name="new_pass" maxlength="50" placeholder="enter your new password" class="box">
      <input type="password" name="con_pass" maxlength="50" placeholder="confirm your new password" class="box">
      <input type="submit" value="update" name="submit" class="btn">
    </form>

  </section>

  <!-- update section ends -->


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