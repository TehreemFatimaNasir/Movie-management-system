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
   
    <title>Categories</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Baskervville SC", system-ui;
        background-color: #000 !important; /* Black background */
        color: #fff !important; /* White text for contrast */
           
        }
        .container {
        margin-top: 10px;
    }
    h4{
        font-family: "Baskervville SC", system-ui;
        font-weight: bold !important;
    }
        .btn-primary {
            background-color: rgb(104, 17, 17) !important;
            border: none !important;
        }
        .btn-danger {
            background-color:rgb(145, 67, 75) !important;
            border: none !important;
        }
        .table th, .table td {
            vertical-align: middle;
            background-color: #000 !important;
            color: #fff !important;
            font-family: "Baskervville SC", system-ui;

        }
        .form-container {
            font-weight: bold !important;
            font-family: "Baskervville SC", system-ui;
            background-color: #000 !important;
            color: #fff !important;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 1px 1px 1px 3px  rgb(228, 218, 218);
            margin-top: 90px;
        }
    </style>
</head>
<?php include('header.php'); ?>
<br><br><br><br>
<body>



<div class="container">
    <div class="row">
        <!-- Category Form -->
        <div class="col-lg-6">
            <div class="form-container">
                <form action="categories.php" method="post">
                    <h4 class="mb-4">Manage Category</h4>
                    <?php
                    if(isset($_GET['editid'])){
                        $editid = $_GET['editid'];
                        $sql = "SELECT * FROM `categories` WHERE catid='$editid'";
                        $res = mysqli_query($con, $sql);
                        $editdata = mysqli_fetch_array($res);
                    ?>
                    <input type="hidden" class="form-control mb-3" name="catid" value="<?= $editdata['catid']; ?>">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="catname" value="<?= $editdata['catname']; ?>" placeholder="Enter Category Name" required>
                    </div>
                    <button type="submit" class="btn btn-info w-100" name="update">Update</button>
                    <?php } else { ?>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="catname" placeholder="Enter Category Name" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="add">Add</button>
                    <?php } ?>
                </form>
            </div>
        </div>

        <!-- Category Table -->
        <div class="col-lg-6">
            
            <h4 class="mb-4">Category List</h4>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `categories`";
                    $res = mysqli_query($con, $sql);
                    if(mysqli_num_rows($res) > 0){
                        while($data = mysqli_fetch_array($res)){
                    ?>
                    <tr>
                        <td><?= $data['catid']; ?></td>
                        <td><?= $data['catname']; ?></td>
                        <td>
                            <a href="categories.php?editid=<?= $data['catid']; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="categories.php?deleteid=<?= $data['catid']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='3' class='text-center'>No categories found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<br><br>
<?php include('footer.php'); ?>
<?php
// Add Category
if(isset($_POST['add'])){
    $name = $_POST['catname'];
    $sql = "INSERT INTO `categories` (`catname`) VALUES ('$name')";

    if(mysqli_query($con, $sql)){
        echo "<script>alert('Category added successfully!'); window.location.href='categories.php';</script>";
    } else {
        echo "<script>alert('Failed to add category.');</script>";
    }
}

// Update Category
if(isset($_POST['update'])){
    $catid = $_POST['catid'];
    $name = $_POST['catname'];
    $sql = "UPDATE `categories` SET `catname`='$name' WHERE `catid`='$catid'";

    if(mysqli_query($con, $sql)){
        echo "<script>alert('Category updated successfully!'); window.location.href='categories.php';</script>";
    } else {
        echo "<script>alert('Failed to update category.');</script>";
    }
}

// Delete Category
if(isset($_GET['deleteid'])){
    $deleteid = $_GET['deleteid'];
    $sql = "DELETE FROM `categories` WHERE `catid`='$deleteid'";

    if(mysqli_query($con, $sql)){
        echo "<script>alert('Category deleted successfully!'); window.location.href='categories.php';</script>";
    } else {
        echo "<script>alert('Failed to delete category.');</script>";
    }
}
?>
