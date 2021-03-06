<?php

session_start();
$_SESSION['user'] = null;

header('Location: signin.php');
