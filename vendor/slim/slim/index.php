<?php

//impoartar el framework
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

//instanciar una aplicacion Slim
$app = new \Slim\Slim();

define("SPECIALCONSTANT", true);

//require_once '../../app/libs/conexionPDO.php';
require_once '../../app/routes/api.php';










//ejecutar la aplicacion
$app->run();