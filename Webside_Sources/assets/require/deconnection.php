<?php 
// Démarre la session
session_start();
// Détruit la session(deconnect)
session_destroy();
// redirige vers la page de login
header("location:../../index.php");
exit(); 
?> 