<?php
include "function.php";
header_page();
nav_bar();
?>
<div class="article">
<?php
if(isset($_SESSION['user'])){
	$id_article=(Int)$_POST['id_article'];
	if(is_int($id_article)){
		select_article($id_article);
	}
}else{
	header("Location: ../index.php");
}
?>
<div>
<?php
foother_page();
?>