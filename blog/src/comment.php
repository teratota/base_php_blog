<?php
include "function.php";
header_page();
nav_bar();
?>
<div class="article">
<?php
$id_article=(Int)$_POST['id_article'];
if(is_int($id_article)){
    comment($id_article);
}
?>
<div>
<?php
foother_page();
?>