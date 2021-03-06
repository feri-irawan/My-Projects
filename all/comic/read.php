<?php
if (isset($_GET["chapter"])) {
  $endPoint = "https://mangamint.kaedenoki.net/api/";
  $chapter = $_GET["chapter"];
  $title = $_GET["title"];
  $chapterTitle = $_GET["chapter-title"];
  
  $comicData = file_get_contents("{$endPoint}chapter/{$chapter}");
  $comicData = json_decode($comicData);
  
  $comic = $comicData;
  //print_r($comic);
} else {
  $error = true;
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
  
  <section class="container p-0">
    
    <ul class="list-group list-group-flush mb-3">
      <li class="list-group-item">Judul Comic: <?=$title?></li>
      <li class="list-group-item">Chapter: <?=$chapterTitle?></li>
      <li class="list-group-item">Jumlah halaman: <?=$comic->chapter_pages?></li>
    </ul>
    

    <?php foreach ($comic->chapter_image as $comic): ?>
      <img loading="lazy" src="<?=$comic->chapter_image_link?>" class="d-block w-100" alt="Gambar ke <?=$comic->image_number?>">
    <?php endforeach; ?>

  </section>
 
<?php if ($error === true): ?>
<!-- Modal -->
<div class="modal fade" id="errorAlert" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Oops, ada yang error, sikahkan kembali ke halaman beranda!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="history.back()">Kembali</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?> 
  
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script>
  window.addEventListener("load", function() {
    showModal();
  }, false);
  
  function showModal() {
    var myModal = new bootstrap.Modal(document.getElementById("errorAlert"), {});
    myModal.show();
  }
  </script>
</body>
</html>
