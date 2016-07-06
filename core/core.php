<?php


// CONEXION A LA BASE DE DATOS
//////////////////////////////////////////////////////////////////////////////////////
  $_CONFIG = [
  'host' => 'localhost', //HOST
  'db' => 'central',     //DATABASE NAME
  'user' => 'root',      //PHPMYADMIN USER
  'pass' => '123',       //PHPMYADMIN PASSWORD
  'site' => 'http://localhost'  //SITE URL WITH HTTP
  ];
///////////////////////////////////////////////////////////////////////////////////////

// Realizamos la conexion a la base de datos con los configuracion anterior.
  try {
  	    $conexion = new PDO('mysql:host='
  	    	.$_CONFIG['host'] .';dbname='
  	    	. $_CONFIG['db'],
  	    	  $_CONFIG['user'],
  	    	  $_CONFIG['pass']);
  } catch(Exeption $e) {
  	   echo "Error: ",$e->getMessage();
  	   die();
  }


// Ejecutamos una consulta para traer toda la configuración del sitio.
  $siteconfig = $conexion->prepare('SELECT * FROM siteconfig');
  $siteconfig->execute();
  $siteconfig = $siteconfig->fetch();

// Ejecutamos una consulta para traer toda la información del usuario en caso de que este logeado.
  $user = $conexion->prepare('SELECT * FROM usuarios');
  $user->execute();
  $user = $user->fetch();

// Calculamos la cantidad de servidores que se mostrarán por página.
  $total = 5;
  $page = (!empty($_GET['pagina'])) ? (int)$_GET['pagina'] : 1 ;
  $serversForPage = ($page > 1) ? ($page * $total - $total) : 0 ;

// Ejecutamos una consulta para traer los hoteles registrados.
  $hotels = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM servers LIMIT $serversForPage, $total");
  $hotels->execute();
  $hotels = $hotels->fetchAll();

// Calculamos el total de paginas que habrán.
  $totalArticles = $conexion->query('SELECT FOUND_ROWS() AS total');
  $totalArticles = $totalArticles->fetch()['total'];

  $totalPages = ceil($totalArticles / $total);

// Almacenamos el mensaje de bienvenida del sitio en caso de que halla uno en la variable message.
  if (!empty($siteconfig['indexmessage'])) {
       $message = $siteconfig['indexmessage'];
  }

// Creamos una funcion para traer todas las noticias de la base de datos.

class Articles {

    private $news;

    public function getNews($conexion){
       $getNews = $conexion->prepare('SELECT SQL_CALC_FOUND_ROWS * FROM articles');
       $getNews->execute();
       $getNews = $getNews->fetch();

      return $getNews;
  }

    public function totalNews($conexion){
      $totalNews = $conexion->prepare('SELECT FOUND_ROWS() AS totalNews');
      $totalNews = $totalNews->fetch()['totalNews'];

       return $totalNews;
    } 
}


// Creamos una funcion para saber si un usuario ya tiene un hotel publicado
  function userHotels($conexion, $user){
    $ownerHotel = $conexion->prepare('SELECT * FROM servers WHERE owner = :owner');
    $ownerHotel->execute(array(':owner' => $user));
    $ownerHotel = $ownerHotel->fetch();

      return $ownerHotel;
  }

// Creamos una funcion para extraer la dirección ip real del usuario

  function getRealIp(){

if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
   {
      $ip = 
         ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
            $_SERVER['REMOTE_ADDR'] 
            : 
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
               $_ENV['REMOTE_ADDR'] 
               : 
               "unknown" );
 
      // los proxys van añadiendo al final de esta cabecera
      // las direcciones ip que van "ocultando". Para localizar la ip real
      // del usuario se comienza a mirar por el principio hasta encontrar 
      // una dirección ip que no sea del rango privado. En caso de no 
      // encontrarse ninguna se toma como valor el REMOTE_ADDR
 
      $entries = preg_split('/[, ]/', $_SERVER['HTTP_X_FORWARDED_FOR']);
 
      reset($entries);
      while (list(, $entry) = each($entries)) 
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
         {
            // http://www.faqs.org/rfcs/rfc1918.html
            $private_ip = array(
                  '/^0\./', 
                  '/^127\.0\.0\.1/', 
                  '/^192\.168\..*/', 
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/', 
                  '/^10\..*/');
 
            $found_ip = preg_replace($private_ip, $ip, $ip_list[1]);
 
            if ($ip != $found_ip)
            {
               $ip = $found_ip;
               break;
            }
         }
      }
   }
   else
   {
      $ip = 
         ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
            $_SERVER['REMOTE_ADDR'] 
            : 
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
               $_ENV['REMOTE_ADDR'] 
               : 
               "unknown" );
   }
 
   return $ip;
}


// Creamos una funcion para saber que rango tiene el usuario logeado.
  function userRank($conexion, $u){
    $statement = $conexion->prepare('SELECT * FROM usuarios WHERE user = :user');
    $statement->execute(array(':user'=> $u));
    $statement = $statement->fetch();

    return $statement['rank'];
  }

// Creamos una funcion para determinar si el usuario ya tiene una SESSION iniciada.
  function checkSession(){
    if (isset($_SESSION['user'])) {
         header('Location: index.php');
    }
  }

// Creamos una clase para generar el día, mes, año y fecha actual.
  class time{
     private $day;
     private $month;
     private $year;
     private $time;

      public function generateTime(){
        $this->day = date("d");
        $this->month = date("m");
        $this->year = date("Y");
        //$this->time = date('H').'/'.date('i').'/'.date('s');

        echo $this->year,'-',$this->month,'-',$this->day;
      }
  }

// Creamos una clase para generar un token de seguridad.
  class generateToken {
    private $n1;
    private $n2;
     public function parameterOne($n1) {
        $this->n1 = $n1;
        echo $n1;
         for ($i=1; $i <= 5 ; $i++) {
               echo rand($i, 7);
         }
     }

     public function parameterTwo($n2){
       $this->n2 = $n2;
       echo $n2;
         for ($i=1; $i <= 15 ; $i++) {
               echo rand($i, 9);
         }
     }
  }

?>
