<?php 
include('../connect.php');

if(!isset($_SESSION['uid'])){
  echo "<script> window.location.href='../login.php';  </script>";
}

// Delete Action
if(isset($_GET['deleteid'])){
    $deleteid = $_GET['deleteid'];
    $sql_delete = "DELETE FROM theater WHERE theaterid = '$deleteid'";
    if(mysqli_query($con, $sql_delete)){
        echo "<script>alert('Theater deleted successfully');</script>";
        echo "<script>window.location.href='theater.php';</script>";
    } else {
        echo "<script>alert('Failed to delete theater');</script>";
    }
}

// Edit Action
if(isset($_GET['editid'])){
    $editid = $_GET['editid'];
    $sql_edit = "SELECT * FROM theater WHERE theaterid = '$editid'";
    $res_edit = mysqli_query($con, $sql_edit);
    $data_edit = mysqli_fetch_array($res_edit);
    if($data_edit){
        // Pre-fill form fields with the current theater data
        $theater_name = $data_edit['theater_name'];
        $movieid = $data_edit['movieid'];
        $timing = $data_edit['timing'];
        $days = $data_edit['days'];
        $date = $data_edit['date'];
        $price = $data_edit['price'];
        $location = $data_edit['location'];
    } else {
        echo "<script>alert('Theater not found');</script>";
        echo "<script>window.location.href='theater.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theater Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #000 !important; /* Black background */
            font-family: "Baskervville SC", system-ui;
            color: #fff !important; /* White text for contrast */
        }
        h3, h4 {
            font-family: "Baskervville SC", system-ui;
            font-weight: bold;
        }
        .container {
            margin-top: 10px;
        }
        .form-container {
    border: 2px solid #fff; /* White border for the form container */
    padding: 20px;
    border-radius: 10px;
    background-color: #000; /* Keeping the black background */
    margin-left:-60px;
    width: 100%;
}

        .form-group {
            margin-bottom: 1rem;
            font-family: "Baskervville SC", system-ui;
            background-color: #000 !important; /* Black background */
            color: #fff !important; /* White text for contrast */
        }
        .form-control {
            border-radius: 8px;
    
        }
        .btn {
            border-radius: 5px;
            background-color: rgb(104, 17, 17) !important;
            border: none !important;
            color: #fff !important; 
        }
       
        .table {
            font-family: "Baskervville SC", system-ui;
            background-color: #000 !important; /* Black background */
            color: #fff !important; /* White text for contrast */
            border: 2px solid #fff;
            margin-left: -60px;
           
        }
        .table th, .table td {
            border: 1px solid #fff; /* White border for cells */
            font-family: "Baskervville SC", system-ui;
            background-color: #000 !important; /* Black background */
            color: #fff !important; /* White text for contrast */
        }
        .table thead {
            background-color: #444; /* Darker shade for the header */
            color: #fff; /* White text for the header */
        }
        .table tbody tr:nth-child(even) {
            background-color: #1a1a1a; /* Slightly lighter shade for even rows */
        }
        .table a {
            text-decoration: none;
            margin: auto;
        }
        .table a.btn {
            margin-top: 5px;
        }
        .card {
            border-radius: 8px;
            font-family: "Baskervville SC", system-ui;
            background-color: #000 !important; 
            color: #fff !important;
            border: 1px solid #fff !important; 
            margin-left: -50px;
            width: 90% !important; 
            margin-top:-17px;
        }
        footer {
            text-align: center;
            padding: 10px 0;
            font-family: "Baskervville SC", system-ui;
            background-color: #000 !important; 
            color: #fff !important;
            margin-top: 20px;
        }
      
    </style>
</head>
<body>

<?php include('header.php') ?>
<br><br><br><br>
<div class="container">
    <div class="row">
        <!-- Add Theater Form -->
        <div class="col-lg-6">
            <div class="form-container">
            <form action="theater.php" method="post" enctype="multipart/form-data">
    <h3 class="mb-4">Add Theater</h3>
    <div class="form-group mb-4">
        <input type="text" class="form-control" name="theater_name" placeholder="Enter Theater Name" value="<?php echo isset($theater_name) ? $theater_name : ''; ?>" required>
    </div>
    <div class="form-group mb-4">
        <select name="movieid" class="form-control" required>
            <option value="">Select Movie</option>
            <?php
            $sql = "SELECT * FROM movies";
            $res = mysqli_query($con, $sql);
            if(mysqli_num_rows($res) > 0){
                while($data = mysqli_fetch_array($res)){
                    $selected = ($data['movieid'] == $movieid) ? "selected" : "";
                    echo "<option value='{$data['movieid']}' {$selected}>{$data['title']}</option>";
                }
            } else {
                echo "<option value=''>No Movies Found</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group mb-4">
        <input type="time" class="form-control" name="timing" value="<?php echo isset($timing) ? $timing : ''; ?>" required>
    </div>
    <div class="form-group mb-4">
        <input type="text" class="form-control" name="days" placeholder="Enter Days (e.g., Mon-Fri)" value="<?php echo isset($days) ? $days : ''; ?>" required>
    </div>
    <div class="form-group mb-4">
        <input type="date" class="form-control" name="date" value="<?php echo isset($date) ? $date : ''; ?>" required>
    </div>
    <div class="form-group mb-4">
        <input type="number" class="form-control" name="price" placeholder="Enter Ticket Price" value="<?php echo isset($price) ? $price : ''; ?>" required>
    </div>
    <div class="form-group mb-4">
        <input type="text" class="form-control" name="location" placeholder="Enter Location" value="<?php echo isset($location) ? $location : ''; ?>" required>
    </div>
    <div class="form-group">
        <input type="submit" class="btn w-100" value="<?php echo isset($theater_name) ? 'Update Theater' : 'Add Theater'; ?>" name="add">
    </div>
</form>

            </div>
        </div>

        <!-- Theater Table -->
        <div class="col-lg-6">
            <h3 class="mb-4">Theater List</h3>
            <table class="table table-bordered table-hover shadow bg-white rounded">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Theater</th>
                        <th>Movie</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Days/Time</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT theater.*, movies.title, categories.catname
                        FROM theater
                        INNER JOIN movies ON movies.movieid = theater.movieid
                        INNER JOIN categories ON categories.catid = movies.catid";
                $res = mysqli_query($con, $sql);
                if(mysqli_num_rows($res) > 0){
                    while($data = mysqli_fetch_array($res)){
                        echo "
                            <tr>
                                <td>{$data['theaterid']}</td>
                                <td>{$data['theater_name']}</td>
                                <td>{$data['title']}</td>
                                <td>{$data['catname']}</td>
                                <td>{$data['date']}</td>
                                <td>{$data['days']} - {$data['timing']}</td>
                                <td>{$data['price']}</td>
                                <td>{$data['location']}</td>
                                <td>
                                    <a href='theater.php?editid={$data['theaterid']}' class='btn btn-primary btn-sm'>Edit</a>
                                    <a href='theater.php?deleteid={$data['theaterid']}' class='btn btn-danger btn-sm'>Delete</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>No Theaters Found</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2025 Theater Management System. All Rights Reserved.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if(isset($_POST['add'])){
    $movieid = $_POST['movieid'];
    $theater_name = $_POST['theater_name'];
    $days = $_POST['days'];
    $timing = $_POST['timing'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $location = $_POST['location'];

    // If editing, update the record
    if(isset($_GET['editid'])){
        $editid = $_GET['editid'];
        $sql = "UPDATE theater SET 
                theater_name = '$theater_name',
                timing = '$timing',
                days = '$days',
                date = '$date',
                price = '$price',
                location = '$location',
                movieid = '$movieid' 
                WHERE theaterid = '$editid'";
    } else {
        // Otherwise, insert a new record
        $sql = "INSERT INTO theater(theater_name, timing, days, date, price, location, movieid) 
                VALUES ('$theater_name','$timing','$days','$date','$price','$location','$movieid')";
    }

    if(mysqli_query($con, $sql)){
        echo "<script>alert('Theater " . (isset($_GET['editid']) ? 'updated' : 'added') . " successfully');</script>";
        echo "<script>window.location.href='theater.php';</script>";
    } else {
        echo "<script>alert('Failed to " . (isset($_GET['editid']) ? 'update' : 'add') . " theater');</script>";
    }
}
?>

