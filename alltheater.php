<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        .section-title {
            color: #fff;
            font-family: "Baskervville SC", system-ui;
            margin-top: 60px;
            text-align: center;
        }

        .movie-card {
            position: relative;
            background: #1a1a1a;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            max-width: 350px;
            margin: auto;
        }

        .movie-card:hover {
            transform: translateY(-10px);
        }

        .movie-card-img {
            position: relative;
        }

        .movie-card-img img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .social {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
        }

        .movie-card-img:hover .social {
            display: block;
        }

        .movie-card-info {
            padding: 15px;
            color: #fff;
            font-size: 17px;
            font-family: "DM Serif Text", serif;
        }

        .movie-card-info h4 {
            margin-bottom: 10px;
            color: #fff;
            font-size: 19px;
        }

        .movie-card-info span {
            color: #ddd;
            display: block;
            margin-bottom: 5px;
        }

        .info-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .info-line span {
            font-size: 14px;
            color: #ddd;
            text-align: center;
        }

        .btn-primary {
            background-color: rgb(104, 17, 17) !important;
            border-color: rgb(117, 8, 8) !important;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            text-align: center;
        }

        .btn-primary:hover {
            background-color: rgb(145, 99, 99) !important;
            border-color: rgb(90, 16, 16) !important;
        }
    </style>
</head>
<body>

<?php include('connect.php') ?>
<?php include('header.php') ?>

<section id="team" class="team section-bg">
    <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
            <h3>Our <span>Theater</span></h3>
        </div>

        <div class="row mt-5">
            <?php
                $sql = "SELECT theater.*, movies.*, categories.catname
                        FROM theater
                        INNER JOIN movies ON movies.movieid = theater.movieid
                        INNER JOIN categories ON categories.catid = movies.catid
                        ORDER BY theater.theaterid DESC";
                $res  = mysqli_query($con, $sql);
                if (mysqli_num_rows($res) > 0) {
                    while ($data = mysqli_fetch_array($res)) {
            ?>
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="movie-card">
                    <div class="movie-card-img">
                        <img src="admin/uploads/<?= $data['image'] ?>" alt="">
                        <div class="social">
                            <a href="admin/uploads/<?= $data['trailer'] ?>" target="_blank" class="btn-primary">Watch Trailer</a>
                        </div>
                    </div>
                    <div class="movie-card-info">
                    <h4><?= $data['title'] ?></h4>
    <span class="text-muted" style="font-size: 14px;">
        <?= $data['catname'] ?> - <?= $data['theater_name'] ?>
    </span>
                                <div class="rating">
                                    <?php
                                    $rating = !empty($data['rating']) ? $data['rating'] : 0;
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<i class="fa fa-star"></i>';
                                        } elseif ($i - $rating < 1) {
                                            echo '<i class="fa fa-star-half-o"></i>';
                                        } else {
                                            echo '<i class="fa fa-star-o"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="info-line">
                                    <span> <?= $data['timing'] ?> </span>
                                    <span> <?= $data['days'] ?></span>
                                </div>
                                <div class="info-line">
                                    <span> <?= $data['date'] ?> </span>
                                    <span> <?= $data['location'] ?></span>
                                </div>
                                <h4>Per Ticket: Rs.<?= $data['price'] ?></h4>
                                <a href="booking.php?id=<?=$data['theaterid']?>" target="_blank" class="btn btn-primary"> Book Now </a>
                            </div>
                        </div>
                    </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</section>

<?php include('footer.php') ?>

</body>
</html>
