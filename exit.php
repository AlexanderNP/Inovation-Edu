<?php

session_start();
$_SESSION['user'] = false;
$script = 'authorization.php';
header("Location: $script");

?>