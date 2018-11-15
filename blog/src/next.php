<?php
session_start();
$_SESSION['article']='next';
header('Location: home.php');
?>