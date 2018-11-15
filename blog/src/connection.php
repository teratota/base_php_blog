<?php
include "function.php";
header_page();
$_SESSION['article']='0';
$_SESSION['number']=0;
nav_bar();
?>
<center>
<div class="form">
<h1>Connexion</h1>
<form method="post" action="verif_connection.php">
<label>Identifiant</label>
<br>
<input type="texte" name="user" required>
<br>
<label>Mot de passe</label>
<br>
<input type ="password" name="password" required>
<br>
<input type ="submit" value="valider">
</form>
</div>
</center>

