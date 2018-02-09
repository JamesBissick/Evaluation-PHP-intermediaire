<?php
// J'affiche les erreurs
    ini_set('display_errors', 'On');

    // Je me connecte à ma base de données
    $db = new PDO('mysql:host=127.0.0.1;dbname=exercice_3', 'root', '');
    $req = $db->query("
        SELECT * FROM movies
    ");
    // A défaut de temps j'ai préféré quand même faire un var_dump de ma base de donnée :/ 
    echo '<pre>', var_dump($req->fetchAll(PDO::FETCH_ASSOC)), '</pre>'; // Without (PDO::FETCH_ASSOC) we get duplicates of each entry, it's too much.
    
?> 