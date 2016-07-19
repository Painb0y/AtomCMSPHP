<?php
 require '../core/core.php';

 $userInfo = new userInfo();

 if (isset($_SESSION['user']) && $userInfo->userRank($conexion, $_SESSION['user']) < 3) {
      header('Location: ../error');
 } elseif(!isset($_SESSION['user'])) {
      header('Location: ../error');
 }


 if (!isset($_SESSION['huser'])) {
      header('Location: login.php');
 }
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Site made with Mobirise Website Builder v2.14.2, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v2.14.2, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
  <meta name="description" content="Free Responsive Website Maker. Create awesome mobile-first websites. Easy and fast - No coding!">
  <title>Mobirise Mobile Website Builder</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:700,400&amp;subset=cyrillic,latin,greek,vietnamese">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/mobirise/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">



</head>
<body>
<section class="mbr-navbar mbr-navbar--freeze mbr-navbar--absolute mbr-navbar--sticky mbr-navbar--collapsed" id="menu-6">
    <div class="mbr-navbar__section mbr-section">
        <div class="mbr-section__container container">
            <div class="mbr-navbar__container">
                <div class="mbr-navbar__column mbr-navbar__column--s mbr-navbar__brand">
                    <span class="mbr-navbar__brand-link mbr-brand mbr-brand--inline">
                        <span class="mbr-brand__logo"><a href="https://mobirise.com"><img src="assets/images/logo.png" class="mbr-navbar__brand-img mbr-brand__img" alt="Mobirise"></a></span>

                    </span>
                </div>
                <div class="mbr-navbar__hamburger mbr-hamburger"><span class="mbr-hamburger__line"></span></div>
                <div class="mbr-navbar__column mbr-navbar__menu">
                   <?php require 'assets/templates/nav.php'; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="engine"><a rel="external" href="https://mobirise.com">free html website builder</a></section><section class="mbr-section mbr-section--relative mbr-section--short-paddings mbr-after-navbar" id="msg-box1-6" style="background-color: rgb(60, 60, 60);">



    <div class="mbr-section__container mbr-section__container--isolated container" style="padding-top: 60px; padding-bottom: 60px;">
        <div class="row">
            <div class="mbr-box mbr-box--fixed mbr-box--adapted">
                <div class="mbr-box__magnet mbr-box__magnet--top-left mbr-section__left col-sm-8">
                    <div class="mbr-section__container mbr-section__container--middle">
                        <div class="mbr-header mbr-header--auto-align mbr-header--wysiwyg">
                            <h3 class="mbr-header__text">PRE MADE BLOCKS</h3>
                        </div>
                    </div>
                    <div class="mbr-section__container">
                        <div class="mbr-article mbr-article--auto-align mbr-article--wysiwyg"><p>Mobirise comes with huge collection of pre made layouts to help make your development faster.</p></div>
                    </div>
                </div>
                <div class="mbr-box__magnet mbr-box__magnet--top-left mbr-section__right col-sm-4">
                    <div class="mbr-section__container">
                        <div class="mbr-buttons mbr-buttons--auto-align mbr-buttons--top mbr-buttons--left"><a class="mbr-buttons__btn btn btn-lg btn-danger" href="https://mobirise.com">START A JOURNEY</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smooth-scroll/SmoothScroll.js"></script>
  <script src="assets/mobirise/js/script.js"></script>

</body>
</html>
