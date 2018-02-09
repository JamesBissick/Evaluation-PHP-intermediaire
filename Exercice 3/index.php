<?php
    /* On demande à toutes ces variables d'être égale à "vide" */
    $title = $actors = $director = $producer = $storyline = "";

    /* Initialiser les messages d'erreur pour qu'ils soient égales à "vide */
    $titleError = $actorsError = $directorError = $producerError = $storylineError = "";

    // Message de remerciement final, false par défault pour ne pas afficher le message
    $isSuccess = FALSE;


    /* Elles prendront les valeurs donné par l'utilisateur via $_POST*/
    /* On veut que les valeurs entrées reste affiché pour l'utilisateur, on va se servir des values dans les inputs */
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = verifyInput($_POST['title']);
        $actors  = verifyInput($_POST['actors']);
        $director  = verifyInput($_POST['director']);
        $producer  = verifyInput($_POST['producer']);
        $storyline  = verifyInput($_POST['storyline']);
        // Si tous les champs sont remplis, on affiche le message de remerciement
        $isSuccess = TRUE;



        // Vérification des informations avec empty()
        if (empty($title)) {
            $titleError = "Please enter the movie title.";
            $isSuccess = FALSE;
        }
        if (empty($actors)) {
            $actorsError = "Please enter the movie cast.";
            $isSuccess = FALSE;
        }
        if (empty($directors)) {
            $directorError = "Please enter the movie's director.";
            $isSuccess = FALSE;
        } 
        if (empty($producer)) {
            $producerError = "Please enter the movie's producer.";
            $isSuccess = FALSE;
        } 
        if (empty($storyline)) {
            $storylineError = "Please enter the movie plot.";
            $isSuccess = FALSE;
        }
    }


    // Nous allons aussi protéger les inputs $_POST, verifyInput()
    function verifyInput($var) {
        $var = trim($var); // le but de trim est de supprimer tous les espaces supplémentaires
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }

    // J'affiche les message d'erreurs
    ini_set('display_errors', 'On');

    // Je me connecte à ma base de données
    $db = new PDO('mysql:host=127.0.0.1;dbname=exercice_3', 'root', '');
    // Check if asked infos are available
    if(!empty($_POST)) {
        $title = verifyInput($_POST['title']);
        $actors  = verifyInput($_POST['actors']);
        $director  = verifyInput($_POST['director']);
        $producer  = verifyInput($_POST['producer']);
        $storyline  = verifyInput($_POST['storyline']);
        // Les POST select menu
        $year_of_prod = verifyInput($_POST['year_of_prod_menu']);
        $language = verifyInput($_POST['language_menu']);
        $category = verifyInput($_POST['category_menu']);


        // Je prepare ma base de données à recevoir des informations
        $req = $db->prepare("INSERT INTO movies (title, actors, director, producer, storyline, year_of_prod, language, category ) VALUES (:title, :actors, :director, :producer, :storyline, :year_of_prod, :language, :category )");
        $req->execute([
            'title' => $title,
            'actors' => $actors,
            'director' => $director,
            'producer' => $producer,
            'storyline' => $storyline,
            'year_of_prod' => $year_of_prod,
            'language' => $language,
            'category' => $category,
        ]);
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <title>Movie Form</title>
    </head>
    <body>
        <div class="container">
            <div class="divider">
                
            </div>
            <div class="heading">
                <h2>Fill in the movies</h2>
            </div>
            <div class="row">
                <!-- (Bootstrap 4) mx-auto: permet de laisser la marge restante pour faire un col 12, ici 2 en marge -->
                <div class="col-lg-10 mx-auto">
                    <form id="movies-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                       <!-- htmlspecialchars() pour sécuriser  --> 
                        <div class="row">
                            <div class="col-md-6">
                                <label for="title">Title<span class="blue"> *</span></label>
                                <input type="text" id="title" name="title" class="form-control" 
                                placeholder="Enter the movie's title" value="<?php echo $title; ?>">
                                <p class="comments"><?php echo $titleError ?></p>
                            </div> 
                            <div class="col-md-6">
                                <label for="actors">Actors<span class="blue"> *</span></label>
                                <input type="text" id="actors" name="actors" class="form-control" 
                                placeholder="Enter the main cast" value="<?php echo $actors; ?>">
                                <p class="comments"><?php echo $actorsError ?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="director">Director<span class="blue"> *</span></label>
                                <input type="text" id="director" name="director" class="form-control" 
                                placeholder="The movie's director" value="<?php echo $director; ?>">
                                <p class="comments"><?php echo $directorError ?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="producer">Producer<span class="blue"> *</span></label>
                                <input type="text" id="producer" name="producer" class="form-control" 
                                placeholder="The movie's producer" value="<?php echo $producer; ?>">
                                <p class="comments"><?php echo $producerError ?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="year_of_prod">Released date<span class="blue"> *</span></label>
                                <?php
                                    
                                    $date = date('Y'); //On prend l'année en cours
                                        // Menu déroulant
                                    echo '<SELECT name="year_of_prod_menu" Size="1">';
                                    
                                        for ($year_of_prod_menu=1930; $year_of_prod_menu<=$date; $year_of_prod_menu++) { //De l'année 2000 à l'année actuelle
                                            echo "<OPTION><br>$year_of_prod_menu<br></OPTION>"; }
                                    echo "</SELECT>";
                                ?>
                            </div>

                            <div class="col-md-6">
                            <!-- Input select pour le menu déroulant des langues -->
                                <label for="language">Language<span class="blue"> *</span></label>
                                <select name="language_menu">
                                    <option value="english">English</option>
                                    <option value="french">French</option>
                                    <option value="spanish">Spanish</option>
                                    <option value="german">German</option>
                                    <option value="portuguese">Portuguese</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                            <!-- Mes categories: 'comedy','horror','action','science_fiction','dramatic_comedy' en menu déroulant -->
                                <label for="category">Category<span class="blue"> *</span></label>
                                <select name="category_menu">
                                    <option value="comedy">Comedy</option>
                                    <option value="horror">Horror</option>
                                    <option value="action">Action</option>
                                    <option value="science_fiction">Science fiction</option>
                                    <option value="dramatic_comedy">Dramatic comedy</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <textarea name="storyline" id="storyline" placeholder="Tell me more about the movie. Write its synopsis." cols="100%" rows="10"><!-- Here enter story line --></textarea>
                            </div>
                            
                            <div class="col-md-12">
                                <input type="submit" class="button1" value="Submit">
                            </div>
                        </div> <!-- END OF ROW -->
                        
                        <!-- Message de comfirmation des informations rentrées -->
                        <p class="thank-you" style="display: <?php if($isSuccess) echo 'block'; else echo 'none' ?>;">All the informations have been sent. Thank you for contributing to the database!</p>
                        <p>Want to see our movie </p>
                        <a href="./display_movie.php">list?</a>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>