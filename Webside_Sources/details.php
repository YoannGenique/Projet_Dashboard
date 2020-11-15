<?php
// on demarre la session
session_start();
// Si le mail et le mdp ne sont pas stocker dans la global session alors redirection pas login
if(!isset($_SESSION['mail']) && !isset($_SESSION['pass'])){
    $_SESSION['nolog'] = "Veuillez vous identifiez";
    header('location:index.php');
}

// es que l'ID existe est n'est pas vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){
    // Connexion à la base
    require_once('assets/require/connect.php');
    
    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `produit` WHERE `id` =:id';
    
    // On prepare la requete
    $query = $db->prepare($sql);

    // On "accroche" les parametres (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On execute la requete
    $query->execute();

    // On récupère le produit
    $produit = $query->fetch();

    // On verifie si le produit existe
    if(!$produit){
        $_SESSION['erreur'] = "Cet ID n'existe pas";
        header('Location:dashboard.php');
    }

    
}else{
        $_SESSION['erreur'] = "URL invalide";
        header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/admin_icon.png"/>
    <title>Détail Produit</title>

    <!-- css boot -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/navbartop.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/tableau.css">
    <!-- fin css boot -->

</head>
<body>
    <!-- Début de Ma nav -->
    <nav style="justify-content: space-between;" class="navbar navbar-expand-md navbar-dark fixed-top bg-dark force">
        <a style="font-size: 1.8rem;" class="navbar-brand" href="dashboard.php">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="clearfix">
            <div class="collapse navbar-collapse float-right" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li style="margin-right:60px"; class="nav-item dropdown">
                        <a style="font-size: 1.5rem;" class="nav-link dropdown-toggle " href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="ajout.php">Ajouter un produit</a><br>
                        <a class="dropdown-item" href="assets/require/deconnection.php">Déconnexion</a>
                    </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Fin de Ma nav -->
    <main class="container detail">
        <div class="row">
            <!-- Bloc de la page détail du produit -->
            <section class="col-12 test">
                <h1 class="h1detail">Détails du Produit:<br> <?= $produit['Nom'] ?> </h1>
                <p>Nom: <?= $produit['Nom'] ?></p>
                <p>Réference Produit: <?= $produit['Reference'] ?></p>
                <p>Catégorie: <?= $produit['Categorie'] ?></p>
                <p>Date D'achat: <?= $produit['Dateachat'] ?></p>
                <p>Prix: <?= $produit['Prix'] ?></p>
                <p>Lieux D'achat: <?= $produit['Lieux'] ?></p>
                <p>Date fin de Garantie: <?= $produit['fingarantie'] ?></p>
                <p>Conseils d'entretiens: <?= $produit['Conseils'] ?></p>
                <p>Ticket D'achat: <?= $produit['Ticket'] ?></p>
                <p>Manuel d'utilisation: <?= $produit['Manuel'] ?></p>
                <!-- Lien vers la page retour, suppression et modification du produit -->
                <p><a href="dashboard.php"><img src="assets/img/retour.png" alt="retour" width="50px" height="50px"></a> <a href="modif.php?id=<?= $produit['id'] ?>"><img src="assets/img/modif.png" alt="retour" width="50px" height="50px"></a>  <a href="assets/require/supp.php?id=<?= $produit['id'] ?>"><img src="assets/img/Supprimer.png" alt="retour" width="50px" height="50px"></a></p>
            </section>
            <!-- Fin du Bloc de la page détail du produit -->
        </div>
    </main>
        <!-- script bootstrap -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>  
        <!-- Fin script bootstrap -->    
</body>
</html>