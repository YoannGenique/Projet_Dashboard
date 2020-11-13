<?php
// on demarre la session
session_start();



if($_POST){
    if(isset($_POST['Nom']) && !empty($_POST['Nom'])
    && isset($_POST['Reference']) && !empty($_POST['Reference'])
    && isset($_POST['Categorie']) && !empty($_POST['Categorie'])
    && isset($_POST['Dateachat']) && !empty($_POST['Dateachat'])
    && isset($_POST['Prix']) && !empty($_POST['Prix'])
    && isset($_POST['Lieux']) && !empty($_POST['Lieux'])
    && isset($_POST['fingarantie']) && !empty($_POST['fingarantie'])
    && isset($_POST['Conseils']) && !empty($_POST['Conseils'])
    && isset($_POST['Ticket']) && !empty($_POST['Ticket'])
    && isset($_POST['Manuel']) && !empty($_POST['Manuel'])){
            
            //On fait la connection à la base
            require_once('connect.php');
            

                // On nettoie les données envoyées
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

                $sql = 'INSERT INTO `produit` (`Nom`, `Reference`, `Categorie`, `Dateachat`, `Prix`, `Lieux`, `fingarantie`, `Conseils`, `Ticket`, `Manuel`) VALUES (:Nom, :Reference, :Categorie, :Dateachat, :Prix, :Lieux, :fingarantie, :Conseils, :Ticket, :Manuel)';

                $query = $db->prepare($sql);

                $query->bindValue(':Nom', $Nom, PDO::PARAM_STR);
                $query->bindValue(':Reference', $Reference, PDO::PARAM_STR);
                $query->bindValue(':Categorie', $Categorie, PDO::PARAM_STR);
                $query->bindValue(':Dateachat', $Dateachat, PDO::PARAM_STR);
                $query->bindValue(':Prix', $Prix, PDO::PARAM_STR);
                $query->bindValue(':Lieux', $Lieux, PDO::PARAM_STR);
                $query->bindValue(':fingarantie', $fingarantie, PDO::PARAM_STR);
                $query->bindValue(':Conseils', $Conseils, PDO::PARAM_STR);
                $query->bindValue(':Ticket', $Ticket, PDO::PARAM_STR);
                $query->bindValue(':Manuel', $Manuel, PDO::PARAM_STR);

                $query->execute();

                $_SESSION['message'] = "Success Votre Produit à été Ajouter avec succès";
                
                require_once('close.php');

                header('Location:dashboard.php');

           


    }else{
        $_SESSION['erreur'] = "Il vous reste des champs à Remplir";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Produit</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/navbartop.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/ajout.css">
</head>
<body>
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
                            <a class="dropdown-item" href="authentification.php?action=deconnexion">Deconnexion</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                        if(!empty($_SESSION['erreur'])){
                            echo '<div class="alert alert-danger" role="alert">
                                    '. $_SESSION ['erreur'].'
                                </div>';
                                $_SESSION['erreur'] = '';
                        }
                        ?>
                    <h1>Ajout d'un Produit</h1>
                    <form method="POST">
                        <div class="form-group">
                            <label for="Nom">Nom</label>
                            <input type="text" id="Nom" name="Nom" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Reference">Référence du Produit</label>
                            <input type="text" id="Reference" name="Reference" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Categorie">Catégorie (Tv, Hifi, Périphérique..etc)</label>
                            <input type="text" id="Categorie" name="Categorie" class="form-control">
                        </div>
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
                            <label for="Ticket">Ticket d'achat</label>
                            <input type="text" id="Ticket" name="Ticket" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Manuel">Manuel d'utilisation</label>
                            <input type="text" id="Manuel" name="Manuel" class="form-control">
                        </div>
                        <button class="btn btn-secondary btn-lg">Enregistrer</button>
                    </form>
            </section>
        </div>
    </main>
        <!-- script bootstrap -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>  
        <!-- Fin script bootstrap -->
</body>
</html>