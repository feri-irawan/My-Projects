<?php
if (isset($_GET["search"])) {
  $default_endpoint = "https://mangamint.kaedenoki.net/api";
  $pageNumber = (isset($_GET["page"])) ? $_GET["page"] : 1;
  $keyword = $_GET["search"];
  
  // Default in homepage
  $endPoint = "$default_endpoint/search/$keyword";
  
  // Get Manga List
  $manga = file_get_contents($endPoint);
  $manga = json_decode($manga);
}
?>

    <div class="text-center">
      <?php if (isset($_GET["search"])): ?>
        <h5 class="text-capitalize">Hasil pencarian: <b><?=$_GET["search"]?></b></h5>
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
            <span class="badge bg-secondary">Jenis: <?=$row->type?></span>
            <span class="badge bg-secondary">Chapter: <?=(isset($row->chapter)) ? substr($row->chapter, 8) : "?" ?></span>
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