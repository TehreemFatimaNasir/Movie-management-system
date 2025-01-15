<?php include('connect.php'); ?>

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
   
    <title>Register</title>

    <!-- Favicons
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <style>
    body {
        background-color: #000; /* Black background */
        color: #fff; /* White text for contrast */
        font-family: "Baskervville SC", system-ui;
        font-style: normal;
        margin: 0;
        padding: 0;
        line-height: 1.6;
    }

    .btn-primary {
        background-color: rgb(104, 17, 17) !important;
        border-color: rgb(104, 17, 17) !important;
        color: #fff !important;
        padding: 9px 20px;
        font-size: 19px;
        font-weight: 400;
    }

    .btn-primary:hover {
        background-color: rgb(145, 99, 99) !important;
        border-color: rgb(145, 99, 99) !important;
    }

    .php-email-form {
        max-width: 400px;
        margin: 50px auto 0 auto; /* Centers form horizontally and adds top margin */
        background-color: rgba(255, 255, 255, 0.1); /* Optional: Slight background for contrast */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    }

    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh; /* Makes sure container spans the full height of the viewport */
    }

    .text-center {
        text-align: center;
    }

    .form-control {
        font-weight: 800;
        width: 100%; /* Ensures all inputs span the same width */
        height: 50px; /* Sets a consistent height */
    }

    .form-group {
        margin-bottom: 20px; /* Adds consistent spacing between inputs */
    }
</style>

</head>
<body>
<section id="team" class="team section-bg">
    <div class="container aos-init aos-animate form-container" data-aos="fade-up">
        <div>
           
        

            <center>
                <form action="register.php" method="post" role="form" class="php-email-form">
                <div class="section-title">
                <h2>Register for Booking Ticket</h2>
            </div> <br>
                    <div class="row">
                        <div class=" form-group mb-3">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required>
                        </div>
                    </div>
                    <div class=" form-group mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                    </div>
                    <div class=" form-group mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Your Password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="register">Register</button>
                    </div>
                </form>
            </center>
        </div>
    </div>
</section>
</body>
</html>

<?php
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `users`(`name`, `email`, `password`, `roteype`) VALUES ('$name', '$email', '$password', '2')";

    if (mysqli_query($con, $sql)) {
        echo "<script> alert('User registered successfully!'); </script>";
        echo "<script> window.location.href='login.php'; </script>";
    } else {
        echo "<script> alert('Registration failed. Please try again.'); </script>";
    }
}
?>
