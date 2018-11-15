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
		$hashing = password_hash("$password", PASSWORD_DEFAULT);
		inscription($username,$hashing);
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