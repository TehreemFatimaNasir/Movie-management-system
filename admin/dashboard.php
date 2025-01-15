<?php 
include('../connect.php');

if(!isset($_SESSION['uid'])){
  echo "<script> window.location.href='../login.php';  </script>";
}

?>

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
   
    <title>Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: "Baskervville SC", system-ui;
        background-color: #000 !important; /* Black background */
        color: #fff !important; /* White text for contrast */
    }
  
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
        font-family: "Baskervville SC", system-ui;
        /* background: #1a1a1a !important; */
        background-color: rgb(70, 11, 11) !important;
        color: #fff !important; 
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card h5 {
        font-family: "Baskervville SC", system-ui;
        font-size: 1.2rem;
        font-weight: bold;
    }
    .card h6 {
        font-family: "Baskervville SC", system-ui;
        font-size: 1.5rem;
        color:rgb(243, 243, 243); /* Light blue text for numbers */
        font-weight: bold;
    }
    h3 {
        font-family: "Baskervville SC", system-ui;
        font-weight: bold;
        color: #fff; /* White text for the heading */
    }
    .container {
        margin-top: 10px;
    }
    a.text-decoration-none {
        color: #fff; /* White links */
    }
    a.text-decoration-none:hover {
        color:rgb(243, 243, 243); /* Light blue on hover */
    }
</style>

</head>
<body>

<?php include('header.php'); ?>
<br><br><br><br>
<div class="container text-center">
    <h3 class="mb-4">Welcome to Admin Dashboard!!</h3>
    <div class="row g-4">
        <!-- Categories Card -->
        <div class="col-lg-4 col-md-6">
            <a href="categories.php" class="text-decoration-none text-dark">
                <div class="card p-3">
                    <div class="card-body">
                        <h5>CATEGORIES</h5>
                        <?php
                            $sql = "SELECT count(catid) as 'category' FROM `categories`";
                            $res  = mysqli_query($con, $sql);
                            $catdata = mysqli_fetch_array($res);
                        ?>
                        <h6><?=$catdata['category']?></h6>
                    </div>
                </div>
            </a>
        </div>
        <!-- Movies Card -->
        <div class="col-lg-4 col-md-6">
            <a href="movies_list.php" class="text-decoration-none text-dark">
                <div class="card p-3">
                    <div class="card-body">
                        <h5>MOVIES</h5>
                        <?php
                            $sql = "SELECT count(movieid) as 'total_movies' FROM `movies`";
                            $res  = mysqli_query($con, $sql);
                            $moviedata = mysqli_fetch_array($res);
                        ?>
                        <h6><?=$moviedata['total_movies']?></h6>
                    </div>
                </div>
            </a>
        </div>
        <!-- Theater Card -->
        <div class="col-lg-4 col-md-6">
            <a href="theater.php" class="text-decoration-none text-dark">
                <div class="card p-3">
                    <div class="card-body">
                        <h5>THEATER</h5>
                        <?php
                            $sql = "SELECT count(theaterid) as 'total_theater' FROM `theater`";
                            $res  = mysqli_query($con, $sql);
                            $theaterdata = mysqli_fetch_array($res);
                        ?>
                        <h6><?=$theaterdata['total_theater']?></h6>
                    </div>
                </div>
            </a>
        </div>
        <!-- Booking Card -->
        <div class="col-lg-4 col-md-6">
            <a href="viewallbooking.php" class="text-decoration-none text-dark">
                <div class="card p-3">
                    <div class="card-body">
                        <h5>BOOKING</h5>
                        <?php
                            $sql = "SELECT count(bookingid) as 'total_booking' FROM `booking` WHERE status = 1";
                            $res  = mysqli_query($con, $sql);
                            $bookingdata = mysqli_fetch_array($res);
                        ?>
                        <h6><?=$bookingdata['total_booking']?></h6>
                    </div>
                </div>
            </a>
        </div>
        <!-- Users Card -->
        <div class="col-lg-4 col-md-6">
            <a href="viewallusers.php" class="text-decoration-none text-dark">
                <div class="card p-3">
                    <div class="card-body">
                        <h5>USERS</h5>
                        <?php
                            $sql = "SELECT count(userid) as 'total_users' FROM `users` WHERE roteype = 2";
                            $res  = mysqli_query($con, $sql);
                            $userdata = mysqli_fetch_array($res);
                        ?>
                        <h6><?=$userdata['total_users']?></h6>
                    </div>
                </div>
            </a>
        </div>
        <!-- Sales Card -->
        <div class="col-lg-4 col-md-6">
            <a href="sales_report.php" class="text-decoration-none text-dark">
                <div class="card p-3">
                    <div class="card-body">
                        <h5>SALES</h5>
                        <?php
                            $sql = "SELECT SUM(theater.price) as 'total_sale', booking.status 
                                    FROM booking
                                    INNER JOIN theater ON theater.theaterid = booking.theaterid
                                    WHERE booking.status = 1";
                            $res  = mysqli_query($con, $sql);
                            $salesdata = mysqli_fetch_array($res);
                        ?>
                        <h6><?=$salesdata['total_sale']?></h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
