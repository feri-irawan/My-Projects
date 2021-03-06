<?php

$default_endpoint = "https://mangamint.kaedenoki.net/api";
$pageNumber = (isset($_GET["page"])) ? $_GET["page"] : 1;

// Modified End Point
if (isset($_GET["genre"])) {
  // if there is a Genre
  $genresName = $_GET["genre"];
  $endPoint = "$default_endpoint/genres/$genresName/$pageNumber";
  
} elseif (isset($_GET["rekomendasi"])) {
  $endPoint = "$default_endpoint/recommended";
  
} elseif (isset($_GET["search"])) {
  $keyword = $_GET["search"];
  $endPoint = "$default_endpoint/search/$keyword";
  
} else {
  // Default in homepage
  $endPoint = "$default_endpoint/manga/page/$pageNumber";
}

// Get Manga List
$manga = file_get_contents($endPoint);
$manga = json_decode($manga);

// List Genre
$genres = file_get_contents("$default_endpoint/genres");
$genres = json_decode($genres);
?>
<!doctype html>
<html lang="en" translate="no">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google" content="notranslate">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <title>Comic</title>
  
  <style>
    :root{
      font-size: 14px;
    }
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
      <div class="container">
        <a class="navbar-brand" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-half" viewBox="0 0 16 16">
            <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
          </svg>
          Comic
          </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?populer">Populer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?rekomendasi">Rekomendasi</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Genre
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php foreach ($genres->list_genre as $row): ?>
                <li><a class="dropdown-item" href="?genre=<?=$row->endpoint?>"><?=$row->genre_name?></a></li>
                <?php endforeach; ?>
              </ul>
            </li>
          </ul>
          <form action="" method="get" class="d-flex">
            <input id="search-input" name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </header>
  <section id="comic-list" class="container p-3">
    <div class="text-center">
      <?php if (isset($_GET["genre"])): ?>
        <h5 class="text-capitalize">Genre: <b><?=$_GET["genre"]?></b></h5>
      <?php elseif (isset($_GET["search"])): ?>
        <h5 class="text-capitalize">Hasil pencarian: <b><?=$_GET["search"]?></b></h5>
      <?php elseif (isset($_GET["search"])): ?>
        <h5>Rekomendasi</h5>
      <?php else: ?>
        <h5>Terbaru</h5>
      <?php endif; ?>
    </div>
    <div class="row">
        
        <?php foreach ($manga->manga_list as $row): ?>
        <div class="col-md-3 mb-3">
          <div class="card h-100 border-0 shadow rounded-3">
            <img src="<?=$row->thumb?>" class="card-img-top" loading="lazy" width="450" height="180">
            <div class="card-body">
              <a class="text-decoration-none" href="details.php?comic=<?=$row->endpoint?>" target="_blank">
                <h5 class="card-title"><?=$row->title?></h5>
              </a>
              <div class="mt-3">
                <span class="badge bg-secondary">Jenis: <?=$row->type?></span>
                <span class="badge bg-secondary">Chapter: <?=(isset($row->chapter)) ? substr($row->chapter, 8) : "?" ?></span>
              </div>
            </div>
            <div class="card-footer text-center">
              <small class="text-muted">Diperbarui <?=(isset($row->updated_on)) ? $row->updated_on : "?" ?> yang lalu</small>
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
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script>
    $("#search-input").on("keyup", function () {
      $.ajax({
        url: "search.php",
        type: "get",
        data: {
          search: $("#search-input").val()
        },
        success: function (data) {
          $("#comic-list").html(data);
        }
      });
    });
  </script>
</body>
</html>