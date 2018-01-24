
<link href="./CSS/main.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div id="content" class="post">
<?php 


include('./lib/config.php');

// On commence par récupérer les champs 
if(isset($_POST['username']))      $nom=$_POST['username'];
else      $nom="";

if(isset($_POST['text']))      $text=$_POST['text'];
else      $text="";

if(isset($_POST['mood']))      $mood=$_POST['mood'];
else      $mood="";


// On vérifie si les champs sont vides 

 // connexion à la base
try{
$conn = new PDO("mysql:host=$servername; dbname=$myDB; port=$port", $username, $password);
    // on écrit la requête sql 
     $conn->exec("INSERT INTO erg_seminaire(date_d, username, message, mood) VALUES(NOW(),'$nom','$text','$mood')");

     echo "Message Posté. Merci !";

     ?>
     <li class="post">
     <a href="./index.html"><button id="button">Poster un autre message</button></li></a>
     <li class="post">
     	<a href="./get/index.php">
     <button id="button">Page d'acceuil</button>
</li></a>
     <?php

     }catch(Exception $e){
      echo "Error: " . $e->getMessage();
      exit;
    }
    
?>

</div>