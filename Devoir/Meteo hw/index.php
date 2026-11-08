<?php 

require_once 'db.php';


// Fetch le lendemain weather forecast donné depuis la base de données

 $sql = "
 SELECT * FROM weather_forecasts 
 WHERE forecast_date  IN ('2100-12-06', '2100-12-07')
 ORDER BY forecast_date ASC, FIELD(period, 'matin', 'après-midi', 'nuit')";
  $stmt = $pdo->query($sql);
    $forecasts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Service Météo - Paris</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Service Météo : Paris</h1>
        <p>Prévisions météorologiques pour le <strong>lendemain</strong> et le <strong>surlendemain</strong> (Référence : 5 Décembre 2100).</p>
        <hr>

        <?php if (empty($forecasts)): ?>
            <p>Aucune prévision disponible pour les dates spécifiées.</p>
        <?php else: 
        $currentDate = '';
        foreach ($forecasts as $row):
            if ($currentDate !== $row['forecast_date']): 
                $currentDate = $row['forecast_date'];
                echo '<h2>Prévisions pour le ' . htmlspecialchars($currentDate) . '</h2>';
                endif; 
                ?>
            
            <div class="forecast-card">
                    <h3>Période : <?= htmlspecialchars(ucfirst($row['period'])) ?></h3>
                    <p><strong>Temps :</strong> <?= htmlspecialchars($row['summary']) ?></p>
                    <p><strong>Températures :</strong> Min: <span class="temp"><?= htmlspecialchars($row['temp_min']) ?>°C</span> | Max: <span class="temp"><?= htmlspecialchars($row['temp_max']) ?>°C</span></p>
                    <p><em>Commentaire :</em> <?= htmlspecialchars($row['comment']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
        </body>
        </html>
            
            
