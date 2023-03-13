<?php

  include '../components/connect.php';

  if (isset($_COOKIE['admin_id'])):
    $admin_id = $_COOKIE['admin_id'];
  else:
    $admin_id = '';
    header('location: ../login.php');
    return;
  endif;

  $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE id = ? LIMIT 1");
  $select_admin->execute([$admin_id]);
  $fetch_admin = $select_admin->fetch(PDO::FETCH_ASSOC);

  if (isset($_POST['submit'])):
    $name = $_POST['name'];

    if (!empty($name)):
      $verify_name = $conn->prepare("SELECT name FROM `admins` WHERE name = ? LIMIT 1");
      $verify_name->execute([$name]);

      if ($verify_name->rowCount() > 0):
        $warning_msg[] = 'name already taken';
      else:
        $update_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
        $update_name->execute([$name, $admin_id]);
        $success_msg[] = 'name updated';
      endif;

    endif;

    $prev_pass = $fetch_admin['password'];
    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $old_pass = sha1(($_POST['old_pass']));
    $new_pass = sha1(($_POST['new_pass']));
    $c_pass = sha1(($_POST['c_pass']));

    if ($old_pass != $empty_pass):

      if($old_pass != $prev_pass) {
        $warning_msg[] = 'old password not matched';
      } elseif ($c_pass != $new_pass) {
        $warning_msg[] = 'confirm password not matched';
      } else {

        if ($new_pass != $empty_pass):
          $update_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
          $update_pass->execute([$c_pass, $admin_id]);
          $success_msg[] = 'password updated';
        else:
          $warning_msg[] = 'password cannot be empty';
        endif;

      }

    endif;

  endif;

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