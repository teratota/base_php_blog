<?php
include "function.php";
header_page();
nav_bar();
?>
<div class="article">
<?php
$user=(String)$_POST['user'];
$password=(String)$_POST['password'];
connection_admin($user,$password);
?>
<div>
<?php
foother_page();
?>