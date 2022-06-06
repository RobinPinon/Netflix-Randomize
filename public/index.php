<?php       
  $bdd = new PDO('mysql:host=localhost;dbname=netflix_rdm', 'root', '');
  
  // PDO Prepare list film
  $listMovieReq= $bdd->prepare('SELECT * FROM movie WHERE seen_movie = true');
  $listMovieReq->execute();
  $listMovieRes = $listMovieReq->fetchAll();

  // PDO Get max id List Film for random 
  $listMovieMaxIdReq = $bdd->prepare('SELECT MAX(id_movie) FROM movie WHERE 1');
  $listMovieMaxIdReq->execute();
  $listMovieMaxIdRes = $listMovieMaxIdReq->fetchAll();

  // PDO Get max id List Film for random 
  $listMovieMinIdReq = $bdd->prepare('SELECT MIN(id_movie) FROM movie WHERE 1');
  $listMovieMinIdReq->execute();
  $listMovieMinIdRes = $listMovieMinIdReq->fetchAll();

  // CREATE RANDOMIZE
  $randomNumber = rand($listMovieMinIdRes[0][0], $listMovieMaxIdRes[0][0]);

  // GET Random Movie with $randomNumber
  $getRandomMovieReq = $bdd->prepare('SELECT id_movie, name_movie, image_movie FROM movie WHERE id_movie = '. $randomNumber);
  $getRandomMovieReq->execute();
  $getRandomMovieRes = $getRandomMovieReq->fetchAll();

  var_dump($listMovieRes)
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Netflix Randomize</title>
</head>
<body>

</body>
</html>