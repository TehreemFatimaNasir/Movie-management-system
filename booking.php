<?php
// Include database connection
include('connect.php');

// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['uid'])) {
    echo "<script> window.location.href='login.php'; </script>";
    exit;
}

// Validate 'id' parameter
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    echo "<script> alert('Theater ID is missing or invalid!'); window.location.href='index.php'; </script>";
    exit;
}

// Sanitize and assign the theater ID
$theaterid = (int)$_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Booking</title>
    <style>
        /* Add your custom styles here */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1e1e1e;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .section-title h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 36px;
            color: #9e1b32;
        }

        .team {
            padding: 50px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .team .container {
            max-width: 800px;
            width: 100%;
        }

        .team .row {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .team .form-group input {
            font-size: 16px;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #444;
            background-color: #333;
            color: #fff;
            width: 100%;
            margin-bottom: 20px;
        }

        .team .form-group input:focus {
            border-color: #9e1b32;
            outline: none;
        }

        .team .btn-primary {
            background-color: #9e1b32;
            border: none;
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 5px;
            transition: 0.3s;
            color: #fff;
            width: 100%;
            margin-top: 20px;
        }

        .team .btn-primary:hover {
            background-color: #7f1629;
        }

        .team .form-group label {
            color: #fff;
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<section id="team" class="team section-bg">
    <div class="container">
        <div class="section-title">
            <h2>Ticket Booking for Theater</h2>
        </div>

        <div class="row">
            <form action="" method="post" class="w-100">
                <input type="hidden" name="theaterid" value="<?= htmlspecialchars($theaterid) ?>">

                <div class="form-group mb-4">
                    <input type="number" class="form-control" name="person" placeholder="Enter No. of People" min="1" required>
                </div>

                <div class="form-group mb-4">
                    <input type="date" class="form-control" name="date" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="ticketbook">Book Ticket</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
if (isset($_POST['ticketbook'])) {
    // Retrieve form data
    $person = (int)$_POST['person'];
    $date = $_POST['date'];
    $theaterid = (int)$_POST['theaterid'];
    $userid = (int)$_SESSION['uid'];

    // Validate date
    $date = date('Y-m-d', strtotime($date));

    // Insert booking details into the database
    $sql = "INSERT INTO booking (theaterid, bookingdate, person, userid, status) 
            VALUES ('$theaterid', '$date', '$person', '$userid', 0)";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Ticket booked successfully!');</script>";
        echo "<script>window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Ticket booking failed: " . mysqli_error($con) . "');</script>";
    }
}
?>
