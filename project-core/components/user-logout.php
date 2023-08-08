<?php

  include './connect.php';
  session_start();

  unset($_COOKIE['u-p_get_id']);
  unset($_COOKIE['v-p_get_id']);
  unset($_COOKIE['user_id']);
  setcookie('user_id', '', time() - 1, '/');
  setcookie('u-p_get_id', '', time() - 1, '/');
  setcookie('v-p_get_id', '', time() - 1, '/');

  session_unset();
  session_destroy();

  header('location: ../home.php');
  exit;

?>