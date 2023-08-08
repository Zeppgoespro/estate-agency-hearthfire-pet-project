<?php

  if (isset($_POST['save'])):

    if ($user_id != ''):

      $save_id = create_unique_id();
      $listing_id = $_POST['property_id'];

      $verify_save = $conn->prepare('SELECT * FROM `saved` WHERE property_id = ? AND user_id = ?');
      $verify_save->execute([$listing_id, $user_id]);

      if ($verify_save->rowCount() > 0):

        $remove_saved = $conn->prepare('DELETE FROM `saved` WHERE property_id = ? AND user_id = ?');
        $remove_saved->execute([$listing_id, $user_id]);
        $_SESSION['scss_msg'] = 'Removed from saved!';
        header('Location: '. $thisFilePath);
        exit;

      else:

        $add_saved = $conn->prepare ('INSERT INTO `saved` (id, property_id, user_id) VALUES (?,?,?)');
        $add_saved->execute([$save_id, $listing_id, $user_id]);
        $_SESSION['scss_msg'] = 'Added to saved!';
        header('Location: '. $thisFilePath);
        exit;

      endif;

    else:

      $_SESSION['wrnng_msg'] = 'Please login first';
      header('Location: '. $thisFilePath);
      exit;

    endif;

  endif;

  if (isset($_POST['send'])):

    if ($user_id != ''):

      $request_id = create_unique_id();
      $listing_id = $_POST['property_id'];

      $select_receiver = $conn->prepare('SELECT * FROM `properties` WHERE id = ? LIMIT 1');
      $select_receiver->execute([$listing_id]);
      $fetch_receiver = $select_receiver->fetch(PDO::FETCH_ASSOC);
      $receiver = $fetch_receiver['user_id'];

      $verify_request = $conn->prepare("SELECT * FROM `requests` WHERE property_id = ? AND sender = ?");
      $verify_request->execute([$listing_id, $user_id]);

      if ($verify_request->rowCount() > 0):

        $_SESSION['wrnng_msg'] = 'Request sent already';
        header('Location: '. $thisFilePath);
        exit;

      else:

        $add_request = $conn->prepare("INSERT INTO `requests` (id, property_id, sender, receiver) VALUES (?,?,?,?)");
        $add_request->execute([$request_id, $listing_id, $user_id, $receiver]);

        $_SESSION['scss_msg'] = 'Request sent successfully!';
        header('Location: '. $thisFilePath);
        exit;

      endif;

    else:

      $_SESSION['wrnng_msg'] = 'Please login first';
      header('Location: '. $thisFilePath);
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