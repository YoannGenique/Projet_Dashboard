<?php
session_start();
// On parametre les entrer sur null
$email = null;
$password = null;
// Supprime les balises HTML et PHP d'une chaîne
$email = strip_tags($_POST['email']);
$password = strip_tags($_POST['password']);

// Si quelque chose est déclaré
if (isset($_POST['email']) && isset($_POST['password'])){

    // On se connect à la base de données, require stop le script si y'a une erreur comparer à include et once sert à la vérification de si le code à déjà été excécuter 
    require_once('../require/connect.php');

    // On prepare une demande de récuperer tout dans colonne email de la table users
    $query = $db->prepare('SELECT * FROM users WHERE email = :email ;');

    // lie le param à ma var query
    $query->bindParam(':email', $email);

    // excute tt les param rentrer
    $query->execute();

    // recup l'entrée de tableau pour l'insérer dans résult
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Si L'email rentrer & le mdp correspond à celui trouver dans la db alors on accede à la connexion
    if($email === $result['email'] && $password === $result['password']){
        $_SESSION['mail'] = $email;
        $_SESSION['pass'] = $password;
        header('location:../../dashboard.php');

    // Sinon On retourne à la page login avec un message d'erreur
    }else{

        $_SESSION['error'] = "Email ou Mot de passe Incorrect";
        header('location:../../index.php');
    }
    
}
