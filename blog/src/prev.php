<?php
session_start();
$_SESSION['article']='prev';
header('Location: home.php');
?>