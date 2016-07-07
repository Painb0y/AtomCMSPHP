<?php 
  require 'core/core.php';       
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE-edge, chrome=1">
	<title><?php echo $siteconfig['sitename'],' - ',$siteconfig['sitedescription']; ?></title>
  <meta name="description" content="<?php echo $siteconfig['sitedescription'];?>">
	<link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style/css/style.css">
</head>
<body> 
  <?php require 'core/templates/header.php'; ?>
    <article class="wrapper">
    	<article class="content">
          <div class="wp">
               <?php if(!empty($message)): ?>
                 <div class="title">
                   <h3>¡Bienvenid@ a <?php echo $siteconfig['sitename'];?></h3>
                 </div>
                     <div class="wp-content">
                       <div class="message">
                         <?php echo '<p>',$message,'</p>';?>
                       </div>
                     </div>
               <?php endif;?>
    		         <div class="news">
                    <div class="title red"><h3>Noticias</h3></div>
                     <div class="wp-content">
                      <?php 
                        $noticias = new Articles();
                        $noticias->getNews($conexion,5);
                      ?>
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
  <?php require 'core/templates/footer.php'; ?>
</body>
</html>