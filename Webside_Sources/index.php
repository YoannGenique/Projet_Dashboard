<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Yoann Génique">
        <title>Login</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Mon style -->
        <link href="assets/css/formulairelog.css" rel="stylesheet">
    </head>
    <body class="text-center">
        <!-- Formulaire identification -->
        <form action="authentification.php" method="POST" class="form-signin">
            <img class="mb-4" src="assets/img/admin_icon.png" alt="" width="250" height="250">
            <h1 class="h3 mb-3 font-weight-normal">Authentification</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adresse Email" required autofocus><br>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Mot de Passe" required><br>
            <button class="btn myBtn" type="submit">Connexion</button>
            <p class="mt-5 mb-3 text-muted">&copy;2020 DevCode</p>
        </form>
    </body>
</html>
