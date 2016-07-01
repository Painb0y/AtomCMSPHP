<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 	  if (!empty($_POST['test'])) {
 	   echo $_POST['test'];
     }
 }
?>