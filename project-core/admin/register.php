<?php

  include '../components/connect.php';

  if (isset($_POST['submit'])):

    $id = create_unique_id();
    $name = $_POST['name'];
    $pass = sha1($_POST['pass']);
    $c_pass = sha1($_POST['c_pass']);

    $verify_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? LIMIT 1");
    $verify_admin->execute([$name]);
    $row = $verify_admin->fetch(PDO::FETCH_ASSOC);

    if ($verify_admin->rowCount() > 0):
      $warning_msg[] = 'name already taken';
    else:

      if ($pass != $c_pass):
        $warning_msg[] = 'password not matched';
      else:
        $insert_admin = $conn->prepare("INSERT INTO `admins` (id, name, password) VALUES (?,?,?)");
        $insert_admin->execute([$id, $name, $c_pass]);
        $success_msg[] = 'new admin registered';
      endif;

    endif;

  endif;

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
  <link rel="stylesheet" href="../styles/admin.css">

</head>
<body>

  <!-- header section starts -->

  <?php include '../components/admin-header.php' ?>

  <!-- header section ends -->


  <!-- registration section starts -->

  <section class="form-container">

    <form action="" method="post">

      <h3>create new account</h3>

      <input type="text" class="box" name="name" required placeholder="enter your name" maxlength="20">
      <input type="password" class="box" name="pass" required placeholder="enter your password" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" class="box" name="c_pass" required placeholder="confirm your password" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="submit" value="register" name="submit" class="btn">

    </form>

  </section>

  <!-- registration section ends -->


  <!-- sweetalert cdn link -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- custom js file link -->
  <script src="../scripts/admin.js"></script>

  <?php include '../components/messages.php' ?>

</body>
</html>