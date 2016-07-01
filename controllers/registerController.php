<?php 

  require '/core/core.php';
  require_once "core/templates/libs/recaptchalib.php";

// Preguntamos si se ha dado click en el boton de registrar
  if (isset($_POST['register'])) {

    // Almacenamos los datos enviados
  	   $user = $_POST['rUser']; 
  	   $email = $_POST['rEmail'];
  	   $password = $_POST['rPassword'];
  	   $passwordConfirm = $_POST['rPasswordConfirm'];

    //Creamos una variable para almacenar errores.
  	   $errors = '';

    //Confirmamos que todos los datos hallan sido rellenados.
  	   if (empty($user) or empty($email) or empty($password) or empty($passwordConfirm)) {
  	   	    $errors .= '<li>Debes rellenar todos los campos</li>';
  	   } else {
        // Si todos los datos han sido rellenados procedemos a hacer las validaciones.
           // Aplicamos varios filtros al nombre de usuario para evitar errores de seguridad.
  	   	    $user = strtolower($user);
  	   	    $user = str_replace(' ', '', $user);
  	   	    $user = filter_var($user, FILTER_SANITIZE_STRING);


          //Determinamos los caracteres permitodos para el nombre de usuario.
  	   	    $allowChacters = 'abcdefghijklmnñopqrstvwxyzABCDEFGHIJKLMNÑOPQRSTVWXYZ0123456789-';
  	   	     for ($i=0; $i < strlen($user) ; $i++) { 
  	   	     	   if (strpos($allowChacters, substr($user,$i,1))===false) {
  	   	     	   	     $errors .= '<li>El nombre de usuario contiene carácteres no permitidos.</li>';
  	   	     	   	    return false;
  	   	     	   }
  	   	     }

          //Comprobamos que el nombre no tenga menos de 4 caracteres
  	   	     if (strlen($user) < 4) {
  	   	     	  $errors .= '<li>El nombre de usuario debe tener por lo menos 4 carácteres</li>';
  	   	     }

             // Comprobamos que las dos contraseñas coincidan y tengan mas de 6 caracteres.
  	   	       if ($password === $passwordConfirm && strlen($password) < 6 && strlen($passwordConfirm) < 6) {
  	   	             $errors .= "<li>La contraseña es demasiado corta.</li>"; 
  	             } elseif($password != $passwordConfirm) {
  	             	$errors .= "<li>Las contraseñas no coinciden.</li>";
  	             }

             // Ejecutamos una consulta a la base de datos para saber si el usuario ingresado ya se encuentra registrado.
  	   	     $searchUser = $conexion->prepare('SELECT * FROM usuarios WHERE user = :user LIMIT 1');
  	   	     $searchUser->execute(array(':user' => $user));
  	   	     $searchUser = $searchUser->fetch();

             // Si la consulta es diferente a false quiere decir que el usuario ya se encuentra registrado.
  	   	      if ($searchUser != false) {
  	   	      	   $errors .= '<li>El nombre de usuario ya se encuentra registrado.</li>';
  	   	      }

            // Ejecutamos una consulta a la base de datos para saber si el email ya se encuentra registrado
             $searchEmail = $conexion->prepare('SELECT * FROM usuarios WHERE email = :email LIMIT 1');
             $searchEmail->execute(array(':email' => $email));
             $searchEmail = $searchEmail->fetch();

             // Si la consulta es diferente a false quiere decir que el usuario ya se encuentra registrado.
              if ($searchEmail != false) {
                   $errors .= '<li>El email ya se encuentra registrado.</li>';
              }

            //Encryptamos las contraseñas dos veces.
  	   	     $password = hash('md5', $password);
  	   	     $password = hash('sha512', $password);

  	   	     $passwordConfirm = hash('md5', $passwordConfirm);
  	   	     $passwordConfirm = hash('sha512', $passwordConfirm);

             // Detectamos si el captcha ha sido enviado.
                if ($_POST["g-recaptcha-response"]) {
                        $response = $reCaptcha->verifyResponse(
                        $_SERVER["REMOTE_ADDR"],
                        $_POST["g-recaptcha-response"]
                         );
                }

         // Si el captcha ha sido enviado validamos que no halla errores para insertar el usuario.
         if ($response != null && $response->success) {

             // En caso de que no halla errores insertamos el usuario a la base de datos.
  	   	     if (!$errors) {

               //Creamos una variable para determinar la fecha actual y pasarla a la base de datos como fecha de registro del usuario. 
  	   	     		$time = date("d").'-'.date("m").'-'.date("Y");
  	   	     	
  	   	     	$insertUser = $conexion->prepare('INSERT INTO usuarios (id,user,email,password,rank,photo,fecha) VALUES(null,:user,:email,:password,:rank,:photo,:fecha)');
  	   	     	$insertUser->execute(array(':user' => $user, ':email' => $email, ':password' => $password, ':rank' => 1, ':photo' => 'https://www.servicewiz.com/swizz/resources/images/no-user-img.png	', ':fecha' => $time));

              //Creamos una session para redirigirlo a check.php por seguridad.
                  session_start();

                  $_SESSION['user'] = $user;
                  $_SESSION['password'] = $password;

                  header('Location: check.php');
                
                   
  	   	     }
         } else {
             $errors .= '<li>Debes introducir el captcha.</li>';
         }

  	   }
  }
?>