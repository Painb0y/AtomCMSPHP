<?php 
  require 'core/core.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE-edge, chrome=1">
  <title><?php echo 'Error','-',$siteconfig['sitename']; ?></title>
  <meta name="description" content="La página que esta buscando no se encuentra disponible">
  <link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="style/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="style/css/style.css">
  <link rel="stylesheet" type="text/css" href="../style/css/style.css">
</head>
<body>
  <?php require 'core/templates/header.php'; ?>
    <article class="wrapper">
      <article class="content">
        <div class="wp">
              <div class="news">
                 <div class="title red"><h3>Error</h3></div>
                  <div class="wp-content">
                     <h2> 404 - La página que esta buscando no existe o no tienes permiso para acceder a ella.</h2>
                  </div>
              </div>
          </div>
      </article>
      </article>
    </article>
  <?php require 'core/templates/footer.php'; ?>
</body>
</html>
