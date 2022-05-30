<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYTOTOOL</title>
    <link rel="stylesheet" href="css/styletodo.css">
</head>
<body>


<?php
 
 $erreurs = "";
 $db = new PDO('mysql:host=localhost;dbname=exotodo', 'root', 'root');

 if (isset($_POST['creer_tache'])) { // On vérifie que la variable POST existe
    if (empty($_POST['creer_tache'])) {  // On vérifie qu'elle as une valeure
        $erreurs = 'Vous devez indiquer la valeur de la tâche';
    } else{
        $tache = $_POST['creer_tache'];

        $db->query("INSERT INTO liste(tache) VALUES('$tache')"); // On insère la tâche dans la base de donnée
    }
 }

 if(isset($_GET['supprimer_tache'])) {
     $id = $_GET['supprimer_tache'];
     $db->exec("DELETE FROM liste WHERE id=$id");
 }

 ?>

 <!-- Le bouton déconnexion ramène vers la page login.php -->
<div id="deco">
 <p id="deco2"><a href="login.php"> Déconnexion</a></p>
</div>

 <!-- Petite touche d'humour, c'est mieux pour travailler :) -->
<div class="header">
    <p class="header_titre">Aujourd'hui y'a du taff ! La preuve. </p>
</div>
 
 <!-- La barre qui servira à créer une tâche -->
 <div id="back">
    <form class="taches_input" method="post" action="todo.php">
        <input id="inserer" type="text" name="creer_tache"/>
        <button id="envoyer">Créer</button>
    </form>
</div>

 <!-- Message d'erreur -->
    <?php
   if (isset($erreurs)) {
       ?>
       <p><?php echo $erreurs ?></p>
   <?php
   }
   ?>

 
<table class="taches">
    <tr>
        <th>
            N
        </th>
        <th>
            Nom
        </th>
        <th>
            Action
        </th>
    </tr>
    <?php
    $reponse = $db->query('Select * from liste'); // On exécute une requête visant à récupérer les tâches
    while ($taches = $reponse->fetch()) { // On initialise une boucle
        ?>
        <tr>
            <td><?php echo $taches['id'] ?></td>
            <td><?php echo $taches['tache'] ?></td>
            <td><a class="suppr" href="todo.php?supprimer_tache=<?php echo $taches['id'] ?>"> X</a></td> <!-- une croix pour supprimer la tâche -->
        </tr>
        <?php
    }
 
 
    ?>
 
 
</table>
</body>
</html>