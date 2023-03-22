<?php

    include "db.php";
    $db = connexionBase();
    $id = $_GET["id"];
    $requete = $db->prepare("SELECT * FROM disc
    JOIN artist
    ON artist.artist_id = disc.artist_id
    WHERE disc_id=?;");
    $requete->execute(array($id));
    $myDisc = $requete->fetch(PDO::FETCH_OBJ);
    $requete->closeCursor();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>PDO - Liste</title>

    <!-- SPECIAL FONTS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body class="bg-black">
<div class="row no-gutters m-0">
    <div class="col-md-2 col-12 bg-black m-0">
        <nav class="nav flex-column">
            <h1 class="text-white display-6"><br><span class="text-primary">V</span>elvet Record 
            <br></h1>
            <a class="nav-link" href="artist.php">Disks list</a>
            <a class="nav-link active" href="disc_new.php">Add New</a>
            <a class="nav-link" href="#">Search</a>
        </nav>
    </div>
    <div class="container-mini-details col-md-10 col-12 m-0 border-0 p-0 text-white">
            <!-- MODIFY ETC BUTTON -->
        <div class="p-2 d-flex aligns-items-center px-3">
            <a class="me-auto px-2 text-white" href="artist.php"><span class="material-symbols-outlined">arrow_back_ios</span></a>
            <a class="px-2 text-white" href="disc_modify.php?id=<?= $myDisc->disc_id ?>"><span class="material-symbols-outlined">settings</span></a>
            <a class="px-2 text-white" href="script_disc_delete.php?id=<?= $myDisc->disc_id ?>" onclick="return confirm('Do you want to delete this disc? \nBe carefull, it is permanent.')"><span class="material-symbols-outlined">delete</span></div></a>
            <!-- IMAGE + TITLE -->
        <div class="p-3 bg-image">
            <div class="row no-gutters m-0 d-flex align-items-center">
                <div class="col-md-3 col-6">
                <img src="assets/img/<?= $myDisc->disc_picture ?>" class="d-block mx-auto w-75" alt="<?= $myDisc->disc_picture ?>">
                </div>
                <div class="col-md-9 col-6">
                    <h1 class="display-4"><?= $myDisc->disc_title ?></h1>
                    <h2 class="fw-light opacity-50"><?= $myDisc->artist_name ?></h2>
                </div>
            </div>
        </div>
            <!-- DETAILS -->
        <div class="px-5 pt-4 h-50">
            <div class="row no-gutters m-0">
                <div class="col-12">
                <p class="lh-lg font-monospace">
                    Disk Information
                </p>
                </div>
                <hr>
                <div class="col-md-6 col-12 pt-3">
                    <p class="lh-lg font-monospace">
                    Year : <?= $myDisc->disc_year ?>
                    <br>Label : <?= $myDisc->disc_label ?></p>
                </div>
                <div class="col-md-6 col-12 pt-3">
                    <p class="lh-lg font-monospace">
                    Genre : <?= $myDisc->disc_genre ?>
                    <br>Price : <?= $myDisc->disc_price ?>$</p>
                </div>
            </div>
        </div>
	</div>
</div>
</body>
</html>