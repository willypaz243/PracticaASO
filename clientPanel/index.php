<?php

session_start();

if (isset($_GET['exit']) && $_GET['exit'] == true) {
  session_unset();
  header("Location: /");
}

if (isset($_GET['username'])) {
  $_SESSION['username'] = $_GET['username'];
  header("Location: /");
}

if (!isset($_SESSION['username'])) {
  header("Location: /login.php");
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>
    <?php echo $username ?>
  </title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Admin panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-danger" href="/?exit=true">Salir</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main class="py-5">
    <section class="card container">
      <div class="card-header">
        <h2>Sitios web y dominios</h2>
      </div>
      <div class="card-body">
        <div class="ms-auto  py-5">
          <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newPageModal">Nuevo</button>
        </div>
        <div>

          <?php
          require 'conn.php';
          $query = $conn->query("SELECT * FROM `sites` ORDER BY `id` ASC");
          while ($row = $query->fetch_array()) {
          ?>
          <div class="card" style="width: 18rem;">
            <div class="card-header">
              <a href="<?php echo $row['domain'] ?>">
                <?php echo $row['domain'] ?>
              </a>
            </div>
            <div class="card-body">
              <h5 class="card-title">
                <?php echo $row['domain'] ?>
              </h5>
              <p><strong>Admin: </strong>
                <?php echo $row['username'] ?>
              </p>
              <p><strong>DB name: </strong>
                <?php echo $row['name_db'] ?>
              </p>
              <a href="<?php echo $row['domain'] ?>" class="card-link">view web</a>
              <a href="#" class="card-link">Config</a>
            </div>
          </div>
          <?php } ?>

        </div>
      </div>
    </section>

    <!-- modals -->
    <!-- create site modal -->
    <div class="modal fade" id="newPageModal" tabindex="-1" aria-labelledby="newPageModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newPageModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="website_form" action="cgi-bin/create_site">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" aria-describedby="username" name="username">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" aria-describedby="password" name="password">
              </div>
              <div class="mb-3">
                <label for="domain_name" class="form-label">Domain name</label>
                <input type="text" class="form-control" id="domain_name" aria-describedby="domain_name"
                  name="domain_name">
              </div>
              <div class="mb-3">
                <label for="database_name" class="form-label">Database name</label>
                <input type="text" class="form-control" id="database_name" aria-describedby="database_name"
                  name="database_name">
              </div>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" form="website_form">Create</button>
          </div>
        </div>
      </div>
    </div>

  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>

</html>