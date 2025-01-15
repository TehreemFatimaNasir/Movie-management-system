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
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">
   
  <style>
        body{
        font-family: "Baskervville SC", system-ui;
        background-color: #000 !important; 
        color: #fff !important; /* White text for contrast */
        }
        .container {
            margin-top: 10px;
        }
        h3{
            font-family: "Baskervville SC", system-ui;
            font-weight: bold;
        }
        .table {
            font-family: "Baskervville SC", system-ui;
            background-color: #000 !important; 
            color: #fff !important;
            border: 2px solid white; /* White border */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table th {
            font-family: "Baskervville SC", system-ui;
            background-color: #000 !important; 
            color: #fff !important;
            font-weight: bold;
        }
        .table td, .table th {
            font-family: "Baskervville SC", system-ui;
            font-size: 1.2rem;
            background-color: #000 !important; 
            color: #fff !important;
            vertical-align: middle;
            border: 1px solid white; /* White borders for table cells */
        }
        .btn {
            border-radius: 5px;
            padding: 6px 12px;
        }
        .btn-danger {
            background-color: rgb(104, 17, 17) !important;
            border: none !important;
            color: white;
            transition: all 0.3s ease;
            font-family: "Baskervville SC", system-ui;
            font-size: 1.2rem;
        }
        .btn-danger:hover {
            background-color:rgb(165, 91, 98) !important;
            color: white;
        }
        .alert {
            padding: 10px;
            margin-top: 20px;
        }
        footer{
            margin-top: 200px !important;
        }
    </style>
</head>
<?php include('header.php'); ?>
<br><br>
<br><br>
<body>



<div class="container">
    <h3 class="mb-4">User Management</h3>
    <?php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 'deleted') {
                echo "<div class='alert alert-success'>User deleted successfully.</div>";
            }
        }
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `users`";
            $res  = mysqli_query($con, $sql);
            if(mysqli_num_rows($res) > 0){
                while($data = mysqli_fetch_array($res)){
            ?>
                    <tr>
                        <td><?= $data['userid'] ?></td>
                        <td><?= $data['name'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['password'] ?></td>
                        <td>
                            <?= $data['roteype'] == 1 ? "ADMIN" : "USER" ?>
                        </td>
                        <td>
                            <a href="viewallusers.php?userid=<?= $data['userid'] ?>" 
                               onclick="return confirm('Are you sure you want to delete this user?')" 
                               class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="6">No users found</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];

    // Use a direct delete query
    $sql = "DELETE FROM users WHERE userid = '$userid'";

    if (mysqli_query($con, $sql)) {
        echo "<script> window.location.href='viewallusers.php?status=deleted'; </script>";
    } else {
        echo "<script> alert('User not deleted: " . mysqli_error($con) . "'); </script>";
    }
}
?>
