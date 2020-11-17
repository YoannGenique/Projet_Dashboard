<?php
// on demarre la session
session_start();
// Si le mail et le mdp ne sont pas stocker dans la global session alors redirection pas login
if(!isset($_SESSION['mail']) && !isset($_SESSION['pass'])){
    $_SESSION['nolog'] = "Veuillez vous identifiez";
    header('location:index.php');
}
//Si la var $_POST, $_FILES sont déclaré
if($_POST && $_FILES){
    //Vérifie Si les champs ne sont pas vide
    if(isset($_POST['Nom']) && !empty($_POST['Nom'])
    && isset($_POST['Reference']) && !empty($_POST['Reference'])
    && isset($_POST['Categorie']) && !empty($_POST['Categorie'])
    && isset($_POST['Dateachat']) && !empty($_POST['Dateachat'])
    && isset($_POST['Prix']) && !empty($_POST['Prix'])
    && isset($_POST['Lieux']) && !empty($_POST['Lieux'])
    && isset($_POST['fingarantie']) && !empty($_POST['fingarantie'])
    && isset($_POST['Conseils']) && !empty($_POST['Conseils'])
    && isset($_FILES['Ticket']) && !empty($_FILES['Ticket'])
    && isset($_POST['Manuel'])){
            
        // On se connect à la base de donnée
        require_once('assets/require/connect.php');
            
        // On nettoie les données envoyées
        // Supprime les balises HTML et PHP d'une chaîne
        $Nom = strip_tags($_POST['Nom']);
        $Reference = strip_tags($_POST['Reference']);
        $Categorie = strip_tags($_POST['Categorie']);
        $Dateachat = strip_tags($_POST['Dateachat']);
        $Prix = strip_tags($_POST['Prix']);
        $Lieux = strip_tags($_POST['Lieux']);
        $fingarantie = strip_tags($_POST['fingarantie']);
        $Conseils = strip_tags($_POST['Conseils']);
        $Ticket = strip_tags($_POST['Ticket']);
        $Manuel = strip_tags($_POST['Manuel']);

        //met dans la var le chemin ou je veux que le ticket soit save 
        $uploadchemin = 'assets/imgproduit/';
        // On insert dans la var $uploadfile le chemin plus nom du fichier envoyer dans la $_FILES
        $uploadfichier = $uploadchemin . basename($_FILES['Ticket']['name']);
        // Si le fichier télécharger n'est pas déplacé à l'endroit indiqué
        if (!move_uploaded_file($_FILES['Ticket']['tmp_name'], $uploadfichier)){
            $_SESSION['erreurticket'] = "Il y'a eu un problème avec l'importation du ticket";
        }

        // Insert dans la Table produit, les champs remplie correspondant à la ligne correspondant
        $sql = 'INSERT INTO `produit` (`Nom`, `Reference`, `Categorie`, `Dateachat`, `Prix`, `Lieux`, `fingarantie`, `Conseils`, `Ticket`, `Manuel`) VALUES (:Nom, :Reference, :Categorie, :Dateachat, :Prix, :Lieux, :fingarantie, :Conseils, :Ticket, :Manuel)';
        // On prepare la requête
        $query = $db->prepare($sql);
        // On param notre  requete query avec le param adéquat à chaque champ
        $query->bindValue(':Nom', $Nom, PDO::PARAM_STR);
        $query->bindValue(':Reference', $Reference, PDO::PARAM_STR);
        $query->bindValue(':Categorie', $Categorie, PDO::PARAM_STR);
        $query->bindValue(':Dateachat', $Dateachat, PDO::PARAM_STR);
        $query->bindValue(':Prix', $Prix, PDO::PARAM_STR);
        $query->bindValue(':Lieux', $Lieux, PDO::PARAM_STR);
        $query->bindValue(':fingarantie', $fingarantie, PDO::PARAM_STR);
        $query->bindValue(':Conseils', $Conseils, PDO::PARAM_STR);
        $query->bindValue(':Ticket', $uploadfichier, PDO::PARAM_STR);
        $query->bindValue(':Manuel', $Manuel, PDO::PARAM_STR); 
        // excute tt les param rentrer
        $query->execute();
        // On parametre le message si tout à fonctionner
        $_SESSION['message'] = "Success Votre Produit à été Ajouter avec succès";
        // On ferme la base de donnée
        require_once('assets/require/close.php');
        // On fait la redirection vers la dashboard ou sera affiché le message 
        header('Location:dashboard.php');

    }else{
        // On parametre le message d'erreur si les champs ne sont pas complet
        $_SESSION['erreur'] = "Il vous reste des champs à Remplir";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/admin_icon.png"/>
    <title>Ajout Produit</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/navbartop.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/ajout.css">
</head>
<body>
    <!-- Début de ma nav -->
    <nav style="justify-content: space-between;" class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="dashboard.php" style="font-size: 1.8rem;">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div style="justify-content: right!important;" class="clearfix">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li style="margin-right:60px";   class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 1.5rem;">Admin</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="assets/require/deconnection.php">Déconnexion</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Fin de ma nav -->
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                    // Affiche l'erreur si le formulaire n'est pas complet
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                             '. $_SESSION ['erreur'].'
                             </div>';
                            $_SESSION['erreur'] = '';
                    }
                    if(!empty($_SESSION['erreurticket'])){
                        echo '<div class="alert alert-danger" role="alert">
                             '. $_SESSION ['erreurticket'].'
                             </div>';
                            $_SESSION['erreurticket'] = '';
                    }
                ?>
                <h1>Ajout d'un Produit</h1>
                <!-- Début du Formulaire d'ajout Produit -->
                <form method="POST" action="" enctype="multipart/form-data" >
                    <div class="form-group">
                        <label for="Nom">Nom</label>
                        <input type="text" id="Nom" name="Nom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Reference">Référence du Produit</label>
                        <input type="text" id="Reference" name="Reference" class="form-control">
                    </div>
                    <!-- Début du choix de catégorie en input type radio -->
                    <div class="form-group">
                        <label for="Categorie">Catégorie</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Categorie" id="inlineRadio1" value="Tv-Hifi" checked>
                            <label class="form-check-label" for="inlineRadio1">Tv-Hifi</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Categorie" id="inlineRadio2" value="Electroménager">
                            <label class="form-check-label" for="inlineRadio2">Electroménager</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Categorie" id="inlineRadio3" value="Informatique">
                            <label class="form-check-label" for="inlineRadio3">Informatique</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Categorie" id="inlineRadio4" value="Consoles de Jeux, Accessoires">
                            <label class="form-check-label" for="inlineRadio4">Consoles de Jeux, Accessoires</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Categorie" id="inlineRadio5" value="Jouets">
                            <label class="form-check-label" for="inlineRadio5">Jouets</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Categorie" id="inlineRadio6" value="Ustenciles de cuisine">
                            <label class="form-check-label" for="inlineRadio6">Ustenciles de cuisine</label>
                        </div>
                    </div>
                    <!-- Fin du choix de catégorie en input type radio -->
                    <div class="form-group">
                        <label for='Dateachat'>Date d'achat du Produit</label>
                        <input type="date" id='Dateachat' name='Dateachat' class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Prix">Prix</label>
                        <input type="text" id="Prix" name="Prix" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="Lieux">Lieux d'achat du Produit</label>
                            <input type="text" id="Lieux" name="Lieux" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="fingarantie">Date de fin de Garantie</label>
                            <input type="date" id="fingarantie" name="fingarantie" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="Conseils">Conseils d'Entretient</label>
                            <input type="text" id="Conseils" name="Conseils" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Ticket">Ticket d'achat</label><br>
                        <input type="file" id="Ticket" name="Ticket">
                    </div>
                    <div class="form-group">
                        <label for="Manuel">Manuel d'utilisation</label>
                        <input type="text" id="Manuel" name="Manuel" class="form-control">
                    </div>
                        <button class="btn btn-secondary btn-lg">Enregistrer</button>
                </form>
                <!-- Fin du formulaire d'ajout produit -->
            </section>
        </div>
    </main>
        <!-- script bootstrap -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>  
        <!-- Fin script bootstrap -->
</body>
</html>