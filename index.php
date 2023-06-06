<?php
// Membaca data dari file movie.json dan mengubahnya menjadi array asosiatif dengan json_decode
$data = file_get_contents('data/movie.json');
$search = json_decode($data, true);

// Mengambil data "Search" dari array $search
$search = $search["Search"];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie Info</title>
    <!-- link ke Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body>
    <header>
    <!-- Bagian Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="img/logo.png" alt="Movie Info" width="150" height="50">
            </a>
            <!-- Tombol untuk toggle navbar -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Daftar item Navbar -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Link menuju Home -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <!-- Tombol filter movie -->
                    <li class="nav-item">
                        <button class="btn nav-link" id="search-movie" type="button">Movies</button>
                    </li>
                    <!-- Tombol filter series -->
                    <li class="nav-item">
                        <button class="btn nav-link" id="search-series" type="button">Series</button>
                    </li>
                    <!-- Form filter berdasarkan year -->
                    <li class="nav-item">
                        <form class="form-inline">
                            <div class="form-group d-flex align-items-center">
                                <label for="search-year" class="nav-link me-2">Year:</label>
                                <input type="number" id="search-year" class="form-control" min="1900" max="2025" step="1" value="" placeholder="year">
                            </div>
                        </form>
                    </li>
                </ul>
                <!-- Form untuk memasukkan keyword judul -->
                <form class="d-flex ms-auto my-2 my-lg-0">
                    <input class="form-control" id="search-input" type="text" placeholder="keyword or title" style="width: 100%;">
                    <button class="btn btn-dark" id="search-button" type="button">Search</button>
                </form>
            </div>
        </div>
      </nav>
      </header>
   
    
    <main class="container my-4"> 
      <section>
        <h2>Popular Movies</h2>
        <div class="row">
        <?php foreach ($search as $row) : ?>
          <div class="col-md-3">
            <div class="card mb-3 custom-card-size">
              <img src="<?= $row["Poster"] ?>" class="card-img-top" alt="..." width="" height="340">
              <div class="card-body">
                <h5 class="card-title"><?= $row["Title"] ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= $row["Year"] ?></h6>
                <div class="card-link">
                  <!-- Tautan untuk melihat detail film -->
                  <a href="#">See Details</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach ?>
        </div>
      </section>

      <section>
        <h2>Search Result</h2>
        <div class="row" id="movie-list">
        </div>
      </section>
    </main>

    <!-- link ke bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- link ke jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
    
  </body>
</html>