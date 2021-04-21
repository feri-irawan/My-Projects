<?php

$default_endpoint = "https://mangamint.kaedenoki.net/api";
$pageNumber = (isset($_GET["page"])) ? $_GET["page"] : 1;

// Modified End Point
if (isset($_GET["genre"])) {
  // if there is a Genre
  $genresName = $_GET["genre"];
  $endPoint = "$default_endpoint/genres/$genresName/$pageNumber";
  
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

    <div class="text-center">
      <?php if (isset($_GET["genre"])): ?>
        <h5 class="text-capitalize">Genre: <b><?=$_GET["genre"]?></b></h5>
      <?php else: ?>
        <h5>Terbaru</h5>
      <?php endif; ?>
    </div>
    
    <div class="row">
      <?php foreach ($manga->manga_list as $row): ?>
      <div class="col-md-3 mb-3">
        <div class="card h-100 border-0 shadow rounded-3">
          <img src="<?=$row->thumb?>" class="card-img-top" loading="lazy">
          <div class="card-body">
            <a class="text-decoration-none" href="details.php?comic=<?=$row->endpoint?>" target="_blank">
              <h5 class="card-title"><?=$row->title?></h5>
            </a>
          </div>
          <ul class="list-group list-group-flush">
              <li class="list-group-item border-0">Jenis: <?=$row->type?></li>
              <li class="list-group-item border-0">Chapter: <?=(isset($row->chapter)) ? substr($row->chapter, 8) : "?" ?></li>
            </ul>
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