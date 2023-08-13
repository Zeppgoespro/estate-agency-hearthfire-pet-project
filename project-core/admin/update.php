<?php

  include '../components/connect.php';
  session_start();

  if (isset($_COOKIE['admin_id'])):
    $admin_id = $_COOKIE['admin_id'];
  else:
    $admin_id = '';
    $_SESSION['wrnng_msg'] = 'You need to login as an admin first';
    header('location: ./login.php');
    exit;
  endif;

  $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE id = ? LIMIT 1");
  $select_admin->execute([$admin_id]);
  $fetch_admin = $select_admin->fetch(PDO::FETCH_ASSOC);

  if (isset($_POST['submit'])):

    $name = $_POST['name'];
    $prev_pass = $fetch_admin['password'];
    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $old_pass = sha1(($_POST['old_pass']));
    $new_pass = sha1(($_POST['new_pass']));
    $c_pass   = sha1(($_POST['c_pass']));

    if ($old_pass != $empty_pass && !empty($name)):

      if ($old_pass != $prev_pass) {

        $_SESSION['wrnng_msg'] = 'Old password not matched';
        header('location: ./update.php');
        exit;

      } elseif ($c_pass != $new_pass) {

        $_SESSION['wrnng_msg'] = 'Confirm password not matched';
        header('location: ./update.php');
        exit;

      } else {

        if ($new_pass != $empty_pass && $c_pass != $empty_pass):

          $verify_name = $conn->prepare("SELECT name FROM `admins` WHERE name = ? LIMIT 1");
          $verify_name->execute([$name]);

          if ($verify_name->rowCount() > 0):

            $_SESSION['wrnng_msg'] = 'Name already taken';
            header('location: ./update.php');
            exit;

          else:

            $update_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
            $update_pass->execute([$c_pass, $admin_id]);

            $update_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
            $update_name->execute([$name, $admin_id]);

            $_SESSION['scss_msg'] = 'Both name and password are changed!';
            header('location: ./update.php');
            exit;

          endif;

        else:

          $verify_name = $conn->prepare("SELECT name FROM `admins` WHERE name = ? LIMIT 1");
          $verify_name->execute([$name]);

          if ($verify_name->rowCount() > 0):

            $_SESSION['wrnng_msg'] = 'Name already taken';
            header('location: ./update.php');
            exit;

          else:

            $update_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
            $update_name->execute([$name, $admin_id]);

            $_SESSION['scss_msg'] = 'Name changed!';
            header('location: ./update.php');
            exit;

          endif;

        endif;

      }

    elseif ($old_pass == $empty_pass):

      $_SESSION['wrnng_msg'] = 'Old password cannot be empty';
      header('location: ./update.php');
      exit;

    elseif ($old_pass != $empty_pass && empty($name) && $new_pass == $empty_pass && $c_pass == $empty_pass):

      if ($old_pass != $prev_pass):
        $_SESSION['wrnng_msg'] = 'Wrong old password';
        header('location: ./update.php');
        exit;
      else:
        $_SESSION['wrnng_msg'] = 'Nothing changed';
        header('location: ./update.php');
        exit;
      endif;

    elseif (empty($name) && $old_pass != $empty_pass):

      if ($old_pass != $prev_pass):

        $_SESSION['wrnng_msg'] = 'Old password not matched';
        header('location: ./update.php');
        exit;

      elseif ($c_pass != $new_pass):

        $_SESSION['wrnng_msg'] = 'Confirm password not matched';
        header('location: ./update.php');
        exit;

      else:

        if ($new_pass != $empty_pass && $c_pass != $empty_pass):

          $update_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
          $update_pass->execute([$c_pass, $admin_id]);

          $_SESSION['scss_msg'] = 'Password changed!';
          header('location: ./update.php');
          exit;

        endif;
      endif;
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
  <title>Update</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="../styles/admin.css">

</head>
<body>

  <!-- header section starts -->

  <?php include '../components/admin-header.php' ?>

  <!-- header section ends -->


  <!-- update section starts -->

  <section class="form-container">

    <form action="" method="post">

      <h3>update profile</h3>

      <input type="text" class="box" name="name" placeholder="<?= $fetch_admin['name'] ?>" maxlength="20">
      <input type="password" class="box" name="old_pass" placeholder="enter your password" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" class="box" name="new_pass" placeholder="enter new password" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" class="box" name="c_pass" placeholder="confirm new password" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="submit" value="update" name="submit" class="btn">

    </form>

  </section>

  <!-- update section ends -->


  <!-- sweetalert cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- custom js file link -->
  <script src="../scripts/admin.js"></script>

  <?php include '../components/messages.php' ?>

</body>
</html>