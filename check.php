<?php 
  if (isset($_SESSION['user'])) {
  	   header('Location: register');
  } else {
  	  header('Location: index');
  }
?>