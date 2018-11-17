<?php

function header_page()
{
echo "<!DOCTYPE html>
<html lang='en' >
<head>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta charset='UTF-8'>
  <title>Mon blog</title>
      <link rel='stylesheet' href='../style/style.css'>
</head>
<body>
";
ini_set("display_errors",0);error_reporting(0);
session_start();
}
function foother_page()
{
echo "</body></html>";
}
function nav_bar()
{
    if(isset($_SESSION['user'])){
        echo" <h1 class='logo'>Blog</h1>
        <header>
        <nav>
        <ul class='nav-bar'>
        <li><a href='../index.php'>Accueil</a></li>
        <li><a href='logout.php'>Deconnexion</a></li>
        <li><a href='admin.php'>".$_SESSION['user']."</a></li>
        </ul>
        </nav>
        </header>";
    }else{
        echo" <h1 class='logo'>Blog</h1>
   <header>
    <nav>
      <ul class='nav-bar'>
        <li><a href='../index.php'>Accueil</a></li>
        <li><a href='connection.php'>Connexion</a></li>
        <li><a href='inscription.php'>Inscription</a></li>
      </ul>
    </nav>
    </header>";
    }
   
}
function connection()
{
    $user='user';
    $pass="user";
    try {
        $data_base = new PDO('mysql:host=db;dbname=blog', $user, $pass);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
    }
    return $data_base;
}
function article()
{
    $data_base=connection();
    $select = $data_base->prepare('SELECT * FROM article');
    $select->execute();
    $data=$select->fetchAll();
    $number=count($data);
    switch($_SESSION['article']){
        case '0':
            for ($i=0; $i<=4; $i++) {
                if(isset($data[$i]["title"])){
                    echo "<article>";
                    echo "<label>".$data[$i]["title"]."<label>";
                    if($i%2){
                        echo"<div class='flex'>";
                        echo "<div>";
                        echo "<img src=".$data[$i]["image"].">";
                        echo "</div>";
                        echo "<div>";
                        echo $data[$i]["content"];
                        echo "</div>";
                    }else{
                        echo"<div class='flex'>";
                        echo "<div>";
                        echo $data[$i]["content"];
                        echo "</div>";
                        echo "<div>";
                        echo "<img src=".$data[$i]["image"].">";
                        echo "</div>";
                        
                    }
                    echo "<br>";
                    echo"<form action='comment.php' method='post'>
                    <input type='hidden' name='id_article' value=".$data[$i]['id'].">
                    <input type='submit' value='voir les commentaires'>
                    </form>";
                    echo "</div>";
                } 
                echo "</article>";
            }
            $_SESSION['number']=$i;
            if($number>5){
                echo "<center>";
                echo "<div class='next-back'>" ;
                echo "<a href='next.php'>suivant</a>";
                echo "</div>";
                echo "</center>";
            }
        break;
        case 'next':
            $f=$_SESSION['number']+5;
            for ($i=$_SESSION['number']; $i<$f; $i++){
                if(isset($data[$i]["title"])){
                    echo "<article>";
                    echo "<label>".$data[$i]["title"]."<label>";
                    if($i%2){
                        echo"<div class='flex'>";
                        echo "<div>";
                        echo "<img src=".$data[$i]["image"].">";
                        echo "</div>";
                        echo "<div>";
                        echo $data[$i]["content"];
                        echo "</div>";
                    }else{
                        echo"<div class='flex'>";
                        echo "<div>";
                        echo $data[$i]["content"];
                        echo "</div>";
                        echo "<div>";
                        echo "<img src=".$data[$i]["image"].">";
                        echo "</div>";
                    }
                
                    echo"<form action='comment.php' method='post'>
                    <input type='hidden' name='id_article'  value=".$data[$i]['id'].">
                    <input type='submit' value='voir les commentaires'>
                    </form>";
                    echo "</div>";
                    echo "</article>";
                } 
                
            }
            $_SESSION['number']=$i;
            if($f>=count($data)){
                echo "<center>";
                echo "<div class='next-back'>" ;
                echo "<a href='prev.php'>précédent</a>";
                echo "</div>";
                echo "</center>";
            }else{
                echo "<center>";
                echo "<div class='next-back'>" ;
                echo "<a href='prev.php'>précédent</a>";
                echo "<a href='next.php'>suivant</a>";
                echo "</div>";
                echo "</center>";
            } 
        break;
        case 'prev':
            $number=$_SESSION['number'];
            $f=$number-10;
            if($f==0){
                for ($i=0; $i<=4; $i++) {
                    if(isset($data[$i]["title"])){
                        echo "<article>";
                        echo "<label>".$data[$i]["title"]."<label>";
                        if($i%2){
                            echo"<div class='flex'>";
                            echo "<div>";
                            echo "<img src=".$data[$i]["image"].">";
                            echo "</div>";
                            echo "<div>";
                            echo $data[$i]["content"];
                            echo "</div>";
                        }else{
                            echo"<div class='flex'>";
                            echo "<div>";
                            echo $data[$i]["content"];
                            echo "</div>";
                            echo "<div>";
                            echo "<img src=".$data[$i]["image"].">";
                            echo "</div>";
                            
                        }
                   
                        echo"<form action='comment.php' method='post'>
                        <input type='hidden' name='id_article'  value=".$data[$i]['id'].">
                        <input type='submit' value='voir les commentaires'>
                        </form>";
                        echo "</div>";
                        echo "</article>";
                    } 
                    
                } 
                $_SESSION['number']=$i;
                echo "<center>";
                echo "<div class='next-back'>" ;
                echo "<a href='next.php'>suivant</a>";
                echo "</div>";
                echo "</center>";
            }
            else{
                for ($i=$f; $i<=$f+4; $i++){
                    if(isset($data[$i]["title"])){
                    echo "<article>";
                    echo "<label>".$data[$i]["title"]."<label>";
                        if($i%2){
                            echo"<div class='flex'>";
                            echo "<div>";
                            echo "<img src=".$data[$i]["image"].">";
                            echo "</div>";
                            echo "<div>";
                            echo $data[$i]["content"];
                            echo "</div>";
                        }else{
                            echo"<div class='flex'>";
                            echo "<div>";
                            echo $data[$i]["content"];
                            echo "</div>";
                            echo "<div>";
                            echo "<img src=".$data[$i]["image"].">";
                            echo "</div>";
                            
                        }
                        echo"<form action='comment.php' method='post'>
                        <input type='hidden' name='id_article'  value=".$data[$i]['id'].">
                        <input type='submit' value='voir les commentaires'>
                        </form>";
                        echo "</div>";
                        echo "</article>"; 
                    }
                    
                }
                $_SESSION['number']=$i;
                if($f>=(count($data))){
                    echo "<center>";
                    echo "<div class='next-back'>" ;
                    echo "<a href='prev.php'>précédent</a>";
                    echo "</div>";
                    echo "</center>";
                }else{
                    echo "<center>";
                    echo "<div class='next-back'>" ;
                    echo "<a href='prev.php'>précédent</a>";
                    echo "<a href='next.php'>suivant</a>";
                    echo "</div>";
                    echo "</center>";
                } 
            }
        break;
    }
}
function comment($id_article)
{
    try{
        $data_base=connection();
        $select = $data_base->prepare('SELECT article.id AS id1, commentaire.username, commentaire.content, commentaire.id FROM article INNER JOIN commentaire ON commentaire.article = article.id WHERE article.id= :id_article');
        $select->bindParam(':id_article',$id_article);
        $select->execute();
        $data=$select->fetchAll();
        $number=count($data);
        $i=0;
        while($i<$number){
            echo "<article>Nom utilisateur: ".$data[$i]['username']." ";
            echo "Commentaire: ".$data[$i]['content']."</article>";
            echo "<br>";
            $i++;
        }
        echo "<center><div class='form'>
        <h1> Ajouter un commentaire </h1>
        <form method='post' action='save_comment.php'>
        <label>nom</label>
        <br>
        <input type='text' name='utilisateur' required>
        <br>
        <label>commentaire </label>
        <br>
        <textarea name='commentaire' required></textarea>
        <input type='hidden' name='id_article' value='$id_article'>
        <input type='submit' name='valider'>
        </form></div></center>";
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
} 

function save_comment($id_article,$username,$content)
{
    $data_base=connection();
    try {
        $insert=$data_base->prepare('INSERT INTO commentaire (username,article,content) VALUE (:username,:article,:content)');
        $insert->bindParam(':username',$username);
        $insert->bindParam(':article',$id_article);
        $insert->bindParam(':content',$content);
        $insert->execute();
        echo "<center><p>commentaire enregistré</p>
        <form method='post' action='comment.php'>
        <input type='hidden' name='id_article' value='$id_article'>
        <input type='submit' value='retour au commentaire'>
        </center>";
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
function connection_admin($user,$password)
{
    $data_base=connection();
    $req = $data_base->prepare('SELECT * FROM user WHERE username = :username');
    $req->bindValue(':username',$user, PDO::PARAM_STR);
    $req->execute();
    $data=$req->fetch();
    echo $data['password'];
    if (password_verify($password, $data['password'])) // Acces OK !
    {
        $_SESSION['id_user']=$data['id'];
        $_SESSION['user'] = $data['username'];
        header("Location: admin.php"); 
    
    }
    else // Acces pas OK !
    {  
        $message = '<center><br /><br /><br /><p>Une erreur s\'est produite 
            pendant votre identification.<br /> Le mot de passe ou l\'identifiant
                entré, n\'est pas correct.</p><p> 
                <a class="red" href="connection.php">Cliquez ici pour revenir à la page précédente</a>
                <br /><br />
                <a class="red" href="../index.php">Cliquez ici pour revenir à la page d\'accueil</a> 
            </p></center>';
        echo $message;
    }
    $req->CloseCursor();

}
function deconnexion()
{
    session_destroy();
    header("Location: ../index.php");

}
function show_article()
{
    $id_user=$_SESSION["id_user"];
    try {
        $data_base=connection();
        $req = $data_base->prepare('SELECT * FROM article WHERE author = :id');
        $req->bindValue(':id',$id_user, PDO::PARAM_STR);
        $req->execute();
        $data=$req->fetchAll();
        foreach($data as $value){
            echo "<center>".$value["title"]."<form action='update_article.php' method='post'>
            <input type='hidden' name='id_article' value=".$value['id'].">
            <input type='submit' value='modifier'></form><form action='delete_article.php' method='post'>
            <input type='hidden' name='id_article' value=".$value['id'].">
            <input type='submit' value='supprimer'></form></center>";
            echo "<br>";
        }
        echo "<center><div class='form'><form method='post' action='save_article.php' enctype='multipart/form-data'>
            <h1>Créer un article</h1>
            <label>nom </label>
            <br>
            <input type='text' name='title' required>
            <br>
            <label>commentaire </label>
            <br>
            <textarea name='description' required></textarea>
            <br>
            <label>Image </label>
            <br>
            <input type='file' name='file' required>
            <input type='submit' name='valider'>
            </form></div></center>";
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
function save_article($title,$description,$file)
{
    $data_base=connection();
    $name = "../image/".$file["name"];
   // $extension=substr($file["name"],-4);
    $result = move_uploaded_file($file['tmp_name'],$name);
   // $file_new_name=crypt($file["name"]).$extension;
    if ($result) echo "Transfert réussi";
   // rename("../image/".$file["name"], "../image/".$file_new_name);
    try {
        $insert=$data_base->prepare('INSERT INTO article (title,content,image,author) VALUE (:title,:content,:image,:author)');
            $insert->bindParam(':title',$title);
            $insert->bindParam(':content',$description);
            $insert->bindParam(':image',$file_new_name);
            $insert->bindParam(':author',$_SESSION['id_user']);
            $insert->execute();
            header("Location: admin.php");
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
function delete_article($id_article)
{
    $data_base=connection();
    try {
        $req = $data_base->prepare('SELECT * FROM article WHERE id = :id');
        $req->bindValue(':id',$id_article);
        $req->execute();
        $data=$req->fetchAll();
        if(unlink($data[0]['image'])){
            echo "fichier supprimer";
        }
        $delete=$data_base->prepare('DELETE FROM article WHERE id = :id_article');
        $delete->bindParam(':id_article',$id_article);
        $delete->execute();
        header("Location: admin.php");
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
function inscription($username,$password)
{
    try {
        $data_base=connection();
        $req = $data_base->prepare('SELECT COUNT(*) FROM user WHERE username = :username');
        $req->bindParam(':username',$username);
        $req->execute();
        $data=$req->fetchAll();
        if($data[0]['COUNT(*)']==1){
            echo "<center>";
            echo "ce pseudo est déjà utilisé";
            echo "<br>";
            echo "<a href='inscription.php'>Page précédente</a>";
            echo "</center>";
        }else{
            $insert = $data_base->prepare("INSERT INTO `user` (username,password) VALUE (:username, :password)");
            $insert->bindParam(':username',$username);
            $insert->bindParam(':password',$password);
            $insert->execute();
            header("Location: connection.php");
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
function select_article($id_article)
{
    try {
    $data_base=connection();
        $req = $data_base->prepare('SELECT * FROM article WHERE id = :id');
        $req->bindValue(':id',$id_article);
        $req->execute();
        $data=$req->fetchAll();
        echo "<center><div class='form'><form method='post' action='update.php' enctype='multipart/form-data'>
            <h1>modifier un article</h1>
            <label>nom </label>
            <br>
            <input type='text' name='title' value='".$data[0]['title']."' required>
            <br>
            <label>commentaire </label>
            <br>
            <textarea name='description'  required></textarea>
            <br>
            <label>Image </label>
            <br>
            <input type='file' name='file'   required>
            <input type='hidden' name='id_article' value='$id_article'>
            <input type='submit' value='valider' >
            </form></div></center>";
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
function update_article($title,$description,$file,$id_article)
{
    $data_base=connection();
    $name = "../image/".$file["name"];
    $result = move_uploaded_file($file['tmp_name'],$name);
    if ($result) echo "Transfert réussi";
    try {
        $req = $data_base->prepare('SELECT * FROM article WHERE id = :id');
        $req->bindValue(':id',$id_article);
        $req->execute();
        $data=$req->fetchAll();
        if(unlink($data[0]['image'])){
            echo "fichier supprimer";
        }
        $update=$data_base->prepare('UPDATE article SET title=:title,content=:content,image=:image,author=:author WHERE id = :id');
            $update->bindParam(':title',$title);
            $update->bindParam(':content',$description);
            $update->bindParam(':image',$name);
            $update->bindParam(':author',$_SESSION['id_user']);
            $update->bindParam(':id',$id_article);
            $update->execute();
            header("Location: admin.php");
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}