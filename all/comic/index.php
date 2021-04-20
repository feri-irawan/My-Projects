<?php
$endPoint = "https://mangamint.kaedenoki.net/api/";
$pageNumber = (isset($_GET["page"])) ? $_GET["page"] : 1;
$manga = file_get_contents("{$endPoint}manga/page/{$pageNumber}");
$manga = json_decode($manga);

//print_r($manga);

// Genre
$genres = file_get_contents("{$endPoint}genres");
$genres = json_decode($genres);

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
  
  <style>
    @media (min-width: 768px) {
      :root {
        font-size: 10px;
      }
    }
  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Comic</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Populer</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Genre(s)
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </header>
  <section class="container p-3">
    <div class="row">
        
        <?php foreach ($manga->manga_list as $row): ?>
        <div class="col-md-3 mb-3">
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
    
<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="?page=<?=(isset($_GET["page"]) > 1) ? $_GET["page"] - 1 : "#"; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php for ($i = 1; $i <= 5; $i++): ?>
    <li class="page-item"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
    <?php endfor; ?>
    <li class="page-item">
      <a class="page-link" href="?page=<?= $_GET["page"] + 1; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
  </section>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>