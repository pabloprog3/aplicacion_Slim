<?php

//Importar el framework
require './slim/slim/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

//instanciar slim
$app = new \Slim\Slim();

define("SPECIALCONSTANT", true);

require 'app/libs/conectarDB.php';
require 'app/routes/api.php';
//include_once '../clases/Personas.php';


//correr la aplicacion
$app->run();








?>