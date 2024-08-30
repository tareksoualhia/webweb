<?php
	include("../controller/formationC.php");
  $resultp=get_all_formations();
  inscrire();
?>
<!DOCTYPE html>
<html lang="en">

  <head>




    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>GreenLand</title>
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
                          GreenLand
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
              <h6>GrennLand</h6>
              <h2>Welcome to GreenLand</h2>
              <p>l'idée de notre projet est de créer un site web qui vise les personnes qui ont une liaison directe avec l'environnement
              que ce soit jardinage ,reycyclage,pépinerie...  on vous assure dans notre site d'etre former par des spécialistes en domaine de jardinage , recyclage et beaucoup d'autres formations .
              Aussi en notre site il y a les derniéres nouvelles sur la nature,les technologies vertes et plus encore, Et avec un forum qui facilite la communication entre les formateurs et les clients..</p>
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

  <section class="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="owl-service-item owl-carousel">

            <div class="item">
              <div class="icon">
                <img src="assets/images/service-icon-01.jpg" alt="">
              </div>
              <div class="down-content">
                <h4>Recyclage</h4>
                <p>Formation en recyclage .</p>
              </div>
            </div>

            <div class="item">
              <div class="icon">
                <img src="assets/images/service-icon-02.jpg" alt="">
              </div>
              <div class="down-content">
                <h4>agriculture</h4>
                <p>Formation en agriculture.</p>
              </div>
            </div>

            <div class="item">
              <div class="icon">
                <img src="assets/images/service-icon-03.jpg" alt="">
              </div>
              <div class="down-content">
                <h4>Jardinage</h4>
                <p>Formation en jardinage .</p>
              </div>
            </div>


            <div class="item">
              <div class="icon">
                <img src="assets/images/service-icon-04.jpg" alt="">
              </div>
              <div class="down-content">
                <h4>Pépinière</h4>
                <p>Formation de Pépinière.</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="upcoming-meetings" id="meetings">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Nos Formations</h2>
            <a class="btn btn-danger" href="trierpardate.php">trier</a>

            <form action="?search" method="get">
            <div class="mb-3">
              <input type="text" name="search" class="form-control" placeholder="search by name">
            </div>
            </form>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="categories">
          <form name="f" onsubmit="return verif()" action="?inscri" method="POST">
            <h4>Inscription aux Formations </h4>
            <ul>
              <li> <div class="col-lg-4">
                    <fieldset>
                      <input name="nom" type="text" id="name" placeholder="Nom et Prenom" required="">
                    </fieldset>
                  </div></li>
              <li><div class="col-lg-4">
                    <fieldset>
                    <input name="email" type="text" id="email" placeholder="EMAIL" required="">
                  </fieldset>
                  </div> </a></li>
              <li><div class="col-lg-4">
                    <fieldset>
                    <input name="tel" type="number" id="tel" placeholder="TEL" required="">
                  </fieldset>
                  </div> </a></li>
              <li><div class="col-lg-4">
                    <fieldset>
                      <p>ID</p>
                     <select name="id_formation" style="width: 200px;" aria-placeholder="id formation">
                      <?php foreach ($resultp as $formation) : ?>
                        <option value="<?=$formation['id']?>"><?=$formation['id']?></option>
                      <?php endforeach ?>
                      </select>
                    </fieldset>
                  </div></a></li>
              <li> <fieldset>
                      <input name="code" type="number" id="code-pay" placeholder="Code de payment par D17" required="">
                    </fieldset></a></li>
              <li> <h6>NB:LE PAYMENT DE FORMATION EST PAR D17 VOUS POUVEZ ENVOYEZ LA MANDAT AU 52537762 <h6></li>
            </ul>
            <div class="main-button-red">
              <input class="btn btn-danger" type="submit" value="Envoyer">
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="row">
          <?php $resultp=get_formation(); foreach ($resultp as $formation) : ?>
            <div class="col-lg-6">
              <div class="meeting-item">
                <div class="thumb">
                  <div class="price">
                    <span><?=$formation['prix']?>DT</span>
                  </div>
                  <a href="meeting-details.php?detail=<?=$formation['id']?>"><img src="<?=$formation['image']?>" alt="New Lecturer Meeting"></a>
                </div>
                <div class="down-content">
                  <div class="date">
                    <h6>ID <span><?=$formation['id']?></span></h6>
                  </div>
                  <a href="meeting-details.php?detail=<?=$formation['id']?>"><h4><?=$formation['nom']?></h4></a>
                  <p><?=$formation['description']?><br><h6>Formateur:<?=$formation['formateur']?>.</h6></p>
                </div>
              </div>
            </div>
          <?php endforeach ?>
          </div>
          <?php butt(); ?>
        </div>
      </div>
    </div>
  </section>


  <section class="our-courses" id="courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Nos produits </h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-courses-item owl-carousel">
            <div class="item">
              <img src="assets/images/plante1.jpg" alt="Course One">
              <div class="down-content">
                <h4>plante artificiel</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                       <span>check out our shop </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/pot.jpg" alt="Course Two">
              <div class="down-content">
                <h4>Pot en céramque </h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                       <span>check out our shop</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/plante3.jpg" alt="">
              <div class="down-content">
                <h4>plante d'exterieur</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                       <span> check out our shop</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/plante2.jpg" alt="">
              <div class="down-content">
                <h4>mini-cactus</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                       <span>check out our shop </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
                <span>52537762</span>
              </li>
              <li>
                <h6>Email Address</h6>
                <span>aymen.trifi@esprit.tn</span>
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
