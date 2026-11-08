<?php 

require 'db.php';

$csvFile = 'paris.csv';

if (file_exists($csvFile)) {
    if (($handle = fopen($csvFile, 'r')) !== FALSE) {
            

        // preparation de la requête SQL pour insérer les données dans la base de données
     $stmt = $pdo->prepare("INSERT INTO weather_forecasts (forecast_date, city, period, summary, summary_id, temp_min, temp_max, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    //  lire les données du fichier CSV et les insérer dans la base de données

    while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
     if (count($data) >= 8) { // Vérifier que le nombre de colonnes est correct
        $stmt->execute([
       trim($data[0]), // forecast_date
       trim($data[1]), // city
       trim($data[2]), // period
       trim($data[3]), // summary   
       trim($data[4]), // summary_id
       trim($data[5]), // temp_min
       trim($data[6]), // temp_max
       trim($data[7])  // comment
        ]); 
        
     }

    }
    fclose($handle);
    echo "Données insérées avec succès dans la base de données.";
    } else {
        echo "Erreur lors de l'ouverture du fichier CSV.";
    }
} else {
    echo "Le fichier CSV n'existe pas.";
}   
?>
<br> 
<a href="index.php">Retour à l'accueil</a>