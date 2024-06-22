<?php
  include_once('./DatabaseConfig/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Create Competition - Thai Football Tournament</title>

  <script type="module" crossorigin src="./assets/compiled/js/bootstrap.esm.js"></script>
  <link rel="stylesheet" href="./assets/compiled/css/bootstrap.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="index.php">Thai Football competition</a>
    </div>
  </nav>

  <main class="container py-5">
    <header class="mb-4 d-flex align-items-center justify-content-between">
      <h3 class="mb-0">Create a competition</h3>
    </header>
      <?php
        if(isset($_SESSION['alert'])){
      ?>
      <div class="alert <?=$_SESSION['alert']['css']?>"><?=$_SESSION['alert']['msg']?></div>
      <?php
        unset($_SESSION['alert']);
        }
      ?>

    <section class="form">
      <div class="row">
        <div class="col-md-4">
          <form action="./Controllers/addCompetitions.php" method="POST" enctype="multipart/form-data">
            <div class="col-12">
              <div class="mb-3">
                <label for="name">Competition Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?=$_SESSION['post']['name']??''?>" required />
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <label for="slug">Slug</label>
                  <input type="text" class="form-control" id="slug" name="slug" value="<?=$_SESSION['post']['slug']??''?>" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <label for="max_teams">Max Teams</label>
                  <input type="number" class="form-control" id="max_teams" name="max_teams" value="<?=$_SESSION['post']['max_teams']??''?>" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <label for="allowed_Provinces">Allowed Provinces</label>
                  <select multiple name="allowed_Provinces[]" id="allowed_Provinces" class="form-control">
                    <?php
                      $sql = "SELECT * FROM provinces";
                      $results = $conn->query($sql);
                      while($row = mysqli_fetch_array($results)){
                        if(in_array($row['id'] , $_SESSION['post']['allowed_Provinces']??[])){
                          $selected = 'selected';
                        }else{
                          $selected = '';
                        }
                    ?>
                    <option value="<?=$row['id']?>"<?=$selected?>><?=$row['name']?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <label for="banner">Banner</label>
                  <input type="file" class="form-control" id="banner" name="banner" value="" />
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-8">
                <button class="btn btn-primary w-100" type="submit">
                  Save
                </button>
              </div>
              <div class="col-4">
                <a href="index.php" class="btn bg-light text-primary w-100" type="submit">Back</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </main>
</body>

</html>