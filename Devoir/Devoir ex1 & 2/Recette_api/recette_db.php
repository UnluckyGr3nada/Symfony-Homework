<?php 

$host = "localhost";
$dbname = "recette_api";
$username = "root";
$password = "";


try { 
    // creation d'une instance PDO pour se connecter à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname; charset=utf8", $username, $password); 
    
    // définir le mode d'erreur de PDO sur Exception pour gérer les erreurs de connexion
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connected successfully";
}catch (PDOException $e) { 
    header("Content-Type: application/json");
   echo json_encode(array("error" => "Connection failed: " . $e->getMessage()));
   exit();
}
?>
