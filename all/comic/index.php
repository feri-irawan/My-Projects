<?php
$endPoint = "https://mangamint.kaedenoki.net/api/manga/";
$pageNumber = 1;
$manga = file_get_contents("{$endPoint}page/{$pageNumber}");
$manga = json_decode($manga);

//print_r($manga);
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
  
  <section class="container p-3">
    <div class="row">
        
        <?php foreach ($manga->manga_list as $row): ?>
        <div class="col-md-6 mb-3">
          <div class="card">
            <img src="<?=$row->thumb?>" class="card-img-top">
            <div class="card-body">
              <a class="text-decoration-none" href="details.php?comic=<?=$row->endpoint?>" target="_blank">
                <h5 class="card-title"><?=$row->title?></h5>
              </a>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Jenis: <?=$row->type?></li>
                <li class="list-group-item">Chapter: <?=substr($row->chapter, 8)?></li>
              </ul>
            <div class="card-footer text-center">
              <small class="text-muted">Diperbarui <?=$row->updated_on?> yang lalu</small>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        
    </div>
    
<nav class="text-center" aria-label="Page navigation">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="page=<?=(isset($_GET["page"]) > 1) ? $_GET["page"] - 1 : "#"; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php for ($i = 0; $i <= 10; $i++): ?>
    <li class="page-item"><a class="page-link" href="page=<?=$i?>"><?=$i?></a></li>
    <?php endfor; ?>
    <li class="page-item">
      <a class="page-link" href="page=<?=(isset($_GET["page"]) < 10) ? $_GET["page"] + 1 : "#"; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
  </section>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>