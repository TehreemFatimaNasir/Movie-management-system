<?php
// Include the database connection file
include('connect.php'); // Ensure this file correctly initializes the $con variable

// Rest of your code
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
            background-color: #000 !important; /* Black background */
            font-family: "Baskervville SC", system-ui;
            color: #fff !important; /* White text for contrast */
        }
        .container {
            margin-top: 50px;
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
        .btn-primary, .btn-danger {
            font-size: 14px;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .movie-img {
            height: 50px;
            width: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
        .header-section {
            padding: 20px;
            background-color: #007bff;
            color: white;
            border-radius: 8px 8px 0 0;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-section">
        <h3 class="mb-0">Movies List</h3>
        <p class="mb-0">Manage and view all movie details including posters, trailers, and videos.</p>
    </div>

    <div class="col-lg-12">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Poster</th>
                    <th>Trailer</th>
                    <th>Video</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // SQL query to fetch movies with their categories
                $sql = "SELECT movies.*, categories.catname
                        FROM movies
                        INNER JOIN categories ON categories.catid = movies.catid";

                // Execute the query
                $res = mysqli_query($con, $sql);

                // Check if there are results
                if (mysqli_num_rows($res) > 0) {
                    while ($data = mysqli_fetch_array($res)) {
                ?>
                        <tr>
                            <td><?= $data['movieid'] ?></td>
                            <td><?= $data['title'] ?></td>
                            <td><?= $data['catname'] ?></td>
                            <td><img src="uploads/<?= $data['image'] ?>" class="movie-img" alt="Poster"></td>
                            <td>
                                <?php if (!empty($data['trailer'])): ?>
                                    <a href="uploads/<?= $data['trailer'] ?>" target="_blank" class="btn btn-link">View Trailer</a>
                                <?php else: ?>
                                    No Trailer
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($data['movie'])): ?>
                                    <a href="uploads/<?= $data['movie'] ?>" target="_blank" class="btn btn-link">View Video</a>
                                <?php else: ?>
                                    No Video
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="movies.php?editid=<?= $data['movieid'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="movies.php?deleteid=<?= $data['movieid'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="7" class="text-center">No movies found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
