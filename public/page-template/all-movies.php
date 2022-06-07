<?php       
  $bdd = new PDO('mysql:host=localhost;dbname=netflix_rdm', 'root', '');

  // Get all movie :
  $listMovieReq = $bdd->prepare('SELECT movie.name_movie, movie.image_movie, movie.rating_movie, genre.name_genre FROM movie INNER JOIN genre ON movie.id_genre = genre.id_genre');
  $listMovieReq->execute();
  $listMovieRes = $listMovieReq->fetchAll();
  
  // Get list film if not saw
  $listMovieNotSeenReq= $bdd->prepare('SELECT * FROM movie WHERE seen_movie = false');
  $listMovieNotSeenReq->execute();
  $listMovieRes = $listMovieNotSeenReq->fetchAll();

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
  $getRandomMovieRes = $getRandomMovieReq->fetchAll();
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
    <div class="movieContainer">
      <?php foreach($listMovieRes as $item) : ?>
        <div class="movieContainer__card">
          <div class="movieContainer__card__name">
            <?= $item['name_movie'] ?>
          </div>
          <div class="movieContainer__card__image">
            <?= '<img src="data:image/jpeg;base64,'.base64_encode($item['image_movie']).'"/>'; ?>
          </div>
          <?php if ($item['rating_movie']) : ?>
            <div class="movieContainer__card__rating">
              <?= $item['rating_movie'] ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>

