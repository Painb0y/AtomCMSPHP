<?php
  require '../core/core.php';


  $errors = '';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

         if (!empty($_POST['hkuser']) && !empty($_POST['hkpass'])) {
               $user = $_POST['hkuser'];
               $pass = $_POST['hkpass'];

               $user = str_replace(' ', '', $user);
               $user = strtolower($user);
               $user = filter_var($user, FILTER_SANITIZE_STRING);

               $pass = hash('md5', $pass);
               $pass = hash('sha512', $pass);

               $statement = new Statement();

               if ($statement->searchUser($conexion,$user,$pass) == false) {
                      $errors .= '<li>El usuario o la contraseña son incorrectos</li>';
               }

               $userInfo = new userInfo();

               if ($userInfo->userRank($conexion, $user) < 3) {
                     $errors .= '<li>No tienes permiso para acceder al panel de control.</li>';
               } elseif ($userInfo->userRank($conexion, $user) >= 3 && $user != $_SESSION['user']) {
                     $errors .= '<li>Sólo puedes iniciar sesión con tú cuenta actual.</li>';
               }

               if(!$errors){
                     $_SESSION['huser'] = $user;
                     $_SESSION['hpass'] = $pass;

                     header('Location: index.php');
               }
         }
    }
?>
