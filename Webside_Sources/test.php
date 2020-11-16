<?php

    if(isset($_FILES['Ticket']) && !empty($_FILES['Ticket'])){
        $uploaddir = 'assets/imgproduit/';
        $uploadfile = $uploaddir . basename($_FILES['Ticket']['name']);

            if(move_uploaded_file($_FILES['Ticket']['tmp_name'], $uploadfile)){ 
                echo 'Voici le contenu de la $_FILES :';
                var_dump($_FILES);
            } else {
                echo 'Pas marcher, Voici le contenu de la $_FILES :';
                var_dump($_FILES);    
            }
    }
?>
<form method="POST" action="" enctype="multipart/form-data">
    <input type="file" name="Ticket">
    <input type="submit">
</form>
<?php 
echo '<pre>';
echo 'Voici le résultat de la Var super global $_FILES<br>';
var_dump($_FILES);
echo '<br>Voici le résultat de la var name contenu dans le tableau<br>';
echo $_FILES['Ticket']['name'];
echo '<br>Voici le résultat de la Var Type du Tableau<br>';
echo $_FILES['Ticket']['type'];
echo '<br>Voici le résultat de la Var tmp_name du Tableau<br>';
echo $_FILES['Ticket']['tmp_name'];
echo '<br>Voici le résultat de la Var error du Tableau<br>';
echo $_FILES['Ticket']['error'];
echo '<br>Voici le résultat de la Var size du Tableau<br>';
echo $_FILES['Ticket']['size'];
echo '</pre>';
?>