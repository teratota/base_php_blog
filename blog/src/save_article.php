<?php
include "function.php";
header_page();
nav_bar();
?>
<div class="article">
<?php
if(isset($_SESSION['user'])){
	$title=(String)$_POST['title'];
	$descrption=(String)$_POST['description'];
	$file=$_FILES['file'];
	$file_extension = array( 'jpg' , 'jpeg' , 'png' );
	$extension_upload = strtolower(  substr(  strrchr($_FILES['file']['name'], '.')  ,1)  );
	if( in_array($extension_upload,$file_extension)){
    	save_article($title,$descrption,$file);
	}else{
    	echo "votre fichier n'est pas une image";
    	echo "<br>";
    	echo "<a href='admin.php'>Revenir a la page précédente</a>";
	}
}else{
	header("Location: ../index.php");
}

?>
<div>
<?php
foother_page();
?>