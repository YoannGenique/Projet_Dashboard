<?php
// On démarre une session
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
        // On inclut la connexion à la base
        require_once('assets/require/connect.php');

        // On nettoie les données envoyées
        $id = strip_tags($_POST['id']);
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

        $sql = 'UPDATE `produit` SET `Nom`=:Nom, `Reference`=:Reference, `Categorie`=:Categorie, `Dateachat`=:Dateachat, `Prix`=:Prix, `Lieux`=:Lieux, `fingarantie`=:fingarantie, `Conseils`=:Conseils, `Ticket`=:Ticket, `Manuel`=:Manuel WHERE `id`=:id;';

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
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

        $_SESSION['message'] = "Votre Produit à été modifié";
        require_once('assets/require/close.php');

        header('Location:dashboard.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('assets/require/connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `produit` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $produit = $query->fetch();

    // On vérifie si le produit existe
    if(!$produit){
        $_SESSION['erreur'] = "Votre ID n'existe pas";
        header('Location: dashboard.php');
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: dashboard.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/navbartop.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/ajout.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
                            <a class="dropdown-item" href="ajout.php">Ajouter un produit</a><br>
                            <a class="dropdown-item" href="assets/require/deconnection.php">Déconnexion</a>
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
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <h1>Modifier le produit:<br> <?= $produit['Nom'] ?></h1>
                <form method="post">
                <div class="form-group">
                            <label for="Nom">Nom</label>
                            <input type="text" id="Nom" name="Nom" class="form-control" value="<?php echo "$produit[Nom]"?>">
                        </div>
                        <div class="form-group">
                            <label for="Reference">Référence du Produit</label>
                            <input type="text" id="Reference" name="Reference" class="form-control" value="<?php echo "$produit[Reference]"?>">
                        </div>
                        <div class="form-group">
                            <label for="Categorie">Catégorie</label>
                            <br>
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
                            <input class="form-check-input" type="radio" name="Categorie" id="inlineRadio3" value="Consoles de Jeux, Accessoires4">
                            <label class="form-check-label" for="inlineRadio4">Consoles de Jeux, Accessoires</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Categorie" id="inlineRadio3" value="Jouets">
                            <label class="form-check-label" for="inlineRadio5">Jouets</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Categorie" id="inlineRadio3" value="Ustenciles de cuisine">
                            <label class="form-check-label" for="inlineRadio6">Ustenciles de cuisine</label>
                            </div>
                        <div class="form-group">
                            <label for='Dateachat'>Date d'achat du Produit</label>
                            <input type="date" id='Dateachat' name='Dateachat' class="form-control" value="<?php echo "$produit[Dateachat]"?>">
                        </div>
                        <div class="form-group">
                            <label for="Prix">Prix</label>
                            <input type="text" id="Prix" name="Prix" class="form-control" value="<?php echo "$produit[Prix]"?>">
                        </div>
                        <div class="form-group">
                            <label for="Lieux">Lieux d'achat du Produit</label>
                            <input type="text" id="Lieux" name="Lieux" class="form-control" value="<?php echo "$produit[Lieux]"?>">
                        </div>
                        <div class="form-group">
                            <label for="fingarantie">Date de fin de Garantie</label>
                            <input type="date" id="fingarantie" name="fingarantie" class="form-control" value="<?php echo "$produit[fingarantie]"?>">
                        </div>
                        <div class="form-group">
                            <label for="Conseils">Conseils d'Entretient</label>
                            <input type="text" id="Conseils" name="Conseils" class="form-control" value="<?php echo "$produit[Conseils]"?>">
                        </div>
                        <div class="form-group">
                            <label for="Ticket">Ticket d'achat</label>
                            <input type="text" id="Ticket" name="Ticket" class="form-control" value="<?php echo "$produit[Ticket]"?>">
                        </div>
                        <div class="form-group">
                            <label for="Manuel">Manuel d'utilisation</label>
                            <input type="text" id="Manuel" name="Manuel" class="form-control" value="<?php echo "$produit[Manuel]"?>">
                        </div>
                    <input type="hidden" value="<?= $produit['id']?>" name="id">
                    <button class="btn btn-primary">Enregistrer</button>
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