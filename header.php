<!-- Favicons -->
<link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <!-- <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> -->
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">




  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="dashboard.php">Movies System<span>.</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
         <?php
         
          if(!isset($_SESSION['uid'])){
           
            echo '
            <li><a class="nav-link scrollto" href="allmovies.php">Movies</a></li>
            <li><a class="nav-link scrollto" href="alltheater.php">Theater</a></li>
            <li><a class="nav-link scrollto" href="login.php">Login</a></li>
            <li><a class="nav-link scrollto" href="register.php">Register</a></li>
            ';
          }else{
            $type = $_SESSION['type'];
             if($type == 2){
              echo '
              <li><a class="nav-link scrollto" href="movies.php">Movies</a></li>
              <li><a class="nav-link scrollto" href="alltheater.php">Theater</a></li>
              <li><a class="nav-link scrollto" href="viewuserbooking.php">Booking</a></li>
              <li><a class="nav-link scrollto" href="viewprofile.php">Profile</a></li>
         
              <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>
             
              ';
             }
          }

         ?>
        
       
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>

    /* Header Styling */
#header {
  font-family: "Baskervville SC", system-ui;
  font-weight: 400;
  font-style: normal;
  background-color:rgb(104, 17, 17);
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  position: fixed; /* Fixed position to stay at the top */
  top: 0; /* Align to the top */
  width: 100%; /* Full width of the viewport */
  z-index: 1000; /* High z-index to appear above other elements */
}

.baskervville-sc-regular {
  font-family: "Baskervville SC", system-ui;
  font-weight: 400;
  font-style: normal;
}

/* Container inside the header */
#header .container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 2rem;
}

/* Logo Styling */
#header h1.logo {
  font-size: 1.8rem;
  color: #fff;
  font-family: "Baskervville SC", system-ui;
  font-style: normal;
  font-weight: 600;
  margin: 0;
}

#header h1.logo a {
  text-decoration: none;
  color: #fff;
}

#header h1.logo span {
  color:rgb(179, 140, 140); /* Accent color */
}

/* Navbar Styling */
#navbar {
  display: flex;
  align-items: center;
  justify-content: center;
}

#navbar ul {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
}

#navbar ul li {
  margin: 0 1rem;
}

#navbar ul li a {
  text-decoration: none;
  color: #ddd;
  font-family: "Baskervville SC", system-ui;
  font-style: normal;
  font-weight: 800;
  padding: 0.5rem 1rem;
  border-radius: 25px;
  transition: all 0.3s ease-in-out;
}

#navbar ul li a:hover {
  background-color:rgb(145, 99, 99);
  color: #fff;
}

/* Active link styling */
#navbar ul li a.active {
  background-color:rgb(145, 104, 104);
  color: #fff;
}

/* Mobile menu toggle */
.mobile-nav-toggle {
  display: none;
  color: #fff;
  font-size: 1.5rem;
  cursor: pointer;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
  #navbar {
    display: none;
    flex-direction: column;
    position: absolute;
    top: 70px;
    left: 0;
    background-color: #1f1f1f;
    width: 100%;
    padding: 1rem;
  }

  #navbar.active {
    display: flex;
  }

  #navbar ul {
    flex-direction: column;
  }

  #navbar ul li {
    margin: 1rem 0;
  }

  .mobile-nav-toggle {
    display: block;
  }
}

  </style>
</head>
<body>
  
</body>
</html>

  <script>
  // Mobile navbar toggle
  document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.querySelector(".mobile-nav-toggle");
    const navbar = document.querySelector("#navbar");

    toggle.addEventListener("click", () => {
      navbar.classList.toggle("active");
    });
  });
</script>
