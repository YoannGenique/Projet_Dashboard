<?php
// Démarre une nouvelle session ou reprend une session existante
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="assets/img/admin_icon.png"/>

        <!-- Titre de la page -->
        <title>Login</title>
        <!-- Style Bootstrap -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Mon style -->
        <link href="assets/css/formulairelog.css" rel="stylesheet">
    </head>
    <body class="text-center">
        <!-- Formulaire identification -->
        <form action="assets/auth/authentification.php" method="POST" class="form-signin">
            <img class="mb-4" src="assets/img/admin_icon.png" alt="" width="250" height="250">
            <h1 class="h3 mb-3 font-weight-normal">Authentification</h1>
            <?php
                // Si la session contient l'erreur alors afficher le message correspondant 
                if(!empty($_SESSION['error'])){
                    echo '<div class="alert alert-danger" role="alert">
                            '. $_SESSION ['error'].'
                            </div>';
                            $_SESSION['error'] = "";
                }
                // Si la session contient l'erreur alors afficher le message correspondant 
                if(!empty($_SESSION['nolog'])){
                    echo '<div class="alert alert-danger" role="alert">
                            '. $_SESSION ['nolog'].'
                            </div>';
                            $_SESSION['nolog'] = "";
                }
            ?>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adresse Email" required autofocus><br>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Mot de Passe" required><br>
            <button class="btn myBtn" type="submit">Connexion</button>
            <p class="mt-5 mb-3 text-muted">&copy;2020 DevCode</p>
        </form>
        <!-- Fin Formulaire identification -->
    </body>
</html>
