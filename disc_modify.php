<?php 
    require "db.php";
    $db = connexionBase();
    $requete = $db->prepare("SELECT * FROM disc
    JOIN artist
    ON artist.artist_id = disc.artist_id
    WHERE disc_id=?;");
    $requete->execute(array($_GET["id"]));
    $myDisc = $requete->fetch(PDO::FETCH_OBJ);
    $requete2 = $db->query("SELECT * FROM artist WHERE NOT artist_id = $myDisc->artist_id;");
    $myArtist = $requete2->fetchAll(PDO::FETCH_OBJ);
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
        <div class="p-2 d-flex aligns-items-center bd-highlight px-3">
            <a class="me-auto bd-highlight px-2 text-white" href="disc_detail.php?id=<?= $myDisc->disc_id ?>"><span class="material-symbols-outlined">arrow_back_ios</span></a>
            <a class="px-2 text-white" href="script_disc_delete.php?id=<?= $myDisc->disc_id ?>" onclick="return confirm('Do you want to delete this disc? \nBe carefull, it is permanent.')"><span class="material-symbols-outlined">delete</span></a>
        </div>
            <!-- IMAGE + TITLE -->
        <div class="p-3 bg-image">
            <div class="row no-gutters m-0 d-flex align-items-center">
                <div class="col-md-3 col-6">
                <img src="assets/img/<?= $myDisc->disc_picture ?>" class="d-block mx-auto w-75" alt="<?= $myDisc->disc_picture ?>">
                </div>
                <div class="col-md-9 col-6">
                    <h1 class="display-4">Disc Modification</h1>
                </div>
            </div>
        </div>
            <!-- DETAILS -->
        <form class="px-5 pt-4 h-50 col-12" action ="script_disc_modify.php" method="post" enctype="multipart/form-data">
        <div class="row no-gutters align-items-center">
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" class="form-control" id="title" value="<?= $myDisc->disc_title ?>">
                </div>
                <div class="mb-3">
                    <label for="artist" class="form-label">Artist:</label>
                    <select class="form-select" name="artist" id="artist">
                      <option selected value="<?= $myDisc->artist_id ?>"><?= $myDisc->artist_name ?></option>
                      <?php foreach ($myArtist as $artist): ?>
                      <option value="<?= $artist->artist_id ?>"><?= $artist->artist_name ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Year:</label>
                    <input type="text" name="year" class="form-control" id="year" value="<?= $myDisc->disc_year ?>">
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label for="genre" class="form-label">Genre:</label>
                    <input type="text" name="genre" class="form-control" id="genre" value="<?= $myDisc->disc_genre ?>">
                </div>
                <div class="mb-3">
                    <label for="label" class="form-label">Label:</label>
                    <input type="text" name="label" class="form-control" id="label" value="<?= $myDisc->disc_label ?>">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="text" name="price" class="form-control" id="price" value="<?= $myDisc->disc_price ?>">
                </div>
            </div>
        </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Picture:</label>
                <input type="file" class="form-control" id="picture" name="picture" value="<?= $myDisc->disc_picture ?>">
            </div>
            <div class="mb-3">
                <input  type="hidden" name="id" class="form-control" id="id" value="<?= $myDisc->disc_id ?>">
            </div>
                <br>
                <button type="submit" name="submit" class="btn btn-primary mx-2">Submit</button>
                <button type="cancel" name="cancel" class="btn btn-primary">Cancel</button>
        </form>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>