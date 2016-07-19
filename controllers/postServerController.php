<?php
  require 'core/core.php';


 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $errors = '';

   if (empty($_POST['hotel']) or empty($_POST['url']) or empty($_POST['hoteltype'])) {
        $errors .= '<li>Debes ingresar todos los datos de tú hotel.</li>';
   } else {
        $name = filter_var($_POST['hotel'], FILTER_SANITIZE_STRING);
        $banner = $_POST['banner'];
        $date = date('d').'-'.date('m').'-'.date('Y');
        $type = $_POST['hoteltype'];
        $url = $_POST['url'];
        $description = $_POST['description'];

           $banner = str_replace('<>?;', '', $banner);
           $url = str_replace('<>?;', '', $url);

      $allowChacters = '.,abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789áéíóúÁÉÍÓÚ-[]/!¡+ ';
            for ($i=0; $i < strlen($name) ; $i++) {
                if (strpos($allowChacters, substr($name,$i,1))===false) {
                      $errors .= '<li>El nombre del hotel contiene caracteres no permitodos.</li>';
                     return false;
                }
            }

           $searchUrl = $conexion->prepare('SELECT * FROM servers WHERE url = :url LIMIT 1');
           $searchUrl->execute(array(':url' => $url));
           $searchUrl = $searchUrl->fetch();

              if ($searchUrl != false) {
                   $errors = '<li>El hotel ya se encuentra registrado.</li>';
              }

          if (empty($banner)) {
               $banner = '../../style/img/banner.png';
          }

          if (!$errors) {

            session_start();

                 $owner = $_SESSION['user'];

               $insertHotel = $conexion->prepare('INSERT INTO servers (id,name,banner,dtime,type,url,description,owner)
               VALUES(null,:name,:banner,:dtime,:type,:url,:description,:owner)');
               $insertHotel->execute(array(':name' => $name, ':banner' => $banner,
               ':dtime' => $date, ':type' => $type, ':url' => $url, 'description' => $description, 'owner' => $owner));

               header('Location: servers');
          }
   }
 }
?>
