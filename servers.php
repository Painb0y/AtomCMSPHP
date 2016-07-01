<?php 
  require 'core/core.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE-edge, chrome=1">
	  <title><?php echo 'Los mejores Habbo Holos',' - ',$siteconfig['sitename']; ?></title>
    <meta name="description" content="Lista de los mejores habbo holos o servidores de habbo, los hoteles más populares los encontraras aquí">
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
                 <div class="title bluestrong"><h3>Lista de servidores</h3></div>
                  <div class="wp-content">

                     <?php foreach($hotels as $server): ?>
                       <div class="data-servers">
                         <div class="server-desp">
                              <div class="data">
                              <div class="status">
                             <?php $site = $server['url']; $online = @fsockopen($site, 80); if ($online):  ?>
                                  <div class="online"><img src="style/img/on.gif" width="200px" height="50px"></div>
                             <?php else: ?>
                                  <div class="offline"><img src="style/img/off.gif" width="200px" height="50px"></div>
                             <?php endif;?>
                                <ul>
                                  <li class="type"><?php echo $server['type']; ?></li>
                                  <li class="name"><a href="server.php?id=<?php echo $server['id'];?>" target="_blank"><?php echo strtoupper($server['name']); ?></a></li>
                                </ul>
                              </div>
                              <div class="server-img">
                                 <a href="server.php?id=<?php echo $server['id'];?>" target="_blank">
                                   <img src="<?php echo $server['banner']; ?>">
                                 </a>
                              </div>
                            </div>
                         </div>
                       </div>
                     <?php endforeach; ?>
                     <ul>
                     <?php if($page == 1): ?>
                        <li class="disabled">&laquo;</li>
                     <?php else: ?>
                        <li class="listservers"><a href="?pagina=<?php echo $page - 1;?>">&laquo;</a></li>
                     <?php endif; ?>    
                     
                     <?php 

                         for ($i=1; $i <= $totalPages ; $i++) {  
                            if ($page === $i) {
                                echo "<li class='active'><a href='?pagina=$i'>$i</a></li>";
                            } else {
                            echo "<li class='listservers'><a href='?pagina=$i'>$i</a></li>";
                            }
                          }

                       
                     ?>
                     <?php if($page == $totalPages): ?>
                        <li class="disabled">&raquo;</li>
                     <?php else: ?>
                        <li class="listservers"><a href="?pagina=<?php echo $page + 1;?>">&raquo;</a></li>
                     <?php endif; ?>
                    </ul>  
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