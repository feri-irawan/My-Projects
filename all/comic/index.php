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
if (isset($_GET["read"])) {
  $id = $_GET["read"];
  $response = file_get_contents("http://gateway.marvel.com/v1/public/comics/$id?" . $query);
} else {
  $response = file_get_contents('http://gateway.marvel.com/v1/public/comics?' . $query);
}


//convert the json string to an array
$response_data = json_decode($response, true);

//print
if (isset($_GET["read"])) {
  print_r($response_data);
}
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
  
  <section class="container">
    <div class="row">
    <?php foreach ($response_data["data"]["results"] as $comic): ?>
      <div class="col-6">
        <div class="card">
          <img src="<?=$comic['thumbnail']['path'].".".$comic['thumbnail']['extension']?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?=$comic["title"]?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?=$comic["pageCount"]?> pages</h6>
            <a href="?read=<?=$comic['id']?>" class="btn btn-primary">Read now!</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
  </section>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>