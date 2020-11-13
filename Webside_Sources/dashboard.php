<?php
// on demarre la session
session_start();

//On fait la connection à la base
require_once('assets/require/connect.php');

$sql = 'SELECT * FROM `produit`';
// On prepare la requete
$query = $db->prepare($sql);
// on execute la requete
$query->execute();

// on stock le result dans un tableau assoc
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('assets/require/close.php');
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap + css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/navbartop.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/tableau.css">
    <!-- Fin Bootstrap -->

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
                                    '. $_SESSION ['erreur'].'
                                </div>';
                                $_SESSION['erreur'] = "";
                        }
                    ?>
                    <?php
                        if(!empty($_SESSION['message'])){
                            echo '<div class="alert alert-success" role="alert">
                                    '. $_SESSION ['message'].'
                                </div>';
                                $_SESSION['message'] = "";
                        }
                    ?>
                        <div>
                            <img src="assets/img/chatd.png" alt="Chat" width="100px" height="100px">
                            <h1> Inventaire </h1>
                            <img src="assets/img/chatg.png" alt="chat" width="100px" height="100px">
                        </div>
                    <table class="table">
                        <thead>
                            <th>ID produit</th>
                            <th>Nom du produit</th>
                            <th>Référence produit</th>
                            <th>Catégorie</th>
                            <th>Date d'achat</th>
                            <th>Prix</th>
                            <th>Lieux d'achat</th>
                            <th>Date fin garantie</th>
                            <th>Conseils d'entretiens</th>
                            <th>Ticket d'achat</th>
                            <th>Manuel d'utilisation</th>
                        </thead>
                        <tbody>
                            <?php
                            // on boucle la var result
                            foreach($result as $produit){
                            ?>
                            <tr>
                                <td class="id_produit"><?=$produit['id'] ?></td>
                                <td><?=$produit['Nom'] ?></td>
                                <td><?=$produit['Reference'] ?></td>
                                <td><?=$produit['Categorie'] ?></td>
                                <td><?=$produit['Dateachat'] ?></td>
                                <td><?=$produit['Prix'] ?></td>
                                <td><?=$produit['Lieux'] ?></td>
                                <td><?=$produit['fingarantie'] ?></td>
                                <td><?=$produit['Conseils'] ?></td>
                                <td><?=$produit['Ticket'] ?></td>
                                <td><?=$produit['Manuel'] ?></td>
                                <td><a href="details.php?id=<?= $produit['id']?>"><img src="assets/img/voir.png" alt="Inspecter" width="25px" height="25px"></a><a href="modif.php?id=<?= $produit['id'] ?>"><img src="assets/img/modif.png" alt="Modif" width="25px" height="25px"></a>  <a href="assets/require/supp.php?id=<?= $produit['id'] ?>"><img src="assets/img/supprimer.png" alt="Modif" width="25px" height="25px"></a></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                </table>
            </section>
        </div>
    </main>
        <!-- script bootstrap -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>  
        <!-- Fin script bootstrap -->
</body>
</html>