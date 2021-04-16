<?php
$endPoint = "https://mangamint.kaedenoki.net/api/manga/";
$pageNumber = 1;
$manga = file_get_contents("{$endPoint}page/{$pageNumber}");
$manga = json_decode($manga);

print_r($manga);
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
      <div class="col-md-6">
        <?php foreach ($manga->manga_list as $row): ?>
          <!-- html... -->
        <?php endforeach; ?>
        <div class="card">
          <img src="<?=$row->thumb?>" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title"><?=$row->title?></h5>
          </div>
          <ul class="list-group list-group-flush">
              <li class="list-group-item">Jenis: <?=$row->type?></li>
              <li class="list-group-item">Chapter: <?=$row->chapter?></li>
            </ul>
          <div class="card-body">
            <p class="card-text">
              <small class="text-muted">Diperbarui <?=$row->update_on?> yang lalu</small>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>