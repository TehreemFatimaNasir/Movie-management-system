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
    <title>Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Baskervville SC", system-ui;
        background-color: #000 !important; /* Black background */
        color: #fff !important;
        }
        .container {
            margin-top: 10px;
        }
        .table {
            background-color: #000 !important; /* Black background */
        color: #fff !important;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: "Baskervville SC", system-ui;
        }
        .table th {
            font-family: "Baskervville SC", system-ui;
            background-color: #000 !important; /* Black background */
            color: #fff !important;
            font-weight: bold;
        }
        .table td, .table th {
            font-family: "Baskervville SC", system-ui;
            font-size: 1.2rem;
            vertical-align: middle;
            background-color: #000 !important; /* Black background */
            color: #fff !important;
        }
        .form-control, .btn {
            border-radius: 5px;
        }
        .btn-success, .btn-primary, .btn-warning, .btn-light {
            padding: 8px 16px;
            font-size: 14px;
        }
        .btn-warning {
            background-color:rgb(158, 122, 15) !important;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-primary {
            background-color: rgb(73, 19, 19) !important;
            color: white;
            border: none !important;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-success {
            background-color: rgb(104, 17, 17) !important;
            color: white;
            transition: all 0.3s ease;
            border: none !important;
            font-family: "Baskervville SC", system-ui;
        }
        .btn-success:hover {
            background-color:rgb(180, 99, 99) !important;
        }
        .btn-light {
            background-color: #f8f9fa;
            color: black;
        }
        .alert {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
        }
        h3{
            font-family: "Baskervville SC", system-ui;
            font-weight: bold;
            color: #fff !important;
        }
    </style>
</head>
<?php include('header.php'); ?>
<br><br>
<br><br>
<body>

<div class="container">
    <h3 class="mb-4">Booking Management</h3>

    <?php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 'approved') {
                echo "<div class='alert alert-success'>Booking approved successfully!</div>";
            }
        }
    ?>

    <!-- Search Form -->
    <form action="viewallbooking.php" method="post">
        <div class="row mb-4">
            <div class="col-lg-3">
                <input type="date" name="start" class="form-control">
            </div>
            <div class="col-lg-3">
                <input type="date" name="end" class="form-control">
            </div>
            <div class="col-lg-3">
                <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="0">Pending</option>
                    <option value="1">Approved</option>
                </select>
            </div>
            <div class="col-lg-3">
                <input type="submit" name="btnsearch" value="Search" class="btn btn-success w-100">
            </div>
        </div>
    </form>

    <!-- Booking Table -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Days/Time</th>
                        <th>Ticket</th>
                        <th>Location</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['btnsearch'])) {
                        $start  = $_POST['start'];
                        $end    = $_POST['end'];
                        $status = $_POST['status'];

                        $total_sale = 0;

                        $sql = "SELECT booking.bookingid, booking.bookingdate, booking.person, theater.theater_name, theater.timing, theater.days, theater.price, theater.location, movies.title, categories.catname, users.name as 'username', booking.status
                                FROM booking
                                INNER JOIN theater ON theater.theaterid = booking.theaterid
                                INNER JOIN users ON users.userid = booking.userid
                                INNER JOIN movies ON movies.movieid = theater.movieid
                                INNER JOIN categories ON categories.catid = movies.catid
                                WHERE booking.bookingdate BETWEEN '$start' AND '$end' AND booking.status = '$status'";
                        $res  = mysqli_query($con, $sql);
                        if(mysqli_num_rows($res) > 0){
                            while($data = mysqli_fetch_array($res)){
                                $total_sale += $data['price'];
                    ?>
                                <tr>
                                    <td><?= $data['bookingid'] ?></td>
                                    <td><?= $data['theater_name'] ?></td>
                                    <td><?= $data['title'] ?> - <?= $data['catname'] ?></td>
                                    <td><?= $data['bookingdate'] ?></td>
                                    <td><?= $data['days'] ?> - <?= $data['timing'] ?></td>
                                    <td><?= $data['price'] ?></td>
                                    <td><?= $data['location'] ?></td>
                                    <td><?= $data['username'] ?></td>
                                    <td>
                                        <?= $data['status'] == 0 ? "<span class='badge bg-warning'>Pending</span>" : "<span class='badge bg-success'>Approved</span>" ?>
                                    </td>
                                    <td>
                                        <?= $data['status'] == 1 ? "<button class='btn btn-light' disabled>Completed</button>" : "<a href='viewallbooking.php?bookingid=".$data['bookingid']."' class='btn btn-primary'>Approve</a>" ?>
                                    </td>
                                </tr>
                    <?php
                            }
                            echo "<tr><td colspan='9' class='text-end'><strong>Total Sales: Rs." . $total_sale . "</strong></td></tr>";
                        }
                    } else {
                        $sql = "SELECT booking.bookingid, booking.bookingdate, booking.person, theater.theater_name, theater.timing, theater.days, theater.price, theater.location, movies.title, categories.catname, users.name as 'username', booking.status
                                FROM booking
                                INNER JOIN theater ON theater.theaterid = booking.theaterid
                                INNER JOIN users ON users.userid = booking.userid
                                INNER JOIN movies ON movies.movieid = theater.movieid
                                INNER JOIN categories ON categories.catid = movies.catid";
                        $res  = mysqli_query($con, $sql);
                        if(mysqli_num_rows($res) > 0){
                            while($data = mysqli_fetch_array($res)){
                    ?>
                                <tr>
                                    <td><?= $data['bookingid'] ?></td>
                                    <td><?= $data['theater_name'] ?></td>
                                    <td><?= $data['title'] ?> - <?= $data['catname'] ?></td>
                                    <td><?= $data['bookingdate'] ?></td>
                                    <td><?= $data['days'] ?> - <?= $data['timing'] ?></td>
                                    <td><?= $data['price'] ?></td>
                                    <td><?= $data['location'] ?></td>
                                    <td><?= $data['username'] ?></td>
                                    <td>
                                        <?= $data['status'] == 0 ? "<span class='badge bg-warning'>Pending</span>" : "<span class='badge bg-success'>Approved</span>" ?>
                                    </td>
                                    <td>
                                        <?= $data['status'] == 1 ? "<button class='btn btn-light' disabled>Completed</button>" : "<a href='viewallbooking.php?bookingid=".$data['bookingid']."' class='btn btn-primary'>Approve</a>" ?>
                                    </td>
                                </tr>
                    <?php
                            }
                        } else {
                            echo "<tr><td colspan='10' class='text-center'>No booking found</td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (isset($_GET['bookingid'])) {
    $bookingid = $_GET['bookingid'];
    $sql = "UPDATE `booking` SET `status`= 1 WHERE bookingid = '$bookingid'";

    if(mysqli_query($con, $sql)){
        echo "<script> alert('Booking approved successfully!'); </script>";
        echo "<script> window.location.href='viewallbooking.php?status=approved'; </script>";
    } else {
        echo "<script> alert('Approval failed!'); </script>";
    }
}
?>
