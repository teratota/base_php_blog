<?php
session_start();
$_SESSION['article']='0';
$_SESSION['number']=0;
header('Location: src/home.php');
?>