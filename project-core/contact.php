<?php

  include './components/connect.php';

  if (isset($_COOKIE['user_id'])):
    $user_id = $_COOKIE['user_id'];
  else:
    $user_id = '';
  endif;

  if (isset($_POST['send'])):

    $message_id = create_unique_id();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $message = $_POST['message'];

    $verify_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
    $verify_message->execute([$name, $email, $number, $message]);

    if ($verify_message->rowCount() > 0):
      $warning_msg[] = 'message sent already';
    else:
      $insert_message = $conn->prepare("INSERT INTO `messages` (id, name, email, number, message) VALUES (?,?,?,?,?)");
      $insert_message->execute([$message_id, $name, $email, $number, $message]);
      $success_msg[] = 'message sent successfully';
    endif;

  endif;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacts</title>

  <!-- font-awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- custom css file link -->
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>

  <!-- header section starts -->

  <?php include './components/user-header.php' ?>

  <!-- header section ends -->


  <!-- contact section starts -->

    <section class="contact">

      <div class="row">

        <div class="image">
          <img src="./images/contact-img.svg">
        </div>

        <form action="" method="post">
          <h3>get in touch</h3>
          <input type="text" name="name" placeholder="enter your name" required maxlength="50" class="box">
          <input type="text" name="email" placeholder="enter your email" required maxlength="50" class="box">
          <input type="number" name="number" placeholder="enter your number" required maxlength="12" min="0" max="999999999999" class="box">
          <textarea name="message" class="box" placeholder="enter your message" required maxlength="1000" cols="30" rows="10"></textarea>
          <input type="submit" value="send message" name="send" class="inline-btn">
        </form>

      </div>

    </section>

  <!-- contact section ends -->


  <!-- faq section starts -->

    <section class="faq" id="faq">

      <h1 class="heading">FAQ</h1>

      <div class="box-container">

        <div class="box">
          <h3><span>how to...</span><i class="fas fa-angle-down"></i></h3>
        </div>

      </div>

    </section>

  <!-- faq section ends -->


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