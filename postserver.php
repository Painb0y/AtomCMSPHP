<?php
  require 'controllers/postServerController.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE-edge, chrome=1">
	<title><?php echo 'Publica tu Habbo Holo',' - ',$siteconfig['sitename']; ?></title>
  <meta name="description" content="Tienes un habbo holo?, publicalo ahora y consigue más usuarios.">
	<link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="style/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style/css/style.css">
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>
  <?php require 'core/templates/header.php'; ?>
    <article class="wrapper">
    	<article class="content">
    		  <div class="wp">
              <div class="news">
                 <div class="title blue"><h3>Publicar tú Hotel</h3></div>
                  <div class="wp-content">
                   <?php if(isset($_SESSION['user'])): ?>

                        <?php $owner = $_SESSION['user'];
                            $ownerHotel = $conexion->prepare('SELECT * FROM servers WHERE owner = :owner');
                            $ownerHotel->execute(array(':owner' => $owner));
                            $ownerHotel = $ownerHotel->fetch(); if($ownerHotel != false): 
                        ?>
                                 <div class="errors-postserver">
                                     <h4>Solo puedes publicar un servidor - &nbsp;&nbsp;&nbsp; <a href="perfil?page=myservers">Modificar Publicación</a></h4>
                                 </div>

                  <?php else: ?>

                   <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" name="postServer">

                     <i class="fa fa-h-square" aria-hidden="true"></i>
                     <input type="text" required autocomplete="off" name="hotel" placeholder="Nombre de tú hotel" value="<?php if(!empty($errors) && !empty($_POST['hotel'])) echo $_POST['hotel']; ?>">
                     <label for="hotel">Este será el nombre que se mostrara en el top</label>

                     <i class="fa fa-link" aria-hidden="true"></i>
                     <input type="url" required autocomplete="off" name="url" placeholder="Url del sitio" value="<?php if(!empty($errors) && !empty($_POST['url'])) echo $_POST['url']; ?>">

                     <label for="url">Introduce la url de tú hotel</label>

                     <select class="hoteltype" required autocomplete="off" name="hoteltype">
                        <option value="Holo">Holo</option>
                        <option value="Retro">Retro</option>
                     </select>
                     <label for="hoteltype">Introduce el tipo de servidor</label>

                     <i class="fa fa-picture-o" aria-hidden="true"></i>
                     <input type="url"  name="banner" placeholder="Banner 664 x 129" value="<?php if(!empty($errors) && !empty($_POST['banner'])) echo $_POST['banner']; ?>">
                     <label for="hoteltype">Introduce la url de tú banner para el top</label>

                     <textarea name="description"></textarea>

                      <input class="control register button"  type="submit" name="post" value="Publicar">

                      <?php if (!empty($errors)): ?>
                         <div class="errors"><?php echo $errors;?></div>
                      <?php endif;?>

                    </form>

                    <?php endif; ?>

                    <?php else: ?>
                      <div class="errors-postserver"><p><h3>Debes estar registrado para poder publicar tú Habbo Hotel, <a href="register">Click Aquí para registrarte<a/> o <a href="login">Inicia sesión</a></h3></p></div>
                    <?php endif; ?>
                   R
                  </div>
              </div>
          </div>
      </article>
      <aside>
         <div class="wp-aside">
            <div class="title yellow"><h3>Hoteles más votados</h3></div>
              <div class="wp-content">

              </div>
         </div>
      </aside>
    	</article>
    </article>
  <?php require 'core/templates/footer.php'; ?>
</body>
</html>
