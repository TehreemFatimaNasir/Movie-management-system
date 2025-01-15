<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Movie</title>
    
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .section-title h2 {
            font-size: 36px;
            color: #343a40;
            font-weight: 600;
        }

        .form-group label {
            font-weight: 600;
            color: #495057;
        }

        .form-control {
            border-radius: 6px;
            padding: 10px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            font-size: 16px;
            padding: 12px 20px;
            width: 100%;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 20px;
        }

        select.form-control, input[type="date"].form-control {
            font-size: 16px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #343a40;
            color: #fff;
            margin-top: 50px;
        }
    </style>

</head>
<body>

<?php include('connect.php'); ?>
<?php include('header.php'); ?>

<div class="container">
    <div class="section-title">
        <h2>Book Your Movie</h2>
    </div>

    <form action="viewuserbooking.php" method="post">
        <div class="form-group">
            <label for="movie_name">Movie Name:</label>
            <input type="text" class="form-control" name="movie_name" id="movie_name" placeholder="Enter Movie Name" required>
        </div>
        
        <div class="form-group">
            <label for="category">Category:</label>
            <select name="category" id="category" class="form-control" required>
                <option value="">Select Category</option>
                <?php
                $sql = "SELECT * FROM categories";
                $res = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_array($res)) {
                    echo "<option value='{$data['catname']}'>{$data['catname']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" name="date" id="date" required>
        </div>

        <div class="form-group">
            <label for="days_time">Days/Time:</label>
            <input type="text" class="form-control" name="days_time" id="days_time" placeholder="e.g., Friday 7:00 PM" required>
        </div>

        <div class="form-group">
            <label for="ticket_count">Tickets:</label>
            <input type="number" class="form-control" name="ticket_count" id="ticket_count" placeholder="Enter Number of Tickets" min="1" required>
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" name="location" id="location" placeholder="Enter Location" required>
        </div>

        <div class="form-group">
            <label for="user">User:</label>
            <input type="text" class="form-control" name="user" id="user" placeholder="Enter Your Name" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Pending">Pending</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>

<?php include('footer.php'); ?>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
