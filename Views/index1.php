<?php
session_start();
require_once 'C:/xampp/htdocs/ta/Controller/configg.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['manager_id'])) {
    header("Location: login.php");
    exit();
}

// Get the logged-in manager's ID from the session
$manager_id = $_SESSION['manager_id'];

// Fetch the logged-in manager's details
$con = Config::getConnexion();
$sql = "SELECT manager.name, manager.email, manager.image, department.name AS department_name
        FROM manager
        JOIN department ON manager.department_id = department.id
        WHERE manager.id = :id";
$query = $con->prepare($sql);
$query->bindParam(':id', $manager_id, PDO::PARAM_INT);
$query->execute();

$manager = $query->fetch(PDO::FETCH_ASSOC);

// Check if manager details are found
if (!$manager) {
    die("Manager not found.");
}

// Display the manager details here
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
<!--

TemplateMo 569 Edu Meeting

https://templatemo.com/tm-569-edu-meeting

-->
  </head>

<body>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="index.html" class="logo">
                          RH
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                          <li class="scroll-to-section"><a href="#section-heading" class="active">Home</a></li>
                          <li><a href="meetings.html">Commencez une formation </a></li>
                          <li class="scroll-to-section"><a href="#courses">shop </a></li>
                          <li class="scroll-to-section"><a href="#contact">Contact Us</a></li>
                      </ul>
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
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

 
    <section class="employee-section" id="employee-list">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Employee List</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="employee-content">
                    
                    <!-- Button to Open Add Evaluation Page -->
                    <div class="mb-4">
                        <a href="addevaluation.php" class="btn btn-success">Add Employee Evaluation</a>
                    </div>
                    <!-- Logout Button -->
               <div class="container">
               <a href="logoutman.php" class="btn btn-danger">Logout</a>
                  </div>

                    <!-- Search and Sort Form -->
                    <form method="GET" action="#employee-list" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search_name" class="form-control" placeholder="Search by Name" value="<?= htmlspecialchars($_GET['search_name'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="search_email" class="form-control" placeholder="Search by Email" value="<?= htmlspecialchars($_GET['search_email'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <select name="search_department" class="form-control">
                                    <option value="">All Departments</option>
                                    <?php
                                    // Fetch the list of departments
                                    $departmentQuery = $con->query("SELECT id, name FROM department");
                                    $departments = $departmentQuery->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($departments as $department):
                                    ?>
                                        <option value="<?= htmlspecialchars($department['name']) ?>" <?= (($_GET['search_department'] ?? '') === $department['name']) ? 'selected' : '' ?>><?= htmlspecialchars($department['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <select name="sort_by" class="form-control">
                                    <option value="name" <?= ($_GET['sort_by'] ?? '') === 'name' ? 'selected' : '' ?>>Sort by Name</option>
                                    <option value="email" <?= ($_GET['sort_by'] ?? '') === 'email' ? 'selected' : '' ?>>Sort by Email</option>
                                    <option value="department_name" <?= ($_GET['sort_by'] ?? '') === 'department_name' ? 'selected' : '' ?>>Sort by Department</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="order" class="form-control">
                                    <option value="ASC" <?= ($_GET['order'] ?? '') === 'ASC' ? 'selected' : '' ?>>Ascending</option>
                                    <option value="DESC" <?= ($_GET['order'] ?? '') === 'DESC' ? 'selected' : '' ?>>Descending</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">Search & Sort</button>
                            </div>
                        </div>
                    </form>

                    <?php
                    // Prepare the SQL query with search and sort options
                    $sql = "SELECT employe.name, employe.email, department.name AS department_name
                            FROM employe
                            JOIN department ON employe.department_id = department.id
                            WHERE 1=1";

                    // Add search filters
                    if (!empty($_GET['search_name'])) {
                        $sql .= " AND employe.name LIKE :search_name";
                    }
                    if (!empty($_GET['search_email'])) {
                        $sql .= " AND employe.email LIKE :search_email";
                    }
                    if (!empty($_GET['search_department'])) {
                        $sql .= " AND department.name = :search_department";
                    }

                    // Add sorting
                    if (!empty($_GET['sort_by'])) {
                        $order = $_GET['order'] ?? 'ASC';
                        $sql .= " ORDER BY " . $_GET['sort_by'] . " " . $order;
                    }

                    $query = $con->prepare($sql);

                    // Bind parameters for search filters
                    if (!empty($_GET['search_name'])) {
                        $query->bindValue(':search_name', '%' . $_GET['search_name'] . '%', PDO::PARAM_STR);
                    }
                    if (!empty($_GET['search_email'])) {
                        $query->bindValue(':search_email', '%' . $_GET['search_email'] . '%', PDO::PARAM_STR);
                    }
                    if (!empty($_GET['search_department'])) {
                        $query->bindValue(':search_department', $_GET['search_department'], PDO::PARAM_STR);
                    }

                    $query->execute();
                    $employees = $query->fetchAll(PDO::FETCH_ASSOC);

                    if ($employees):
                    ?>
                        <table class="table table-striped mt-5">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employees as $employee): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($employee['name']) ?></td>
                                        <td><?= htmlspecialchars($employee['email']) ?></td>
                                        <td><?= htmlspecialchars($employee['department_name']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No employees found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>






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
