<?php
session_start();
require_once 'C:/xampp/htdocs/ta/Controller/configg.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the logged-in user's ID from the session
$user_id = $_SESSION['user_id'];

// Fetch the logged-in user's details
$con = Config::getConnexion();
$sql = "SELECT employe.name, employe.email, employe.image, department.name AS department_name
        FROM employe
        JOIN department ON employe.department_id = department.id
        WHERE employe.id = :id";
$query = $con->prepare($sql);
$query->bindParam(':id', $user_id, PDO::PARAM_INT);
$query->execute();

$employe = $query->fetch(PDO::FETCH_ASSOC);

// Fetch the evaluations for the logged-in employee
$sql = "SELECT date, rating, comments FROM evaluations WHERE employe_id = :id";
$query = $con->prepare($sql);
$query->bindParam(':id', $user_id, PDO::PARAM_INT);
$query->execute();

$evaluations = $query->fetchAll(PDO::FETCH_ASSOC);

// Check if user details are found
if (!$employe) {
    die("User not found.");
}

// Display the user details here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <title>RH</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo.png" />
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
</head>
<body>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="index.html" class="logo">RH</a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                          <li class="scroll-to-section"><a href="#section-heading" class="active">Home</a></li>
                          <li><a href="meetings.html">Commencez une formation </a></li>
                          <li class="scroll-to-section"><a href="#courses">shop </a></li>
                          <li class="scroll-to-section"><a href="#contact">Contact Us</a></li>
                      </ul>
                      <a class='menu-trigger'><span>Menu</span></a>
                      <!-- ***** Menu End ***** -->
                  </nav>
              </div>
          </div>
      </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <!-- ***** Main Banner Area Start ***** -->
  <section class="section main-banner" id="top" data-section="section1">
      <video autoplay muted loop id="bg-video">
          <source src="assets/images/envi.mp4" type="video/mp4" />
      </video>
      <div class="video-overlay header-text">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="caption">
                  <h6>RH</h6>
                  <h2>Welcome to RH</h2>
                  <p>l'idée de notre projet est de créer un site web ...</p>
                  <div class="main-button-red">
                      <div class="scroll-to-section"><a href="#contact">Join Us Now!</a></div>
                  </div>
              </div>
              </div>
            </div>
          </div>
      </div>
  </section>
  <!-- ***** Main Banner Area End ***** -->

  <!-- ***** Profile Section Start ***** -->
  <section class="profile-section" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Profile Details</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="profile-content">
                    <h1 class="mt-5">Welcome, <?= htmlspecialchars($employe['name']) ?>!</h1>
                    <p>Email: <?= htmlspecialchars($employe['email']) ?></p>
                    <p>Department: <?= htmlspecialchars($employe['department_name']) ?></p>
                    <?php if ($employe['image']): ?>
                        <img src="<?= htmlspecialchars($employe['image']) ?>" alt="Profile Image" class="img-fluid" style="max-width: 200px;">
                    <?php endif; ?>
                    <div class="mt-3">
                        <a href="update.php" class="btn btn-primary">Update Profile</a>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  <!-- ***** Evaluations Section Start ***** -->
  <section class="evaluations-section" id="evaluations">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Evaluations</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="evaluations-content">
                    <?php if ($evaluations): ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Rating</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($evaluations as $evaluation): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($evaluation['date']) ?></td>
                                        <td><?= htmlspecialchars($evaluation['rating']) ?></td>
                                        <td><?= htmlspecialchars($evaluation['comments']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No evaluations found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
  <!-- ***** Evaluations Section End ***** -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




  <section class="our-facts">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="row">
            <div class="col-lg-12">
              <h2>Quelques faits sur notre environnement </h2>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-12">
                  <div class="count-area-content percentage">
                    <div class="count-digit">94</div>
                    <div class="count-title">Polution</div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="count-area-content">
                    <div class="count-digit">126</div>
                    <div class="count-title">perte d'eau</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-12">
                  <div class="count-area-content new-students">
                    <div class="count-digit">2345</div>
                    <div class="count-title">energie poluer</div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="count-area-content">
                    <div class="count-digit">32</div>
                    <div class="count-title">polution</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 align-self-center">
          <div class="video">
            <a href="https://www.youtube.com/watch?v=MhaPSSJ9ZBs" target="_blank"><img src="assets/images/play-icon.png" alt=""></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="contact-us" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 align-self-center">
          <div class="row">
            <div class="col-lg-12">
              <form id="contact" action="" method="post">
                <div class="row">
                  <div class="col-lg-12">
                    <h2>Let's get in touch</h2>
                  </div>
                  <div class="col-lg-4">
                    <fieldset>
                      <input name="name" type="text" id="name" placeholder="YOURNAME...*" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-4">
                    <fieldset>
                    <input name="email" type="text" id="email" placeholder="YOUR EMAIL..." required="">
                  </fieldset>
                  </div>
                  <div class="col-lg-4">
                    <fieldset>
                      <input name="subject" type="text" id="subject" placeholder="SUBJECT...*" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <textarea name="message" type="text" class="form-control" id="message" placeholder="YOUR MESSAGE..." required=""></textarea>
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="button">envoyer un message </button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="right-info">
            <ul>
              <li>
                <h6>TEL</h6>
                <span>26483684</span>
              </li>
              <li>
                <h6>Email Address</h6>
                <span>tarek.soualhia@esprit.tn</span>
              </li>
              <li>
                <h6> Address</h6>
                <span>ESPRIT</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="jvs.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
          e.preventDefault();
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>

</body>
</html>
