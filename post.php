<?php
  require 'core/core.php';
  $getPostInfo = new PostInfo();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE-edge, chrome=1">
	  <title><?php echo $getPostInfo->getArticleInfo($conexion)['title'],' - ',$siteconfig['sitename']; ?></title>
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
    		     <div class="news">
               <?php if(!empty($_GET['article'])): ?>
                <div class="title article">
                  <h3><?php echo strtoupper($getPostInfo->getArticleInfo($conexion)['title']);?></h3>
                </div>
                <div class="wp-content">
                  <div class="article-img">
                    <img src="<?php echo $getPostInfo->getArticleInfo($conexion)['articleimg'];?>"></img>
                  </div>
                  <div class="article-datetime">
                    <?php
                     $dateTime = $getPostInfo->getArticleInfo($conexion)['datetime'];
                     echo  'Fecha de Publicación: ',substr($dateTime, 0,15);
                    ?>
                  </div>
                  <div class="article-content">
                    <?php echo '<p>',$getPostInfo->getArticleInfo($conexion)['content'],'</p>';?>
                  </div>
                  <div class="article-author">
                    <?php if(!empty($getPostInfo->getArticleInfo($conexion)['author'])): ?>
                      <?php echo "<div class='owner'>Autor: </div> ",$getPostInfo->getArticleInfo($conexion)['author'];?>
                   <?php else: ?>
                      <?php echo "<div class='owner'>Autor: Unknown</div>"?>
                    <?php endif; ?>
                  </div>
                  <div class="article-tags">
                    <?php
                      echo '<b>TAGS:</b> ',strtoupper($getPostInfo->getArticleInfo($conexion)['tags']);
                     ?>
                   </div>
               </div>
           </article>
           <aside>
            <div class="wp-aside">
             <div class="title yellow"><h3>Hoteles más votados</h3></div>
               <div class="wp-content">

               </div>
             </div>
             <div class="title grey"><h3>Publicidad</h3></div>
               <div class="wp-content">

               </div>
             </div>
             <div class="title blue"><h3>Más Noticias</h3></div>
               <div class="wp-content">

               </div>
             </div>
           </aside>
         </article>
                <?php elseif(!empty($_GET['server'])): ?>
                    <div class="title server">
                      <h3><?php echo strtoupper($getPostInfo->getServerInfo($conexion)['name']);?></h3>
                    </div>
                    <div class="wp-content">
                       <div class="server-img">
                         <img src="<?php echo $getPostInfo->getServerInfo($conexion)['banner'];?>"></img>
                       </div>
                       <div class="server-datetime">
                         <?php
                           $dateTime = $getPostInfo->getServerInfo($conexion)['dtime'];
                           echo  'Fecha de Publicación: ',substr($dateTime, 0,15);
                         ?>
                       </div>
                       <div class="server-content">
                         <?php echo '<p>',$getPostInfo->getServerInfo($conexion)['description'],'</p>';?>
                       </div>
                       <div class="server-owner">
                         <?php echo "<div class='owner'>Publicado por: </div> ",$getPostInfo->getServerInfo($conexion)['owner'];?>
                       </div>
                     </div>
                 </div>
            </article>
             <aside>
              <div class="wp-aside">
               <div class="title yellow"><h3>Entrar al Servidor</h3></div>
                 <div class="wp-content">
                   <a href="<?php echo $getPostInfo->getServerInfo($conexion)['url']?>" target="_blank"><div class="server button"><h4>Entrar</h4></div></a>
                 </div>
               </div>
               <div class="title red"><h3>Votar</h3></div>
                 <div class="wp-content">

                 </div>
               </div>
             </aside>
           </article>
                <?php endif; ?>
  <?php require 'core/templates/footer.php'; ?>
</body>
</html>
