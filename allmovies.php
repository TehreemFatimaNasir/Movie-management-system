<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">

    <title>Home Page</title>
    <style>
      body {
    background-color: #000; /* Black background */
    color: #fff; /* White text for contrast */
    font-family: "Baskervville SC", system-ui;
    font-weight: 400;
    font-style: normal;
    margin: 0;
    padding: 0;
    line-height: 1.6;
  }
  
 .section-title{
  color: #fff;
  font-family: "Baskervville SC", system-ui;
    font-weight: 400;
    font-style: normal;
  
 }

    </style>
</head>
<body>

<?php include('connect.php')  ?>
<?php include('header.php')  ?>

<br><br>

<section id="team" class="team section-bg">
      <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
          <h3>Hollywood <span>Movies</span></h3>
        </div>

        <div class="row mt-5">
          <?php

                                $sql = "SELECT movies.*, categories.catname
                                from movies
                                inner join categories on categories.catid = movies.catid
                                where movies.catid = 1
                                order by movies.movieid DESC";
                                $res  = mysqli_query($con, $sql);
                                if(mysqli_num_rows($res) > 0){
                                  while($data = mysqli_fetch_array($res)){

                                ?>

                              <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                <div class="member">
                                  <div class="member-img">
                                    <img src="admin/uploads/<?= $data['image'] ?>"  style="height:250px !important; width:250px !important;" alt="">
                                    <div class="social">
                                      <a href="admin/uploads/<?= $data['trailer'] ?>" target="_blank"  class="btn btn-primary" style="width:150px;">Watch Trailer</a>
                                    
                                    </div>
                                  </div>
                                  <div class="member-info">
                                    <h4><?= $data['title'] ?></h4>
                                    <span><?= $data['catname'] ?></span>
                                  </div>
                                </div>
                    </div>

          <?php
            }
          }

          ?>

        </div>


        <div class="section-title">
          <h3>Bollywood <span>Movies</span></h3>
        </div>

        <div class="row mt-5">
          <?php

                                $sql = "SELECT movies.*, categories.catname
                                from movies
                                inner join categories on categories.catid = movies.catid
                                where movies.catid = 2
                                order by movies.movieid DESC";
                                $res  = mysqli_query($con, $sql);
                                if(mysqli_num_rows($res) > 0){
                                  while($data = mysqli_fetch_array($res)){

                                ?>

                              <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                <div class="member">
                                  <div class="member-img">
                                    <img src="admin/uploads/<?= $data['image'] ?>"  style="height:250px !important; width:250px !important;" alt="">
                                    <div class="social">
                                      <a href="admin/uploads/<?= $data['trailer'] ?>" target="_blank"  class="btn btn-primary" style="width:150px;">Watch Trailer</a>
                                    
                                    </div>
                                  </div>
                                  <div class="member-info">
                                    <h4><?= $data['title'] ?></h4>
                                    <span><?= $data['catname'] ?></span>
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

<?php include('footer.php')  ?>


</body>
</html>