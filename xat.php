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
    	<article class="content xat">
          <div class="wp">
    		      <div class="news">
                 <div class="title greystrong"><h3>Xat</h3></div>
                  <div class="wp-content">
                    <div class="xat code">
                        <figure>
                          <embed wmode="transparent" src="http://www.xatech.com/web_gear/chat/chat.swf" quality="high" width="540" height="405" name="chat" FlashVars="id=217751808" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://xat.com/update_flash.php" /><br><small><a target="_BLANK" href="http://xat.com/web_gear/?cb">Get your own Chat Box!</a> <a target="_BLANK" href="http://xat.com/web_gear/chat/go_large.php?id=217751808">Go Large!</a></small><br>
                        </figure>
                    </div>
                  </div>
              </div>
          </div>
    	</article>
      <aside class="xat-page">
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