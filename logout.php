<?php

session_start();

// unset($_SESSION['id_users']);
// unset($_SESSION['login']);
// unset($_SESSION['admin']);
// unset($_SESSION['email']);

$_SESSION=[];


header('location: ' . 'http://boostrap.local/');
?>