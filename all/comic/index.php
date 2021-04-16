<?php
$ts = time();
$public_key = 'cfa476604e04fd6e0bc9c86eb904badc';
$private_key = '983e3d08023e136611550d3eca68d89366482d1f';
$hash = md5($ts . $private_key . $public_key);

$query_params = [
    'apikey' => $public_key,
    'ts' => $ts,
    'hash' => $hash
];

//convert array into query parameters
$query = http_build_query($query_params);

//make the request
$response = file_get_contents('http://gateway.marvel.com/v1/public/comics?' . $query);

//convert the json string to an array
$response_data = json_decode($response, true);

//print
print_r($response_data);
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <title>Comic</title>
</head>
<body>
  
  <div class="row">
      
  </div>
  <?php foreach ($response_data["data"]["results"] as $comic): ?>
    <div class="col-6">
      <div class="card" style="width: 18rem;">
        <img src="<?=$comic['thumbnail']['path'].".".$comic['thumbnail']['extension']?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>