<?php
/**
 * =======================
 * Hi, welcome to my all projects repository
 * =======================
 */
 
//Default
echo file_get_contents("projects.json");
?>


<?php if (isset($_GET["add-project"])): ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Add Project List</title>
  </head>
  <body>
    
    <section class="container p-3">
      <?php if (isset($_GET["success-add"])): ?>
        <div class="alert alert-success">
          Has successfully added a new project to the list!
        </div>
      <?php endif; ?>
      
      <form action="" method="post">
        <div class="input-group mb-3">
          <span class="input-group-text">Name</span>
          <input name="input-name" type="text" class="form-control" required>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text">URL</span>
          <input name="input-url" type="text" class="form-control" required>
        </div>
        <button name="btn-submit" type="submit" class="btn btn-secondary">Save</button>
      </form>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>

  <?php
  if (isset($_POST["btn-submit"])) {
    $name = $_POST["input-name"];
    $url = $_POST["input-url"];
    
    $json_url = "projects.json";
    $data = file_get_contents($json_url);
    $data = json_decode($data, true);
    
    $query = [
      "name" => $name,
      "url" => $url
      ];
    
    $data[] = $query;
    
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($json_url, $data);
   
    header("Location: index.php?add-project&success-add");
    exit();
  }
  ?>

<?php endif; ?>