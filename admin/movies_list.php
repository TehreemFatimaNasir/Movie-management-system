<?php
include('../connect.php');

if (!isset($_SESSION['uid'])) {
    echo "<script> window.location.href='../login.php';  </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>
    <style>
          body {
            background-color: #000 !important; /* Black background */
            font-family: "Baskervville SC", system-ui;
            color: #fff !important; /* White text for contrast */
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
    </style>
</head>
<body>
<?php include('header.php'); ?>
<br><br><br><br>
<div class="container">
    <h4 class="text-center">Uploaded Movies</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Poster</th>
                <th>Description</th>
                <th>Trailer</th>
                <th>Movie File</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT movies.*, categories.catname FROM movies 
                    INNER JOIN categories ON categories.catid = movies.catid";
            $res = mysqli_query($con, $sql);

            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>
                        <td>{$row['movieid']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['catname']}</td>
                        <td><img src='uploads/{$row['image']}' alt='Poster' height='50'></td>
                        <td>{$row['description']}</td>
                        <td><a href='uploads/{$row['trailer']}' target='_blank'>View Trailer</a></td>
                        <td><a href='uploads/{$row['movie']}' target='_blank'>Download Movie</a></td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No movies uploaded yet.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>
</body>
</html>
