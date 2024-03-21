<?php
include 'dbConnect.php';
include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>

  <!--bootstrap css components-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

  <!--font awesome-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <!-- navbar -->


  <!-- Home -->
  <section id="home">
    <div class="container">
      <h1 class="front">One Punch Manga</h1>
      <h3 class="front">Discover new horizons with every manga</h3>
      <style>
        /* Style the link within the button */
        button a {
          text-decoration: none;
          /* Remove underline */
          color: black;
          /* Set text color to black */
        }
      </style>

      <button><a href="shop.php">Shop Now</a></button>


    </div>
  </section>

  <!-- manga logos -->
  <section id="brand" class="container">
    <div class="row">
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/onepieceLogo.png" />
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/vagabondLogo.png" />
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/monsterLogo.png" />
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/images/jojoLogo.png" />
    </div>
  </section>

  <!-- items -->
  <section id="new" class="w-100">
    <div class="row p-0 m-0">
      <!-- item1 -->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/images/jjkmanga3.jpg" />
        <div class="details">

        </div>
      </div>
      <!-- item2 -->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/images/bleach.jpg" />
        <div class="details">
          <h2>Check Out Our Collection</h2>
          <style>
            /* Style the link within the button */
            button a {
              text-decoration: none;
              /* Remove underline */
              color: white;
              /* Set text color to black */
            }
          </style>
          <button><a href="shop.php">Shop Now</a></button>
        </div>
      </div>
      <!-- item3 -->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/images/oneshots.jpg" />
        <div class="details">

        </div>
      </div>
    </div>
  </section>



  <!-- footer -->
  <?php
  include('footer.php');
  ?>

  <!--bootstrap import js components-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>