<?php
include "function.php";
header_page();
nav_bar();
?>
<div class="article">
<?php
if(isset($_SESSION['user'])){
	show_article();
}else{
	header("Location: ../index.php");
}

?>
<div>
<?php
foother_page();
?>