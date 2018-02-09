<?php

    // Je donne un nom $presentation à ma variable et j'ouvre un tableau associatif
    $presentation = array(
        'Prenom' => 'Jean-Marc',
        'Nom' => 'Bissick', 
        'Adresse' => '1 allée Jean-Baptiste Camille Corot',
        'Code Postal' => '76120',
        'Ville' => 'Le Grand-Quevilly',
        'Email' => 'bissickj@gmail.com',
        'Téléphone' => '0635214800',
        'Date de naissance' =>" 1992-02-07", // Format date US
    );
    // J'utilise un loop foreach plus approprié pour les tableaux, ce qui m'afficher la clé (ex: Prenom) et sa valeur (ex: 'Jean-marc')
    foreach ($presentation as $key => $value) {
        // Pour plus de clarté j'ai décidé d'utiliser une balise strong pour mettre en avant les clés
        if ($key != 'Date de naissance') {
            echo "<li><strong>$key</strong>: $value </li>";
        } else {
            // Ne pas oublier de changer le formant US en format français
            // Je dois transformer la valeur string de ma clé 'Date de naissance' en objet pour pouvoir la modifier, 
            // ici, lui donner le format français
            echo "<li><strong>$key</strong>: ", (new \DateTime($presentation['Date de naissance']))->format('d-m-Y'); "</li>";
        }
        
    }
?>

