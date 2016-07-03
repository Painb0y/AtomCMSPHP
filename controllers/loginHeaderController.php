<?php
session_start(); 
  // Preguntamos si se han enviado datos por POST
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

       // Creamos una variable para almacenar errores.
  	    $errores = '';

        // Comprobamos que el usuario y contraseña hallan sido enviados.
  	    if (!empty($_POST['user']) && !empty($_POST['password'])) {

        // Almacenamos los datos enviados.
        $user = $_POST['user'];
        $password = $_POST['password'];

          //Aplicamos los mismos filtros utilizados en el registro para el usuario y así hacer que el usuario ingresado coinsida con el de la base de datos en caso de que exista.
  	    	  $user = strtolower($user);
  	   	    $user = str_replace(' ', '', $user);
  	   	    $user = filter_var($user, FILTER_SANITIZE_STRING);

            //Encryptamos la contraseña dos veces.
  	   	    $password = hash('md5', $password);
  	   	    $password = hash('sha512', $password);

            // Ejecutamos una consulta para saber si los datos ingresados coinciden con los de algun usuario en la base de datos.
  	   	    $searchUser = $conexion->prepare('SELECT * FROM usuarios WHERE user = :user AND password = :password LIMIT 1');
  	   	    $searchUser->execute(array(':user' => $user, ':password' => $password));
  	   	    $searchUser = $searchUser->fetch();

            // Si el resultado de la consulta es false quiere decir que el usuario no existe.
  	   	    if ($searchUser == false) {
  	   	    	  $errores .= '<li>El usuario o la contraseña son incorrectos.</li>';
  	   	    } else {
               // Si no hay errores creamos una SESSION de usuario.
  	   	    	  if (!$errores) {

  	   	    	  	   session_start();

  	   	    	  	   $_SESSION['user'] = $user;
  	   	    	  	   $_SESSION['password'] = $password;

  	   	    	  	   header('Location: index');
  	   	    	  }
  	   	    }
  	    }
  }
?>
