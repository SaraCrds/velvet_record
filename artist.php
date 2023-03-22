<?php

    include "db.php";
    $db = connexionBase();

    $requete = $db->query("SELECT * FROM artist
    JOIN disc
    ON disc.artist_id = artist.artist_id;");
    $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
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
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body class="bg-black">
<div class="row no-gutters m-0">
    <div class="col-md-2 col-12 bg-black m-0">
    <nav class="nav flex-column">
  <h1 class="text-white display-6"><br><span class="text-primary">V</span>elvet Record 
  <br></h1>
  <a class="nav-link active" href="artist.php">Disks list (<?php echo count($tableau); ?>)</a>
  <a class="nav-link" href="disc_new.php">Add New</a>
  <a class="nav-link" href="#">Search</a>
</nav>
    </div>
        <div class="container-mini col-md-10 col-12 m-0 border-0 p-2 text-white d-flex aligns-items-center justify-content-center">

		<!---------- T E S T 01 --------------------------->
		<div class="col-md-12 mx-auto pl-lg-3 pr-md-3 md-0 my-auto">
					<!---------------BEGIN CAROUSEL------------->
					<div class="carousel slide" data-bs-ride="carousel" id="carouselControls">
						<div class="carousel-inner">
                        <?php foreach ($tableau as $disc): ?>
							<!--------------------------------------------------------------- BEGIN MOVING ---------------------------------------------------------->
                                <?php $iditem = $disc->disc_id;
                                if ($iditem == 1){
                                    echo "<div class='carousel-item active'>";
                                }
                                else {
                                    echo "<div class='carousel-item'>";
                                }; ?>
								<!----------- IMAGE DISK -------------------------->
								<div class="my-0">
                                <img src="assets/img/<?= $disc->disc_picture ?>" class="d-block mx-auto img_disk" alt="<?= $disc->disc_picture ?>">
								</div>
								<!-------- DETAILS DISK --------------------------------------->
                                <div class="col-8 mx-auto my-0">
								<div class="row no-gutters align-items-center">
									<div class="col-md-10">

										<h4 class="mt-3 text-truncate text-white" id="title"><?= $disc->disc_title ?></h4>

										<p class="text-white"><?= $disc->artist_name ?></p>
									</div>
									<div class="col-md-2">

										<h4 class="text-uppercase mt-3 text-primary heart">
                                            <span class="material-symbols-outlined ">
                                            favorite
                                            </span>
                                        </h4>
									</div>
								</div>
                                <div class="row no-gutters align-items-center text_layout">
                                        <div class="col-4 mb-3"><p class="text-white">Label: <?= $disc->disc_label ?></p></div>
                                        <div class="col-4 mb-3"><p class="text-white">Year: <?= $disc->disc_year ?></p></div>
                                        <div class="col-4 mb-3"><p class="text-white">Genre: <?= $disc->disc_genre ?></p></div>
                                </div>
                                <div class="col-md-12 text-end text-primary">
                                <a class="seemore" href="disc_detail.php?id=<?= $disc->disc_id ?>">See More ...</a>
                                </div>
							</div>
                            </div>
							<!--------------------------------------------------------------- END MOVING ---------------------------------------------------------->
                        <?php endforeach; ?>
                        </div>
						<!-------------- BUTTONS ------------>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                          </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
					</div>
				</div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>