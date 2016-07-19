<?php
  require '../controllers/loginHkController.php';

  $userInfo = new userInfo();

  if (isset($_SESSION['user']) && $userInfo->userRank($conexion, $_SESSION['user']) < 3) {
       header('Location: ../error');
  } elseif(!isset($_SESSION['user'])) {
       header('Location: ../error');
  }

  if (isset($_SESSION['huser'])) {
        header('Location: index.php');
  }
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
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	  <link rel="stylesheet" href="/style/css/font-awesome.min.css">
	  <link rel="stylesheet" type="text/css" href="styles/css/style.css">
</head>
<body>
    <article class="wrapper hk">
       <div class="modal-dialog">
         	<div class="loginmodal-container">
         			 <h2>Login - Panel de Control</h2><br>
      			   <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="hklogin">
       			     <input class="login-text" type="text" name="hkuser" placeholder="Username">
       			     <input class="login-password" type="password" name="hkpass" placeholder="Password">
       			     <input type="submit" name="login" class="loginmodal-submit" value="Login" onclick="hklogin.submit()">

                 <?php if (!empty($errors)): ?>
                   <div class="errors-login"><?php echo $errors;?></div>
                 <?php endif;?>
         		  </form>
           </div>
        </div>
    </article>
</body>
</html>
