<?php 
  require 'controllers/loginController.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE-edge, chrome=1">
	<title><?php echo 'Login',' - ',$siteconfig['sitename']; ?></title>
  <meta name="description" content="Iniciar sesión">
	<link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="style/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style/css/style.css">
</head>
<body>
  <?php require 'core/templates/header.php'; checkSession();?>
    <article class="wrapper">
    	<article class="content">
        <div class="wp">
              <div class="news">
                 <div class="title green"><h3>Iniciar Sesion</h3></div>
                 <div class="wp-content">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" name="register">

                      <label for="user"><i class="fa fa-user-plus" aria-hidden="true"></i></label>
                      <input class="control form register" type="text" name="user" placeholder="Nombre de usuario" required autocomplete="off" value="<?php if(!empty($errors) && !empty($_POST['user'])): echo $_POST['user'];?><?php endif;?>">

                      <label for="password"><i class="fa fa-key" aria-hidden="true"></i></label>
                      <input class="control form register" type="password" name="password" placeholder="Contraseña" required autocomplete="off" value="">

                      <input class="control register button" type="submit" name="register" required autocomplete="off" value="Entrar" onclick="headerlog.submit()">

                      <?php if (!empty($errors)): ?>
                         <div class="errors-login"><?php echo $errors;?></div>
                      <?php endif;?>
                    </form>
                  </div>                
              </div>
          </div>
      </article>
      <aside>
         <div class="wp-aside">
            <div class="title withe"><h3>Hoteles más votados</h3></div>
              <div class="wp-content">

              </div>
         </div>
      </aside>    		
    	</article>
    </article>
  <?php require 'core/templates/footer.php'; ?>
</body>
</html>