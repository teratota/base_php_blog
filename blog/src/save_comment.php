<?php
include "function.php";
header_page();
nav_bar();
?>
<div class="article">
<?php
$id_article=(Int)$_POST['id_article'];
$username=(String)$_POST['utilisateur'];
$content=(String)$_POST['commentaire'];
if(is_int($id_article)){
    save_comment($id_article,$username,$content);
}
?>
<div>
<?php
foother_page();
?>