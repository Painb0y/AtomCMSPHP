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
  <meta name="description" content="">

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

<section class="mbr-section mbr-section--relative mbr-section--fixed-size mbr-after-navbar" id="form1-18" style="background-color: rgb(239, 239, 239);">

    <div class="mbr-section__container mbr-section__container--std-padding container" style="padding-top: 93px; padding-bottom: 93px;">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="mbr-header mbr-header--center mbr-header--std-padding">
                            <h2 class="mbr-header__text">CONFIGURACIÓN DEL SITIO</h2>
                        </div>

                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" name="siteconfig">
                          <?php if(!empty($success)): ?>
                             <div class="success"><?php echo $success; ?></div>
                          <?php endif; ?>

                            <div class="form-group">
                                <label for="sitename">Nombre del sitio:</label>
                                <input type="text" class="form-control" name="sitename" required="" placeholder="Sitename" value="<?php echo $siteconfig['sitename'];?>">
                            </div>
                            <div class="form-group">
                              <label for="maintenance">Mantenimiento: </label>
                              <select class="maintenance" name="maintenance">
                                 <?php if($siteconfig['maintenance'] == 0):?>
                                   <option value="0">Desactivado</option>
                                   <option value="1">Activar Mantenimiento</option>
                                 <?php else: ?>
                                   <option value="1">Activado</option>
                                   <option value="0">Desactivar Mantenimiento</option>
                                 <?php endif; ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="register">Registro de Usuarios: </label>
                              <select class="register" name="register">
                                 <?php if($siteconfig['register'] == 0):?>
                                   <option value="0">Desactivado</option>
                                   <option value="1">Activar Registro</option>
                                 <?php else: ?>
                                   <option value="1">Activado</option>
                                   <option value="0">Desactivar Registro</option>
                                 <?php endif; ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="activatehlogin">Login en el Header: </label>
                              <select class="activatehlogin" name="activatehlogin">
                                 <?php if($siteconfig['activatehlogin'] == 0):?>
                                   <option value="0">Desactivado</option>
                                   <option value="1">Activar</option>
                                 <?php else: ?>
                                   <option value="1">Activado</option>
                                   <option value="0">Desactivar</option>
                                 <?php endif; ?>
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="urlogo">Logo del sitio web:</label>
                                <input type="url" class="form-control" name="urlogo" placeholder="Url logo" value="<?php if(!empty($siteconfig['sitelogo'])) echo $siteconfig['sitelogo']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="sitedescription">Descripción del sitio web:</label>
                                <input type="text" class="form-control" name="sitedescription" required="" placeholder="Sitename" value="<?php if(!empty($siteconfig['sitedescription'])) echo $siteconfig['sitedescription']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="indexmessage">Mensaje de Bienvenida:</label>
                                <input type="text" class="form-control" name="indexmessage" required="" placeholder="Sitename" value="<?php if(!empty($siteconfig['indexmessage'])) echo $siteconfig['indexmessage']; ?>">
                            </div>
                            <div class="mbr-buttons mbr-buttons--right">
                               <input type="submit" class="mbr-buttons__btn btn btn-lg btn-danger" name="saveconfig" value="GUARDAR CONFIGURACIÓN">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smooth-scroll/SmoothScroll.js"></script>
  <!--[if lte IE 9]>
    <script src="assets/jquery-placeholder/jquery.placeholder.min.js"></script>
  <![endif]-->
  <script src="assets/mobirise/js/script.js"></script>
</body>
</html>
