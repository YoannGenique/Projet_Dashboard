<?php
$email = null;
$password = null;

if (isset($_POST['email']) && isset($_POST['password']))
{
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    // DEBUT Partie de connexion à la base de données
    $database = new PDO('mysql:hostname=127.0.0.1;dbname=dashboard','root','');

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