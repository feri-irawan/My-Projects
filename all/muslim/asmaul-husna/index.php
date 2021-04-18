<?php
$endpoint = "https://islamic-api-zhirrr.vercel.app/api/asmaulhusna";
$data = file_get_contents($endpoint);
$data = json_decode($data);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="res/css/style.css">
    
    <title>Asmaul Husna</title>
  </head>
  <body>
    
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Asmaul Husna</a>
      </div>
    </nav>
  
    <section class="container">
      <div class="row">
        <?php foreach ($data->data as $row): ?>
        <div class="col-md-6">
          <div class="card border-light shadow-sm mb-3">
            <div class="card-header border-light">
              No. <?=$row->index?>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <h5><?=$row->latin?></h5><br>
                </div>
                
                <div class="col-6 text-end">
                  <h3 class="text-arab"><?=$row->arabic?></h3>
                </div>
                
                <div class="col-12">
                  <i><?=$row->translation_id?></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        
      </div>
    </section>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>