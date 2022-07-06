<?php
  if(!isset($_SESSION)) {
    session_start();
  }

  require_once ($_SERVER['DOCUMENT_ROOT'] .'/navigdata/classes/user.php');
  require_once ($_SERVER['DOCUMENT_ROOT'] .'/navigdata/classes/method.php');
  require_once ($_SERVER['DOCUMENT_ROOT'] .'/navigdata/classes/blog.php');
  $blog = new blogQuery\blog;
  $user = new userQuery\user;
  $method = new methodQuery\method;

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>NAVIGDATA</title>
      <link rel="icon" type="image/ico" href="images/logo1.jpeg">
      <meta content="" name="description">
      <meta content="" name="keywords">
      <!-- Favicons
      <link href="assets/img/favicon.png" rel="icon">
      <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      <!-- Vendor CSS Files -->
      <link href="assets/vendor/aos/aos.css" rel="stylesheet">
      <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
      <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
      <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
      <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
      <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
      <!-- For registration LOGIN-->
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
      
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css">
      <link rel="stylesheet" href="/vendors/formvalidation/dist/css/formValidation.min.css">
      <!-- Template Main CSS File -->
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="assets/css/main.css">
   </head>
   <body>
      <!-- ======= Header ======= -->
      <header>
        <div id="header">
          <div class="headcontent">  
            <div class="container d-flex align-items-center">
              <h1 class="logo me-auto"><a href="index.php"><img src="images/logo/logo.png" class="img-fluid animated" alt=""></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->
                <nav id="navbar" class="navbar">
                  <ul>
                  <?php 
                    if(isset($_SESSION['loggedin']) || isset($_SESSION['success']))
                    {
                  ?>
                      <li class="nav-link active"><a><u>Hello - <?php echo ucfirst($_SESSION['fname'])," ", ucfirst($_SESSION['lname']);?></u></a></li>
                      <li><a class="nav-link" href="about-us.php">About</a></li>
                      <li><a class="nav-link" href="data-challenge.php">Data Challenge</a></li>
                      <li><a class="nav-link" href="solution-approach.php">Solution Approach</a></li>
                      <li><a class="nav-link" href="blogs.php">Blogs</a></li>
                      <li><a class="nav-link" href="fun-with-data.php">Fun with Data</a></li>
                      <li><u><a class="nav-link" href="logout.php">Logout</a></u></li>
                      <!-- <li><a class="nav-link scrollto" href="#hero">Home</a></li> -->
                      <!-- <li><a class="nav-link scrollto" href="#about">About</a></li> -->
                      <!-- <li><a class="nav-link" href="blogs.navigdata.php">Blogs </a></li> -->
                      <!-- <li><a class="nav-link" href="register.php"><i class="fa fa-user" aria-hidden="true"></i> &nbsp Register</a></li> -->
                      <!-- <li><a class="nav-link" href="login.php"><i class="fa fa-user" aria-hidden="true"></i> &nbsp Login</a></li> -->
                    <!-- <li><a class="getstarted scrollto" href="#about">Get Started</a></li> -->
                    <?php 
                    }
                    else {
                    ?>
                      <li><a class="nav-link" href="about-us.php">About</a></li>
                      <li><a class="nav-link" href="data-challenge.php">Data Challenge</a></li>
                      <li><a class="nav-link" href="solution-approach.php">Solution Approach</a></li>
                      <li><a class="nav-link" href="blogs.php">Blogs</a></li>
                      <li><a class="nav-link" href="fun-with-data.php">Fun with Data</a></li>
                      <li><a href="register.php"><i class="fa fa-user" aria-hidden="true"></i> &nbsp Register</a></li>
                      <li><a href="login.php"><i class="fa fa-user" aria-hidden="true"></i> &nbsp Login</a></li>
                    <?php
                    }
                    ?>
                  </ul>
                    <i class="bi bi-list mobile-nav-toggle" style="color:black;"></i>
                </nav>
               <!-- .navbar -->
            </div>
          </div>
        </div>
      </header>
         <!-- End Header -->