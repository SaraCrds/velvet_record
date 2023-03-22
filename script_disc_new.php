<?php
    // recuperation données
    $title = (isset($_POST['title']) && $_POST['title'] != "") ? $_POST['title'] : Null;
    $year = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year'] : Null;
    $genre = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
    $label = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
    $price = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null;
    $artist = (isset($_POST['artist']) && $_POST['artist'] != "") ? $_POST['artist'] : Null;

    // recuperation image
    $uploads_dir = '/home/stagiaire/Bureau/formation_afpa_de_castro_sara/php/velvet_record/assets/img';
    if ($_FILES["picture"]["error"] != 0) { 
        $picture = Null;
     } 
    else {
        $allowed = array('gif', 'png', 'jpg', 'jpeg');
        $picture = $_FILES['picture']['name'];
        $ext = pathinfo($picture, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            $picture = Null;
        }
        else
        {
            move_uploaded_file($_FILES["picture"]["tmp_name"], "$uploads_dir/$picture");   
        } 
    }

    // renvoie vers le formulaire si pas bien rempli
    if ($title == Null || $year == Null || $genre == Null || $label == Null || $price == Null || $artist == Null || $picture == Null) {
        header("Location: disc_new.php");
        exit;
    }

    // 
    require "db.php"; 
    $db = connexionBase();


try {
    // Construction de la requête INSERT sans injection SQL :
    $requete = $db->prepare("INSERT INTO disc (disc_title, disc_year, disc_label, disc_genre, disc_price, artist_id, disc_picture) 
    VALUES (:title, :year, :label, :genre, :price, :artist, :picture);");

    // Association des valeurs aux paramètres via bindValue() :
    $requete->bindValue(":title", $title, PDO::PARAM_STR);
    $requete->bindValue(":year", $year, PDO::PARAM_STR);
    $requete->bindValue(":label", $label, PDO::PARAM_STR);
    $requete->bindValue(":genre", $genre, PDO::PARAM_STR);
    $requete->bindValue(":price", $price, PDO::PARAM_STR);
    $requete->bindValue(":artist", $artist, PDO::PARAM_INT);
    $requete->bindValue(":picture", $picture, PDO::PARAM_STR);

    // Lancement de la requête :
    $requete->execute();

    // Libération de la requête (utile pour lancer d'autres requêtes par la suite) :
    $requete->closeCursor();
}

// Gestion des erreurs
catch (Exception $e) {
    var_dump($requete->queryString);
    var_dump($requete->errorInfo());
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_disc_new.php)");
}

// Si OK: redirection vers la page artists.php
header("Location: artist.php");

// Fermeture du script
exit;
?>