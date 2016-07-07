<?php
require '/controllers/loginHeaderController.php';
 $userInfo = new userInfo();
?>
<header class="header" style="background-image: url(<?php echo $siteconfig['headerimg']?>); background-repeat: no-repeat; ">

  <?php if(!empty($siteconfig['sitelogo'])): ?>
     <div class="logo"><a href="<?php echo $_CONFIG['site'];?>"><img src="<?php echo $siteconfig['sitelogo'];?>" width="370px" height="140px"></img></a></div>
  <?php endif;?>

  <?php if(!empty($siteconfig['name']) && empty($siteconfig['sitelogo'])): ?>
      <div class="nametext"><a href="<?php echo $_CONFIG['site'];?>"><h1><?php echo $siteconfig['name'];?>"</h1></a></div>
  <?php endif;?>

   <?php if($siteconfig['activatehlogin'] == 1 && !isset($_SESSION['user'])): ?>
         <div class="login">
  	       <div class="login form header">
  		         <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="headerlog">
  		             <i class="fa fa-user" aria-hidden="true"></i>
  			           <input class="user green"type="text" name="user" placeholder="Usuario" id="user">
  
  			           <i class="fa fa-lock" aria-hidden="true"></i>
  			           <input class="user red" type="password" name="password" placeholder="Contraseña">

  			           <input class="quesession"type="checkbox" name="session">
  			           <label class="label-quesession" for="session">Mantener Conectado</label>

  			           <i class="fa fa-arrow-right" aria-hidden="true" onclick="headerlog.submit()"></i>
  		         </form>
  	       </div>
         </div>
    <?php endif;?>
</header>
<div class="menu_bar">
    <a href="#" class="bt-menu"><i class="fa fa-list" aria-hidden="true"></i>Menu</a>
</div>
<nav>
  <ul>
  	<li class="red"><a href="index"><i class="fa fa-home" aria-hidden="true"></i>Inicio</a></li>
  	<li class="xat blue"><a href="xat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>xat</a></li>
  	<li class="green"><a href="servers"><i class="fa fa-server" aria-hidden="true"></i>Servidores</a></li>
  	<li class="orange"><a href="postserver"><i class="fa fa-plus" aria-hidden="true"></i>Publicar Servidor</a></li>
  	<li class="purple"><a href="tools"><i class="fa fa-paper-plane" aria-hidden="true"></i>Herramientas</a></li>

    <?php if(!isset($_SESSION['user'])): ?>
  	    <li><a href="login"><i class="fa fa-sign-in" aria-hidden="true"></i>Iniciar sesión</a></li>
  	    <li><a href="register">Registrarme</a></li>
    <?php endif; ?>

    <?php if(isset($_SESSION['user']) && $userInfo->userRank($conexion, $_SESSION['user']) >= '3'): ?>
        <li><a class="adm" href="acp/index.php" target="_blank"><i class="fa fa-rocket" aria-hidden="true"></i>Administración</a></li>
    <?php endif; ?>

    <?php if(isset($_SESSION['user'])): ?>
        <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Cerrar Sesión</a></li>
    <?php endif; ?>
  </ul>
</nav>
