<?php 

// indiquer les clients que le contenu renvoyé est du JSON
header("Content-Type: application/json");


// inclure le fichier de configuration de la base de données
require_once 'recette_db.php';

// recuperer la methode HTTP de la requete

$method=$_SERVER['REQUEST_METHOD'];

// switch pour determiner l'action à effectuer en fonction de la méthode HTTP
switch($method) {
    case 'GET':

        // recuperer toutes les recettes ou une recette spécifique si un id est fourni
        if(isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $stmt = $pdo->prepare("SELECT * FROM recettes WHERE id =  ?");
            $stmt->execute([$id]);
            $recette =  $stmt->fetch(PDO::FETCH_ASSOC);

            if($recette) {
                echo json_encode($recette, JSON_UNESCAPED_UNICODE);
            }else {
                
                http_response_code(404);
                echo json_encode(array("error" => "Recette n'est pas trouvée"));
            }
        }else{
            // recuperer toutes les recettes
            $stmt = $pdo->query("SELECT * FROM recettes");
            $recettes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($recettes, JSON_UNESCAPED_UNICODE);
        }

        break;


    case 'POST':
        // ajout d'une nouvelle recette
        // recuperer les données de la requete POST
        $data = json_decode(file_get_contents("php://input"), true);

        // verifier que les champs requis sont présents
        if(!empty($data['nom']) && !empty($data['pays']) && !empty($data['difficulte']) && !empty($data['details'])) {
            $sql = "INSERT INTO recettes (nom, pays, difficulte, details) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);

            try{
                $stmt-> execute ([
                    
                    $data['nom'],
                    $data['pays'],
                    $data['difficulte'],
                    $data['details']
                ]);
                //  renvoyer un code de réponse 201 (Created) et un message de succès
                http_response_code(201);
                echo json_encode(array("message" => "Recette ajoutée avec succès"));
            }catch(PDOException $e){
                // si une erreur se produit lors de l'insertion, renvoyer un code de réponse 500 (Internal Server Error) et un message d'erreur
                http_response_code(500);
                echo json_encode(array("error" => "Erreur lors de l'ajout de la recette: " . $e->getMessage()));
            }
        }else {
            // si les champs requis sont manquants, renvoyer une erreur 400
            http_response_code(400);
            echo json_encode(array("error" => "Champs requis manquants"));
        }
        break;

        default:
        // si la méthode HTTP n'est pas supportée, renvoyer une erreur 405
            http_response_code(405);
            echo json_encode(array("error" => "Méthode non autorisée"));
            break;
}
        ?>

