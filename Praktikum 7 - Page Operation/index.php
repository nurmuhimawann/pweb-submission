<?php
include 'connection.php';
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Nyoba Material -->
  <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css">
  <title>Hallo, ini page-operation</title>
</head>
<body>
  <div class="container py-5">
    <div class="row mb-3">
      <div class="col-lg-3">
        <h3 class="text-white">Popular Movies</h3>
      </div>
      <div class="col-lg-9">
        <a href="#" class="btn btn-primary float-end"><i class="fa-solid fa-plus-circle"></i> Create</a>
      </div>
    </div>

    <div class="row g-5">
      <div class="col-lg-3">
        <form>
          <div class="card">
            <div class="card-header">
              <h4>Sorting</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="sort">Sort Results By</label>
                <select class="form-select" id="sort" name="sort">
                  <option value="title ASC" selected>Title Ascending</option>
                  <option value="title DESC">Title Descending</option>
                </select>
              </div>
            </div>
          </div>

          <div class="card mt-3">
            <div class="card-header">
              <h4>Filters</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
              </div>
              <div class="form-group mt-3">
                <label for="rating">Rating</label>
                <select class="form-select" id="rating" name="rating">
                  <option value="G" selected>G</option>
                  <option value="PG">PG</option>
                  <option value="PG-13">PG-13</option>
                  <option value="R">R</option>
                  <option value="NC-17">NC-17</option>
                </select>
              </div>
            </div>
          </div>

          <div class="d-grid gap-2">
            <button type="button" class="btn btn-primary mt-3" id="search"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
          </div>
        </form>
      </div>

      <div class="col-lg-9">
        <div class="row row-cols-1 row-cols-lg-3 row-cols-xl-3 gy-4" id="film">
          <?php
          $sql = "SELECT * FROM film";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<div class="col-lg-3 mb-3">';
              echo '<div class="card card-content">';
              echo '<img src="img/art.png" class="card-img-top" alt="' . $row['title'] . '">';
              echo '<div class="card-body">';
              echo '<h5 class="card-title">' . $row['title'] . '</h5>';
              echo '<div class="card-text">';
              echo '<div class="row">';
              echo '<div class="col-lg-6">';
              echo '<span>Rating: ' . $row['rating'] . '</span>';
              echo '</div>';
              echo '<div class="col-lg-6">';
              echo '<button type="button" class="btn btn-sm btn-primary float-end ms-1"><i class="fa-solid fa-pen-to-square"></i></button>';
              echo '<button type="button" class="btn btn-sm btn-danger float-end"><i class="fa-solid fa-trash-can"></i></button>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
          } else {
            echo "No results";
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    $(document).ready(function() {
      $(document).on('click', '#search', function() {
        var sort = $('#sort').val();
        var title = $('#title').val();
        var rating = $('#rating').val();

        $.ajax({
          url: 'search.php',
          type: 'POST',
          data: {
            sort: sort,
            title: title,
            rating: rating
          },
          success: function(response) {
            $('#film').html(response);
          }
        });
      });
    });
  </script>
</body>
</html>