  <body>
      <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
          <div class="container">
              <a class="navbar-brand" href="index.html">Coffee<small>Blend</small></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="oi oi-menu"></span> Menu
              </button>
              <div class="collapse navbar-collapse" id="ftco-nav">
                  <ul class="navbar-nav ml-auto">
                      <li class="nav-item active"><a href="<?php echo APPURL; ?>index.php" class="nav-link">Home</a></li>
                      <li class="nav-item"><a href="<?php echo APPURL; ?>menu.php" class="nav-link">Menu</a></li>
                      <li class="nav-item"><a href="<?php echo APPURL; ?>services.php" class="nav-link">Services</a></li>
                      <li class="nav-item"><a href="<?php echo APPURL; ?>about.php" class="nav-link">About</a></li>

                      <li class="nav-item"><a href="<?php echo APPURL; ?>contact.php" class="nav-link">Contact</a></li>
                      <?php if (isset($_SESSION['username'])):  ?>
                          <li class="nav-item cart"><a href="<?php echo APPURL; ?>products/cart.php" class="nav-link"><span class="icon icon-shopping_cart"></span></a>
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  <?php echo $_SESSION['username'] ?>
                              </a>
                              <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="<?php echo APPURL; ?>bookings/booking-list.php">Your Booking Table</a></li>
                                  <li><a class="dropdown-item" href="<?php echo APPURL; ?>products/orders.php">Your Orders</a></li>
                                  <li><a class="dropdown-item" href="<?php echo APPURL; ?>auth/logout.php">Logout</a></li>
                              </ul>
                          </li>

                      <?php else: ?>
                          <li class="nav-item"><a href="<?php echo APPURL; ?>auth/login.php" class="nav-link">login</a></li>
                          <li class="nav-item"><a href="<?php echo APPURL; ?>auth/register.php" class="nav-link">register</a></li>
                      <?php endif ?>
                  </ul>
              </div>
          </div>
      </nav>
      <!-- END nav -->