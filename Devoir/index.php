<?php

$listeFilms = [
    [
        "titre"       => "The Shawshank Redemption",
        "annee"       => 1994,
        "description" => "Deux hommes emprisonnés se lient d'amitié au fil des années, trouvant réconfort et rédemption grâce à des actes de décence commune."
    ],
    [
        "titre"       => "The Godfather",
        "annee"       => 1972,
        "description" => "Le patriarche vieillissant d'une dynastie du crime organisé transfère le contrôle de son empire clandestin à son fils réticent."
    ],
    [
        "titre"       => "The Dark Knight",
        "annee"       => 2008,
        "description" => "Batman doit affronter le Joker, un criminel semant le chaos à Gotham, tout en luttant contre ses propres limites morales."
    ],
    [
        "titre"       => "Pulp Fiction",
        "annee"       => 1994,
        "description" => "Les vies de deux tueurs à gages, d'un boxeur et d'un couple de braqueurs s'entremêlent dans quatre récits de violence et de rédemption."
    ],
    [
        "titre"       => "Forrest Gump",
        "annee"       => 1994,
        "description" => "Les décennies de l'histoire américaine se déroulent à travers les yeux d'un homme au grand cœur mais à l'esprit simple."
    ],
    [
        "titre"       => "Inception",
        "annee"       => 2010,
        "description" => "Un voleur qui s'infiltre dans les rêves des autres reçoit la mission inverse : implanter une idée dans l'esprit d'un PDG."
    ],
];


$listeAnnees = [];
foreach ($listeFilms as $films){
    if (!in_array($films["annee"], $listeAnnees)){
        $listeAnnees[]= $films["annee"];
    }
}

sort($listeAnnees);

$anneeChoisie = null ;
if (isset( $_GET["annee"])&& $_GET["annee"] !==""){
    $anneeChoisie = (int) $_GET["annee"];

}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche de films</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #2c3e50; }
        ul { list-style: none; padding: 0; }
        li { margin: 6px 0; }
        a { text-decoration: none; color: #2980b9; font-weight: bold; }
        a:hover { text-decoration: underline; }
        .film { border-bottom: 1px solid #ddd; padding: 10px 0; }
        .retour { display: inline-block; margin-top: 20px; }
    </style>
</head>
<body>
 
<h1>Recherche de films</h1>

<?php 

if ($anneeChoisie === null){?>

<h2>Choisissez une année :</h2>
    <ul>

    <?php foreach ($listeAnnees as $annee){?>
   <li>
     <a href="?annee=<?php echo $annee; ?>"><?php echo $annee; ?></a> 
</li>

<?php } ?>

</ul>


<?php } else { ?> 
    <h2>Films de l'année <?php echo $anneeChoisie; ?></h2>

    <?php
    $aTrouverUnFilm = false;

    foreach ($listeFilms as $films){
        if ($films["annee"]== $anneeChoisie){
                            $aTrouverUnFilm = true;
            ?>
                        <div class="film">
                                <strong><?php echo htmlspecialchars($films["titre"]); ?></strong>
                                <p><?php echo htmlspecialchars($films["description"]); ?></p>
            </div>
            <?php
        }
    }
    if (!$aTrouverUnFilm) {
        echo "<p>Aucun film trouvé pour cette année.</p>";
    }
    ?>
 
    <a class="retour" href="index.php">&larr; Retour à la liste des années</a>
 
<?php } ?>
 
</body>
</html>
