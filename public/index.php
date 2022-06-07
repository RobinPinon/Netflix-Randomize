<?php       
  $bdd = new PDO('mysql:host=localhost;dbname=netflix_rdm', 'root', '');

  // Get max id List Film for random 
  $listMovieMaxIdReq = $bdd->prepare('SELECT MAX(id_movie) FROM movie WHERE seen_movie = false');
  $listMovieMaxIdReq->execute();
  $listMovieMaxIdRes = $listMovieMaxIdReq->fetchAll();

  // Get max id List Film for random 
  $listMovieMinIdReq = $bdd->prepare('SELECT MIN(id_movie) FROM movie WHERE seen_movie = false');
  $listMovieMinIdReq->execute();
  $listMovieMinIdRes = $listMovieMinIdReq->fetchAll();

  // CREATE RANDOMIZE
  $randomNumber = rand($listMovieMinIdRes[0][0], $listMovieMaxIdRes[0][0]);

  // GET Random Movie with $randomNumber
  $getRandomMovieReq = $bdd->prepare('SELECT id_movie, name_movie, image_movie FROM movie WHERE id_movie = '. $randomNumber);
  $getRandomMovieReq->execute();
  $getRandomMovieRes = $getRandomMovieReq->fetch();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/app.css">
    <title>Netflix Randomize</title>
  </head>
  <body>
    <div class="pageWrapper">
      <div class="movieRandommedSelected">
        <div class="movieRandommedSelected__name">
          <?= $getRandomMovieRes['name_movie'] ?>
        </div>
        <div class="movieRandommedSelected__image">
          <?= '<img src="data:image/jpeg;base64,'.base64_encode($getRandomMovieRes['image_movie']).'"/>'; ?>
        </div>
      </div>

      <div class="movieRandommedSelected__modal">
        Click to get your random movie
      </div>
    </div>
  </body>
</html>