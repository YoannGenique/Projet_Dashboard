<?php
/*
    OBJECTIFS:
        - Le but est de traiter le formulaire de connexion de la page index.php avec deux champs input
        nommée [email & password]
        - Il faudra sécuriser les champs par des regEX (optionnel/secondaire) et aussi eviter les
        injections de type XSS
        SECONDAIRE :
            Appeller les classes d'objets pour gerer les connexion a la base de données 
    ALGORITHMIE :
        On doit recuperer les valeurs transmises par le formulaire dans la Super GLOBALE POST seulement
        si elle ne sont pas vides
            SI la variable n'est pas vide ALORS
                - On fait le traitements et vérifications des données ainsi que la protection contre les
                failles de type XSS
                - On va se connecter à la base de données pour vérifier si les données entre le 
                formulaire et la bdd sont les mêmes !
                SI la comparaison est bonne ALORS
                    Gerer et sauvegarder les cookies de connexion dans le navigateur
                    Et rediriger vers l'espace de l'interface de gestion des produits et autres
            SINON
                Notifier que l'identifiant ou le mot de passe est incorrect 
*/
$email = null;
$password = null;

if (isset($_POST['email']) && isset($_POST['password']))
{
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    // DEBUT Partie de connexion à la base de données
    $database = new PDO('mysql:hostname=localhost;dbname=dashboard','root','');

    $query = $database->prepare('SELECT * FROM users WHERE email = :email ;');
    $query->bindParam(':email', $email);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    // $query->closeCursor();
    // FIN Partie de connexion
    // DEBUG : print_r($result);

    if (empty($result['email']) || empty($result['password'])) {
        exit('Identifiant ou mot de passe incorrect');
    }
    else {
        if (($result['email'] == $email) && ($result['password'] == $password)) {            
            header('Location:dashboard.php');
        }
        else {
            echo 'Identifiant ou mot de passe incorrect';
        }
    }
    
}