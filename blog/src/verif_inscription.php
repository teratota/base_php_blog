<?php
include "function.php";
header_page();
nav_bar();
?>
<div class="article">
<?php
$username=(String) $_POST['username'];
$password=(String) $_POST['password'];
if (strlen($username) < 50) {
    if (strlen($password) < 50) {
        $character_error = array( '>' , '<' ,'"','+','-','*','/','`');
        $number_character_error=count($character_error);
	    $tab_user = str_split($username);
	    $number=count(array_diff($character_error,$tab_user ));
	    if($number==$number_character_error){
		    $tab_password = str_split($password);
		    $number=count(array_diff($character_error,$tab_password ));
            if($number==$number_character_error){
                $hashing = password_hash("$password", PASSWORD_DEFAULT);
                inscription($username,$hashing);
            }else{
                echo "votre password n'est pas valide";
                echo "<br>";
                echo "<a href='connection.php'>Revenir a la page précédente</a>";
        }
	    }else{
            echo "votre identifiant n'est pas valide";
            echo "<br>";
            echo "<a href='inscription.php'>Revenir a la page précédente</a>";
	}
		
    }else{
        echo "votre mots de passe fait plus de 50 caractere";
    }
}else{
    echo "votre identifiant fait plus de 50 caractere";
}
?>
<div>
<?php
foother_page();
?>