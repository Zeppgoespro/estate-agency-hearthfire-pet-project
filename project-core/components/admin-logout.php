<?php

include './connect.php';
session_start();

unset($_COOKIE['admin_id']);
setcookie('admin_id', '', time() - 1, '/');

session_unset();
session_destroy();

header('location: ../admin/login.php');
exit;

?>