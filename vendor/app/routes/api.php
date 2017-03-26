<?php

require_once '../../app/libs/conexionPDO.php';

if (!defined("SPECIALCONSTANT")) {
	die("Acceso denegado");
}

//acceder desde http://localhost:8080/aplicacion_Slim/vendor/slim/slim/clientes/listado
$app->get("/clientes/listado", function () use($app)
{
	$dbPDO = new ConexionPDO();
	$conn = $dbPDO->getConexion();
	$dbQuery = $conn->prepare("select * from clientes");
	$dbQuery->execute();
	$clientes = $dbQuery->fetchAll(PDO::FETCH_ASSOC); //traigo los datos
	//var_dump($clientes);
	$conn = null;



	$app->response->headers->set("Content-Type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($clientes));

});

//ejemplo: http://localhost:8080/aplicacion_Slim/vendor/slim/slim/clientes/2
$app->get("/clientes/(:id)", function ($id) use($app)
{
	$dbPDO = new ConexionPDO();
	$conn = $dbPDO->getConexion();
	$dbQuery = $conn->prepare("select * from clientes where id=:id");
	$dbQuery->bindParam(":id", $id);
	$dbQuery->execute();
	$clientes = $dbQuery->fetchAll(PDO::FETCH_ASSOC); //traigo los datos
	 
	$conn = null;

	$app->response->headers->set("Content-Type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($clientes));

});


$app->post("/clientes/agregar/", function() use($app){

	$dni = $app->request->post("dni");
	$nombre = $app->request->post("nombre");
	$apellido = $app->request->post("apellido");
	$passw = $app->request->post("passw");
	$edad = $app->request->post("edad");
	$mail = $app->request->post("mail");
	$fecha_alta = $app->request->post("fecha_alta");
	//encriptar la password
	//$pass="8990";
	//$passwEncrypt = password_hash($pass, PASSWORD_BCRYPT); //para verificar luego: password_verify($pass, $passwEncrypt)	

	
	$dbPDO = new ConexionPDO();
	$conn = $dbPDO->getConexion();
	$dbQuery = $conn->prepare("insert into clientes (dni, nombre, apellido, password, edad, mail, fecha_alta) values (:dni, :nombre, :apellido, :pass, 
								:edad, :mail, :fecha_alta");
	$dbQuery->bindParam(":dni", $dni);
	$dbQuery->bindParam(":nombre", $nombre);
	$dbQuery->bindParam(":apellido", $apellido);
	$dbQuery->bindParam(":pass", $passw);
	$dbQuery->bindParam(":edad", $edad);
	$dbQuery->bindParam(":mail", $mail);
	$dbQuery->bindParam(":fecha_alta", $fecha_alta);

	$dbQuery->execute();

	$clienteId = $conn->lastInsertId();
	//var_dump($conn);
	$conn = null;

	//respuesta
	$app->response->headers->set("Content-Type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($clienteId));
});




$app->put("/clientes/modificar/", function() use($app){

	$dni = $app->request->put("dni");
	$nombre = $app->request->put("nombre");
	$apellido = $app->request->put("apellido");
	$passw = $app->request->put("passw");
	$edad = $app->request->put("edad");
	$mail = $app->request->put("email");
	$id = $app->request->put("id");
		
	$dbPDO = new ConexionPDO();
	$conn = $dbPDO->getConexion();
	$dbQuery = $conn->prepare("update clientes set dni=:dni, nombre=:nombre, apellido=:apellido, password=:passw, edad=:edad, mail=:mail where id=:id");

	$dbQuery->bindParam(":dni", $dni);
	$dbQuery->bindParam(":nombre", $nombre);
	$dbQuery->bindParam(":apellido", $apellido);
	$dbQuery->bindParam(":pass", $passw);
	$dbQuery->bindParam(":edad", $edad);
	$dbQuery->bindParam(":mail", $mail);
	$dbQuery->bindParam(":id", $id);

	$dbQuery->execute();

	$conn = null;

	//respuesta
	$app->response->headers->set("Content-Type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($clienteId));
});


$app->delete("/clientes/borrar/", function($id) use($app){
		
	$dbPDO = new ConexionPDO();
	$conn = $dbPDO->getConexion();
	$dbQuery = $conn->prepare("delete from clientes where id=:id");

	$dbQuery->bindParam(":id", $id);

	$dbQuery->execute();

	$conn = null;

	//respuesta
	$app->response->headers->set("Content-Type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($clienteId));
});





?>