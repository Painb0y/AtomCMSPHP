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

// Realizamos la conexion a la base de datos con la configuracion anterior.
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

session_start();

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

// Creamos una clase para buscar usuarios en la base de datos
class Statement {

   protected $conexion;
   protected $user;
   protected $password;

   public function searchUser($c, $u, $p){

      $this->conexion = $c;
      $this->user = $u;
      $this->password = $p;

     $searchUser = $this->conexion->prepare('SELECT * FROM usuarios WHERE user = :user AND password = :password LIMIT 1');
     $searchUser->execute(array(':user' => $this->user, ':password' => $this->password));
     $searchUser = $searchUser->fetch();

      return $searchUser;
   }
}

// Creamos una clase para traer información de noticas y servidores.

class PostInfo {

    protected $conexion;

    public function getArticleInfo($c) {
      $this->conexion = $c;

      if (!empty($_GET['article'])) {

        $articleId = (int)$_GET['article'];

        $getArticleInfo = $this->conexion->prepare('SELECT * FROM articles WHERE id = :id LIMIT 1');
        $getArticleInfo->execute(array(':id' => $articleId));
        $getArticleInfo = $getArticleInfo->fetch();

        if ($getArticleInfo == false) {
              header('Location: error');
        }
         return $getArticleInfo;
      }
    }

    public function getServerInfo($c){
        $this->conexion = $c;

        $serverId = (int)$_GET['server'];

        $getServerInfo = $this->conexion->prepare('SELECT * FROM servers WHERE id = :id LIMIT 1');
        $getServerInfo->execute(array(':id' => $serverId));
        $getServerInfo = $getServerInfo->fetch();

        if ($getServerInfo == false) {
              header('Location: error');
        }
         return $getServerInfo;
      }

  }


  class GetRanks {
    protected $conexion;

     public function ranks($c){
       $this->conexion = $c;

       $ranks = $this->conexion->prepare('SELECT SQL_CALC_FOUND_ROWS * FROM ranks');
       $ranks->execute();
       $ranks = $ranks->fetchAll();

       $totalRanks = $this->conexion->query('SELECT FOUND_ROWS() AS totalRanks');
       $totalRanks = $totalRanks->fetch()['totalRanks'];
       $totalRanks = $totalRanks + 1;

        foreach ($ranks as $rank) {
         echo "<option value='",$rank['id'],"'>",$rank['name'],"</option>";
       }
     }
  }

// Creamos una clase para extraer las noticias de la base de datos.

class Articles {

    private $conexion;
    private $amout;

    public function getNews($c,$a){
      $this->conexion = $c;
      $this->amout = $a;

       $getNews = $this->conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM articles");
       $getNews->execute();
       $getNews = $getNews->fetchAll();

       $totalNews = $this->conexion->query('SELECT FOUND_ROWS() AS totalNews');
       $totalNews = $totalNews->fetch()['totalNews'];

       $ultimaNews = ($totalNews >= $this->amout) ? ($totalNews - $this->amout) : 0 ;

        $getUltimateNews = $this->conexion->prepare("SELECT * FROM articles LIMIT $ultimaNews,$this->amout");
        $getUltimateNews->execute();
        $getUltimateNews = $getUltimateNews->fetchAll();
        $getUltimateNews = array_reverse($getUltimateNews);

        foreach ($getUltimateNews as $news) {

            if (!empty($news['articleimg'])) {
                 $img = "<img src='".$news['articleimg']."'></img>";
            } else {
                 $img = "<img src='../style/img/defaultArticleImg.jpg'></img>";
            }

             echo "<a href='post?article=",$news['id'],"'><div class='news img'><div class='url image'>",$img,"</div></div></a>",
             "<a href='post?article=",$news['id'],"'><div class='news info'><div class='news tit'>",$news['title'],"</div></a>",
             "<div class='news content'>",substr($news['content'], 0,150),"...</div>",
             "<div class='news datetime'>",substr($news['datetime'],0,10),"</div>",
             "<a href='post?article=",$news['id'],"'><div class='news more'><h5>Leer más</h5></div></a></div>";
         }
      }
}



// Creamos una funcion para extraer la dirección ip real del usuario


// Creamos una clas para extraer toda la información del usuario

class UserInfo {

         private $conexion;

         // Creamos una funcion para saber que rango tiene el usuario logeado.
         public function userRank($c, $u){
           $this->conexion = $c;

           $statement = $this->conexion->prepare('SELECT * FROM usuarios WHERE user = :user');
           $statement->execute(array(':user'=> $u));
           $statement = $statement->fetch();

              return (int)$statement['rank'];
         }


         // Creamos una funcion para saber si un usuario ya tiene un hotel publicado

         public function userHotels($c, $user){
           $this->conexion = $c;

             $ownerHotel = $this->conexion->prepare('SELECT * FROM servers WHERE owner = :owner');
             $ownerHotel->execute(array(':owner' => $user));
             $ownerHotel = $ownerHotel->fetch();

               return $ownerHotel;
         }

        // Creamos una funcion para determinar si el usuario ya tiene una SESSION iniciada.
          public function checkSession(){
            if (isset($_SESSION['user'])) {
                 header('Location: index.php');
            }
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

  // Creamos una variable para almacenar los errores.
  $errors = '';

  // Creamos una variable para almacenar los mensajes existosos
  $success = '';


  if(isset($_POST['saveconfig'])){
       $sitename = $_POST['sitename'];
       $maintenance = $_POST['maintenance'];
       $register = $_POST['register'];
       $sitelogo = $_POST['urlogo'];
       $sitedescription = $_POST['sitedescription'];
       $activatehlogin = $_POST['activatehlogin'];
       $indexmessage = $_POST['indexmessage'];

       echo $maintenance;
       if (!empty($sitename) or !empty($maintenance) or !empty($register) or !empty($sitelogo) or !empty($sitedescription) or !empty($indexmessage)) {
            $updateConfig = $conexion->prepare('UPDATE siteconfig SET
                sitename = :sitename,
                maintenance = :maintenance,
                register = :register,
                sitelogo = :sitelogo,
                sitedescription = :sitedescription,
                activatehlogin = :activatehlogin,
                indexmessage = :indexmessage
              ');

            $updateConfig->execute(array(
              ':sitename' => $sitename,
              ':maintenance' => $maintenance,
              ':register' => $register,
              ':sitelogo' => $sitelogo,
              ':sitedescription' => $sitedescription,
              ':activatehlogin' => $activatehlogin,
              ':indexmessage' => $indexmessage
            ));



            if ($updateConfig != false) {
              $success .= '<li>Se ha actualizado la configuración del sitio.</li>';
              header('Location: siteconfig.php');
            }

       }
  }

if (isset($_POST['saverank'])) {
     $userName = $_POST['username'];
     $rank = $_POST['rank'];
     $userInfo = new userInfo();

     $userName = strtolower($userName);
     $userName = str_replace(' ', '', $userName);
     $userName = filter_var($userName, FILTER_SANITIZE_STRING);

     if ($userInfo->userRank($conexion, $_SESSION['user']) <= 3) {
       $errors .= '<li>No tienes permiso para modificar rangos.</li>';
     } else {
         if (empty($userName) or empty($rank)) {
               $errors .= '<li>Debes ingresar todos los datos</li>';
         }

         $searchUserRegister = $conexion->prepare('SELECT * FROM usuarios WHERE user = :user LIMIT 1');
         $searchUserRegister->execute(array(':user' => $userName));
         $searchUserRegister = $searchUserRegister->fetch();

         if($searchUserRegister == false) {
           $errors .= '<li>El usuario no existe</li>';
         }

         if (!$errors) {
           $updateRank = $conexion->prepare('UPDATE usuarios SET rank = :rank WHERE user = :user');
           $updateRank->execute(array(':rank' => $rank, ':user' => $userName));
           $success .= '<li>Se ha modificado el rango con éxito.</li>';
         }
    }
}
?>
