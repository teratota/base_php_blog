<?php
include "function.php";
header_page();
nav_bar();
?>
<div class="article">
<?php
$user=(String)$_POST['user'];
$password=(String)$_POST['password'];
$character_error = array( '>' , '<' ,'"','+','-','*','/','`');
$number_character_error=count($character_error);
	$tab_user = str_split($user);
	$number=count(array_diff($character_error,$tab_user ));
	if($number==$number_character_error){
		$tab_password = str_split($password);
		$number=count(array_diff($character_error,$tab_password ));
        if($number==$number_character_error){
            connection_admin($user,$password);
      	}else{
            echo "votre password n'est pas valide";
    	    echo "<br>";
    	    echo "<a href='connection.php'>Revenir a la page précédente</a>";
        }
	}else{
    	echo "votre identifiant n'est pas valide";
    	echo "<br>";
    	echo "<a href='connection.php'>Revenir a la page précédente</a>";
	}

?>
<div>
<?php
foother_page();
?>