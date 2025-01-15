<?php 
include('connect.php');

if(!isset($_SESSION['uid'])){
  echo "<script> window.location.href='login.php';  </script>";
}

?>
<?php include('header.php')  ?>

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
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">

    <title>User Booking</title>
    <style>

       .table {
            font-family: "Baskervville SC", system-ui;
            background-color: #000 !important; /* Black background */
            color: #fff !important; /* White text for contrast */
            border: 2px solid #fff;
            font-size: 1.1rem;
           
        }
        .table th, .table td {
            border: 1px solid #fff; /* White border for cells */
            font-family: "Baskervville SC", system-ui;
            background-color: #000 !important; /* Black background */
            color: #fff !important; /* White text for contrast */
        }
      footer {
            position: absolute;
            bottom: 0;
            width: 99%;
            text-align: center;
            padding: 10px;
      }
    </style>
</head>
<body>
<br><br>
<br><br>
<br>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <table class="table">
        <tr>
          <th>#</th>
          <th>Name</th> <!-- Changed "Category" to "Name" -->
          <th>Date</th>
          <th>Days/Time</th>
          <th>Ticket</th>
          <th>Location</th>
          <th>User</th>
          <th>Status</th>
        </tr>
        
        <?php
        $uid = $_SESSION['uid'];

        $sql = "SELECT booking.bookingid, booking.bookingdate, booking.person, theater.theater_name, theater.timing, theater.days, theater.price, theater.location, movies.title, categories.catname, users.name AS 'username', booking.status
                FROM booking
                INNER JOIN theater ON theater.theaterid = booking.theaterid
                INNER JOIN users ON users.userid = booking.userid
                INNER JOIN movies ON movies.movieid = theater.movieid
                INNER JOIN categories ON categories.catid = movies.catid 
                WHERE booking.userid = '$uid'";
        $res = mysqli_query($con, $sql);
        if(mysqli_num_rows($res) > 0){
          while($data = mysqli_fetch_array($res)){
        ?>
          <tr>
            <td><?= $data['bookingid'] ?></td>
            <td><?= $data['title'] ?> - <?= $data['catname'] ?></td> <!-- Changed category to movie title and category -->
            <td><?= $data['bookingdate'] ?></td>
            <td><?= $data['days'] ?> - <?= $data['timing'] ?></td>       
            <td><?= $data['price'] ?></td>
            <td><?= $data['location'] ?></td>
            <td><?= $data['username'] ?></td>
            <td>
              <?php
              if($data['status'] == 0){
                echo "<a href='#' class='btn btn-warning' > Pending </a>";
              } else {
                echo "<a href='#' class='btn btn-success' > Approved </a>";
              }
              ?>
            </td>
          </tr>
        <?php
          }
        } else {
          echo '<tr><td colspan="8" class="text-center">No bookings found</td></tr>';
        }
        ?>
      </table>
    </div>
  </div>
</div>

<footer><?php include('footer.php')  ?></footer>

</body>
</html>
