<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout</title>

    <!--bootstrap css components-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />

    <!--font awesome-->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
          <img src="assets/images/mangaLogo6.png" alt="logo" />
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div
            class="collapse navbar-collapse nav-buttons"
            id="navbarSupportedContent"
          >
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="home.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="shop.html">Shop</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link" href="#bot">Contact Us</a>
              </li>
  
              <!-- <li class="nav-item">
                  <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li> -->
              <li class="nav-item">
                <a href="cart.html"><i class="fas fa-shopping-cart"></i></a>
                <a href="account.html"><i class="fas fa-user"></i></a>
              </li>
            </ul>
            <!-- search bar -->
            <!-- <form class="d-flex" role="search">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-outline-success" type="submit">
                Search
              </button>
            </form> -->
          </div>
        </div>
    </nav>

    <!-- checkout -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Checkout</h2>
            <!-- <hr class="mx-auto"> -->
        </div>
        <div class="mx-auto container">
            <form id="checkout-form">
                <div class="form-group checkout-small">
                    <label>Name</label>
                    <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required/>
                </div>
                <div class="form-group checkout-small">
                    <label>Email</label>
                    <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group checkout-small">
                    <label>Phone</label>
                    <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required/>
                </div>
                <div class="form-group checkout-small">
                    <label>City</label>
                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required/>
                </div>
                <div class="form-group checkout-large">
                    <label>Address</label>
                    <input type="text" class="form-control" id="checkout-address" name="adress" placeholder="Address" required/>
                </div>
                <div class="form-group checkout-btn-container">
                    <input type="submit" class="btn" id="checkout-btn" value="Checkout"/>
                </div>
            </form>
        </div>
    </section>
    




    <!-- footer -->
    <footer class="bg-dark text-light py-4">
        <div id="bot" class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2023 Your Website. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-right">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#" class="text-light">Top of page</a></li>
                        <li class="list-inline-item"><a href="mailto:recipient@example.com?subject=Subject%20of%20the%20email&body=Body%20of%20the%20email">Email Us</a></li>
                        <li class="list-inline-item"><h5>Phone No: +880213</h3></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>


    <!--bootstrap import js components-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </body>
</html>