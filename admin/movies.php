<?php
include('../connect.php');

if (!isset($_SESSION['uid'])) {
    echo "<script> window.location.href='../login.php';  </script>";
}

// Handle delete functionality
if (isset($_GET['deleteid'])) {
    $deleteid = $_GET['deleteid'];
    $sql = "DELETE FROM `movies` WHERE `movieid` = '$deleteid'";
    if (mysqli_query($con, $sql)) {
        echo "<script> alert('Movie deleted successfully'); </script>";
        echo "<script> window.location.href='movies.php'; </script>";
    } else {
        echo "<script> alert('Failed to delete movie'); </script>";
    }
}

// Initialize variables for edit
$editMode = false;
$movieData = [
    'movieid' => '',
    'catid' => '',
    'title' => '',
    'description' => '',
    'releasedate' => '',
    'image' => '',
    'trailer' => '',
    'movie' => ''
];

// Handle edit functionality
if (isset($_GET['editid'])) {
    $editid = $_GET['editid'];
    $sql = "SELECT * FROM `movies` WHERE `movieid` = '$editid'";
    $res = mysqli_query($con, $sql);
    if ($res && mysqli_num_rows($res) > 0) {
        $movieData = mysqli_fetch_assoc($res);
        $editMode = true; // Toggle edit mode
    } else {
        echo "<script> alert('Movie not found'); </script>";
        echo "<script> window.location.href='movies.php'; </script>";
    }
}

// Handle update functionality
if (isset($_POST['update'])) {
    $editid = $_POST['editid'];
    $catid = $_POST['catid'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $releasedate = $_POST['releasedate'];

    $image = $_FILES['image']['name'] ?: $movieData['image'];
    $trailer = $_FILES['trailer']['name'] ?: $movieData['trailer'];
    $movie = $_FILES['movie']['name'] ?: $movieData['movie'];

    if ($image && $_FILES['image']['tmp_name']) {
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image");
    }

    if ($trailer && $_FILES['trailer']['tmp_name']) {
        move_uploaded_file($_FILES['trailer']['tmp_name'], "uploads/$trailer");
    }

    if ($movie && $_FILES['movie']['tmp_name']) {
        move_uploaded_file($_FILES['movie']['tmp_name'], "uploads/$movie");
    }

    $sql = "UPDATE `movies` SET 
            `title`='$title', 
            `description`='$description', 
            `releasedate`='$releasedate',
            `image`='$image',
            `trailer`='$trailer',
            `movie`='$movie',
            `catid`='$catid'
            WHERE `movieid`='$editid'";

    if (mysqli_query($con, $sql)) {
        echo "<script> alert('Movie updated successfully'); </script>";
        echo "<script> window.location.href='movies.php'; </script>";
    } else {
        echo "<script> alert('Failed to update movie'); </script>";
    }
}

// Handle add functionality
if (isset($_POST['add'])) {
    $catid = $_POST['catid'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $releasedate = $_POST['releasedate'];

    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];

    $trailer = $_FILES['trailer']['name'];
    $tmp_trailer = $_FILES['trailer']['tmp_name'];

    $movie = $_FILES['movie']['name'];
    $tmp_movie = $_FILES['movie']['tmp_name'];

    if (!empty($tmp_image)) {
        move_uploaded_file($tmp_image, "uploads/$image");
    }

    if (!empty($tmp_trailer)) {
        move_uploaded_file($tmp_trailer, "uploads/$trailer");
    }

    if (!empty($tmp_movie)) {
        move_uploaded_file($tmp_movie, "uploads/$movie");
    }

    $sql = "INSERT INTO `movies`(`title`, `description`, `releasedate`, `image`, `trailer`, `movie`, `catid`) 
            VALUES ('$title', '$description', '$releasedate', '$image', '$trailer', '$movie', '$catid')";

    if (mysqli_query($con, $sql)) {
        echo "<script> alert('Movie added successfully'); </script>";
        echo "<script> window.location.href='movies.php'; </script>";
    } else {
        echo "<script> alert('Error: " . mysqli_error($con) . "'); </script>";
    }
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
   
    <title>Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ2RZfU8lL+P+LlaD7heC5At8gV7yKakZoxGnBxwJzIU5ybfNfi9vEJlD4s1" crossorigin="anonymous">
    <style>
   body {
        font-family: "Baskervville SC", system-ui;
        background-color: #000 !important; /* Black background */
        color: #fff !important; /* White text for contrast */
    }
    h4{
      font-family: "Baskervville SC", system-ui;
       font-weight: bold;
    }
    .container {
        margin-top: 10px;
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
        
    }
    .table {
      font-family: "Baskervville SC", system-ui;
        background-color: #000 !important; /* Black background */
        color: #fff !important; /* White text for contrast */
        border: 2px solid #fff; /* White border for the table */
        width: 560px !important;
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
        margin: 0 5px;
    }
    .table a.btn {
        margin-top: 5px;
    }
    .card {
    border-radius: 8px;
    font-family: "Baskervville SC", system-ui;
    background-color: #000 !important; /* Black background */
    color: #fff !important; /* White text for contrast */
    border: 1px solid #fff !important; /* White border for the card */
}

</style>

</head>
<?php include('header.php'); ?>
<body>


<br><br>
<br><br>

<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <div class="card shadow-sm p-4">
        <h4 class="mb-4"><?php echo $editMode ? 'Edit Movie' : 'Add New Movie'; ?></h4>
        <form action="movies.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="editid" value="<?php echo $movieData['movieid']; ?>">

          <div class="form-group mb-4">
            <label for="catid">Category</label>
            <select name="catid" class="form-control" id="catid">
              <option value="">Select Category</option>
              <?php
              $sql = "SELECT * FROM `categories`";
              $res = mysqli_query($con, $sql);
              if (mysqli_num_rows($res) > 0) {
                while ($data = mysqli_fetch_array($res)) {
                  $selected = $movieData['catid'] == $data['catid'] ? 'selected' : '';
                  echo "<option value='{$data['catid']}' $selected>{$data['catname']}</option>";
                }
              } else {
                echo "<option value=''>No Category Found</option>";
              }
              ?>
            </select>
          </div>

          <div class="form-group mb-4">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="<?php echo $movieData['title']; ?>" placeholder="Enter Title">
          </div>

          <div class="form-group mb-4">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" placeholder="Enter Description"><?php echo $movieData['description']; ?></textarea>
          </div>

          <div class="form-group mb-4">
            <label for="releasedate">Release Date</label>
            <input type="date" class="form-control" name="releasedate" id="releasedate" value="<?php echo $movieData['releasedate']; ?>">
          </div>

          <div class="form-group mb-4">
            <label for="image">Poster</label>
            <input type="file" class="form-control" name="image" id="image">
            <?php if ($movieData['image']) echo "<img src='uploads/{$movieData['image']}' height='50' alt='Current Poster'>"; ?>
          </div>

          <div class="form-group mb-4">
            <label for="trailer">Trailer</label>
            <input type="file" class="form-control" name="trailer" id="trailer">
            <?php if ($movieData['trailer']) echo "<a href='uploads/{$movieData['trailer']}' target='_blank'>View Current Trailer</a>"; ?>
          </div>

          <div class="form-group mb-4">
            <label for="movie">Movie File</label>
            <input type="file" class="form-control" name="movie" id="movie">
            <?php if ($movieData['movie']) echo "<a href='uploads/{$movieData['movie']}' target='_blank'>View Current Movie</a>"; ?>
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="<?php echo $editMode ? 'Update' : 'Add'; ?>" name="<?php echo $editMode ? 'update' : 'add'; ?>">
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-6">
  <h4 class="mb-4">Movies List</h4>
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Category</th>
        <th>Poster</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT movies.*, categories.catname FROM movies INNER JOIN categories ON categories.catid = movies.catid";
      $res = mysqli_query($con, $sql);
      if (mysqli_num_rows($res) > 0) {
        while ($data = mysqli_fetch_array($res)) {
          echo "
          <tr>
            <td>{$data['movieid']}</td>
            <td>{$data['title']}</td>
            <td>{$data['catname']}</td>
            <td><img src='uploads/{$data['image']}' height='50' width='50' alt=''></td>
            <td>
              <a href='movies.php?editid={$data['movieid']}' class='btn btn-primary btn-sm'>Edit</a>
              <a href='movies.php?deleteid={$data['movieid']}' class='btn btn-danger btn-sm'>Delete</a>
            </td>
          </tr>";
        }
      } else {
        echo "<tr><td colspan='5'>No movies found</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>

    </div>
  </div>
</div>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
