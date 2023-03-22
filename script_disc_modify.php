<?php
    // recuperation données
    $id = (isset($_POST['id']) && $_POST['id'] != "") ? $_POST['id'] : Null;
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
    if ($title == Null || $year == Null || $genre == Null || $label == Null || $price == Null || $artist == Null) {
        header("Location: disc_modify.php?id=" . $id);
        exit;
    }

    require "db.php"; 
    $db = connexionBase();

    if ($picture == Null) {
        try {
            $requete = $db->prepare("UPDATE disc SET disc_title = :title, disc_year = :year, disc_label = :label, 
            disc_genre = :genre, disc_price = :price, artist_id = :artist WHERE disc_id = :id;"); 
            $requete->bindValue(":title", $title, PDO::PARAM_STR);
            $requete->bindValue(":year", $year, PDO::PARAM_STR);
            $requete->bindValue(":label", $label, PDO::PARAM_STR);
            $requete->bindValue(":genre", $genre, PDO::PARAM_STR);
            $requete->bindValue(":price", $price, PDO::PARAM_STR);
            $requete->bindValue(":artist", $artist, PDO::PARAM_INT);
            $requete->bindValue(":id", $id, PDO::PARAM_STR);
       
               $requete->execute();
               $requete->closeCursor();
           }

           catch (Exception $e) {
            echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
            die("Fin du script (script_disc_modify)");
        }
       
    }

    else {
        try {
            $requete = $db->prepare("UPDATE disc SET disc_title = :title, disc_year = :year, disc_label = :label, 
            disc_genre = :genre, disc_price = :price, artist_id = :artist, disc_picture = :picture  WHERE disc_id = :id;"); 
            $requete->bindValue(":title", $title, PDO::PARAM_STR);
            $requete->bindValue(":year", $year, PDO::PARAM_STR);
            $requete->bindValue(":label", $label, PDO::PARAM_STR);
            $requete->bindValue(":genre", $genre, PDO::PARAM_STR);
            $requete->bindValue(":price", $price, PDO::PARAM_STR);
            $requete->bindValue(":artist", $artist, PDO::PARAM_INT);
            $requete->bindValue(":picture", $picture, PDO::PARAM_STR);
            $requete->bindValue(":id", $id, PDO::PARAM_STR);
       
               $requete->execute();
               $requete->closeCursor();
           }
        
           catch (Exception $e) {
            echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
            die("Fin du script (script_disc_modify.php)");
        }
       
    }

    // Si OK: redirection vers la page artist_detail.php
    header("Location: disc_detail.php?id=" . $id);
    exit;