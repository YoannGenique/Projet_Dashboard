<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta name="description" content=""> -->
    <meta name="author" content="Génique Yoann, Anthony Marcelin">

    <title>Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/navbar-fixed/">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/navbars/">

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/tableau.css">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="assets/css/navbartop.css" rel="stylesheet">
  </head>
    <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark force">
        <a class="navbar-brand" href="dashboard.php">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="clearfix">
            <div class="collapse navbar-collapse float-right" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropleft">
                        <a class="nav-link dropdown-toggle " href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="dashboard.php">Ajouter un produit</a><br>
                        <a class="dropdown-item" href="authentification.php?action=deconnexion">Deconnexion</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
  <div class="table-responsive">
    <table class="table">
      <thead>
          <th class="id_produit">ID produit</th>
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
              <tr>
                  <td class="id_produit"></td>
                  <td>aaaa</td>
                  <td>aaaa</td>
                  <td>aaaa</td>
                  <td>aaaa</td>
                  <td>aaaa</td>
                  <td>aaaa</td>
                  <td>aaaa</td>
                  <td>aaaa</td>
                  <td>aaaa</td>
                  <td>aaaa</td>
                  <td class="modifsup"><a href=""><img src="assets/img/modif.png" alt="Modif" width="25px" height="25px"></a>  <a href=""><img src="assets/img/supprimer.png" alt="Modif" width="25px" height="25px"></a></td>
              </tr>
      </tbody>
  </table>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>