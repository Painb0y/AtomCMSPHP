<?php 
  require 'controllers/registerController.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE-edge, chrome=1">
	  <title><?php echo 'Registrarse',' - ',$siteconfig['sitename']; ?></title>
    <meta name="description" content="Registrate ahora para obtener más beneficios">
	  <link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="style/css/font-awesome.min.css">
	  <link rel="stylesheet" type="text/css" href="style/css/style.css">
</head>
<body>
  <?php require 'core/templates/header.php'; $userInfo = new UserInfo(); $userInfo->checkSession(); ?>
    <article class="wrapper">
    	<article class="content">
         <div class="wp">
              <div class="news">
                 <div class="title"><h3>Formulario de Registro</h3></div>
                   <div class="wp-content">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" name="register">

                      <label for="user"><i class="fa fa-user-plus" aria-hidden="true"></i></label>
                      <input class="control form register" type="text" name="rUser" placeholder="Nombre de usuario" required autocomplete="off" value="<?php if(!empty($errors) && !empty($_POST['rUser'])): echo $_POST['rUser'] ?><?php endif;?>">

                      <label for="email"><i class="fa fa-envelope" aria-hidden="true"></i></label>
                      <input class="control form register" type="email" name="rEmail" placeholder="Email" required autocomplete="off" value="<?php if(!empty($errors) && !empty($_POST['rEmail'])): echo $_POST['rEmail'];?><?php endif;?>">

                      <label for="password"><i class="fa fa-key" aria-hidden="true"></i></label>
                      <input class="control form register" type="password" name="rPassword" placeholder="Contraseña" required autocomplete="off" value="">

                      <label for="password"><i class="fa fa-key" aria-hidden="true"></i></label>
                      <input class="control form register" type="password" name="rPasswordConfirm" placeholder="Repetir Contraseña" required autocomplete="off" required autocomplete="off" value="">

                      <div class="g-recaptcha" data-sitekey="6LdJeyMTAAAAAC1wOrJxzLd2T5gShMaeD8EZzhXr"></div>

                      <input class="control register button" type="submit" name="register" required autocomplete="off" onclick="register.submit()" value="Registrarse">

                      <a href="login"><input class="control register button two" type="button" value="Login"></a>

                       <?php if (!empty($errors)): ?>
                          <div class="errors"><?php echo $errors;?></div>
                       <?php endif;?>
                     </form>
                   </div>                   
               </div>
         </div>
      </article>
      <aside>
         <div class="wp-aside">
            <div class="title bluestrong"><h3>Ventajas de tener una cuenta:</h3></div>
              <div class="wp-content">

              </div>
         </div>
      </aside>    		
    	</article>
    </article>
  <?php require 'core/templates/footer.php'; ?>
  <script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
</body>
</html>