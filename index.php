<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">
  
    <!-- Correct link to your stylesheets -->
<link rel="stylesheet" href="style.css">


</head>
<body>
    
<?php include('connect.php'); ?>
<?php include('header.php'); ?>

<br><br>


<div id="movieCarousel" class="carousel slide" data-bs-ride="carousel">
    <!-- Indicators -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#movieCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#movieCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#movieCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
<br>
    <!-- Slides -->
    <div class="carousel-inner">
    <div class="carousel-item active">
    <img src="assets/img/banner1.png" class="d-block w-100" alt="Movie 1">
    </div>
    <div class="carousel-item">
        <img src="assets/img/banner2.png" class="d-block w-100" alt="Movie 2">
    </div>
    <div class="carousel-item">
        <img src="assets/img/banner4.jpg" class="d-block w-100" alt="Movie 3">
    </div>
</div>


    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#movieCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#movieCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>




<section id="team" class="team section-bg">
    <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
            <h2>Latest Movies</h2>
            <h3>Our <span>Movies</span></h3>
        </div>

        <form action="index.php" method="post">
            <div class="row">
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="form-group">
                        <input type="text" class="form-control" name="movie_search" placeholder="Search Movie Name">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="form-group">
                        <select name="catid" class="form-control">
                            <option value="">Select Category</option>
                            <?php
                            $sql = "SELECT * FROM `categories`";
                            $res = mysqli_query($con, $sql);
                            if (mysqli_num_rows($res) > 0) {
                                while ($data = mysqli_fetch_array($res)) {
                                    echo "<option value='{$data['catid']}'>{$data['catname']}</option>";
                                }
                            } else {
                                echo "<option value=''>No Category found</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-1 col-md-6 d-flex">
                    <div class="form-group">
                        <input type="submit" name="btnSearch" value="Search" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </form>

        <div class="row mt-5">
            <?php
            if (isset($_POST['btnSearch'])) {
                $movie_search = $_POST['movie_search'];
                $catid = $_POST['catid'];

                $sql = "SELECT movies.*, categories.catname
                        FROM movies
                        INNER JOIN categories ON categories.catid = movies.catid
                        WHERE movies.title LIKE '%$movie_search%' AND movies.catid = '$catid'";
            } else {
                $sql = "SELECT movies.*, categories.catname
                        FROM movies
                        INNER JOIN categories ON categories.catid = movies.catid
                        ORDER BY movies.movieid DESC";
            }

            $res = mysqli_query($con, $sql);
            if (mysqli_num_rows($res) > 0) {
                while ($data = mysqli_fetch_array($res)) {
            ?>
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="movie-card">
                    <div class="movie-card-img">
                        <img src="admin/uploads/<?= $data['image'] ?>" alt="<?= $data['title'] ?>" class="img-fluid">
                        <div class="overlay">
                            <a href="admin/uploads/<?= $data['trailer'] ?>" target="_blank" class="btn btn-primary">Watch Trailer</a>
                        </div>
                    </div>
                    <div class="movie-card-info">
                        <h4><?= $data['title'] ?></h4>
                        <span><?= $data['catname'] ?></span>
                        <div class="rating">
                            <?php
                            $rating = !empty($data['rating']) ? $data['rating'] : 0;
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $rating) {
                                    echo '<i class="fa fa-star" style="color: gold;"></i>';
                                } elseif ($i - $rating < 1) {
                                    echo '<i class="fa fa-star-half-o" style="color: gold;"></i>';
                                } else {
                                    echo '<i class="fa fa-star-o" style="color: gold;"></i>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo "<p>No movies found.</p>";
            }
            ?>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
</body>
</html>
