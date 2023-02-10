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
        $success_msg[] = 'removed from saved';

      else:

        $add_saved = $conn->prepare ('INSERT INTO `saved` (id, property_id, user_id) VALUES (?,?,?)');
        $add_saved->execute([$save_id, $listing_id, $user_id]);
        $success_msg[] = 'added to saved';

      endif;

    else:

      $warning_msg[] = 'please login first';

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

        $warning_msg[] = 'request sent already';

      else:

        $add_request = $conn->prepare("INSERT INTO `requests` (id, property_id, sender, receiver) VALUES (?,?,?,?)");
        $add_request->execute([$request_id, $listing_id, $user_id, $receiver]);

        $success_msg[] = 'request sent successfully';

      endif;

    else:

      $warning_msg[] = 'please login first';

    endif;

  endif;

?>