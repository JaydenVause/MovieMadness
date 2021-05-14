<?php

session_start();
include('authentication_checker.php');
session_destroy();
header('location: ../view/login.php');
?>