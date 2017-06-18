<?php
require_once "vendor/autoload.php";

$app = new \Slim\Slim();

// Definimos conexion de la base de datos, utilizando PDO con el driver mysql.
define('BD_SERVIDOR', 'localhost');
define('BD_NOMBRE', 'ejemploabm');
define('BD_USUARIO', 'root');
define('BD_PASSWORD', '');

// Hacemos la conexión a la base de datos con PDO.
// Para activar las collations en UTF8 podemos hacerlo al crear la conexión por PDO
// o bien una vez hecha la conexión con
// $db->exec("set names utf8");
$db = new PDO('mysql:host=' . BD_SERVIDOR . ';dbname=' . BD_NOMBRE . ';charset=utf8', BD_USUARIO, BD_PASSWORD);

// Si necesitamos acceder a alguna variable global en el framework
// Tenemos que pasarla con use() en la cabecera de la función. Ejemplo: use($db)
$app->get('/traerTodos', function() use($db,$app) {

	// Preparamos la consulta a la tabla.
	$consulta = $db->prepare("select * from persona");
	$consulta->execute();
	// Almacenamos los resultados en un array asociativo.
	$resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Access-Control-Allow-Origin", "http://localhost:4200");
	$app->response->status(200);
	$app->response->body(json_encode($resultados));
});

// Accedemos por get a /traerUno/ pasando un id 
// Ruta /traerUno/id
// Los parámetros en la url se definen con :parametro
// El valor del parámetro :id se pasará a la función de callback como argumento
$app->get('/traerUno/:id', function($id) use($db, $app) {

	// Preparamos la consulta a la tabla.
	// En PDO los parámetros para las consultas se pasan con :param1
	$consulta = $db->prepare("select * from persona where id=:param1");

	// En el execute es dónde asociamos el :param1 con el valor que le toque.
	$consulta->execute(array(':param1' => $id));

	// Almacenamos los resultados en un array asociativo.
	$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($resultado));
});


$app->get('/InsertarUno/:id', function($id) use($db, $app) {

	// Preparamos la consulta a la tabla.
	// En PDO los parámetros para las consultas se pasan con :param1
	$consulta = $db->prepare("select * from persona where id=:param1");

	// En el execute es dónde asociamos el :param1 con el valor que le toque.
	$consulta->execute(array(':param1' => $id));

	// Almacenamos los resultados en un array asociativo.
	$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status(200);
	$app->response->body(json_encode($resultado));
});

$app->get('/borrar/:id', function($id) use($db, $app) {

	// Recuperamos los valores con $app->request->'metodo'("key")
	// 'metodo' -> post, put o delete
	//$id = $app->request->delete("id");

	// Preparamos la consulta a la tabla.
	// En PDO los parámetros para las consultas se pasan con :param1
	$consulta = $db->prepare("delete from persona where id=:param1");
	
	$status = 200;
	// En el execute es dónde asociamos el :param1 con el valor que le toque.
	if($consulta->execute(array(':param1' => $id))) 
		$res = array("rta" => true);	
	else{
		$res = array("rta" => false);
		$status = 500;
	}

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Access-Control-Allow-Origin", "http://localhost:4200");
	$app->response->status($status);
	$app->response->body(json_encode($res));
});
$app->get('/administrarModificar/:id', function($id) use($db, $app) {

	// Recuperamos los valores con $app->request->'metodo'("key")
	// 'metodo' -> post, put o delete
	//$id = $app->request->delete("id");

	// Preparamos la consulta a la tabla.
	// En PDO los parámetros para las consultas se pasan con :param1
	$consulta = $db->prepare("select * from persona where id=:param1");
	
	$status = 200;
	// En el execute es dónde asociamos el :param1 con el valor que le toque.
	if($consulta->execute(array(':param1' => $id))) 
		$res = array("rta" => true);	
	else{
		$res = array("rta" => false);
		$status = 500;
	}

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Access-Control-Allow-Origin", "http://localhost:4200");
	$app->response->status($status);
	$app->response->body(json_encode($res));
});
// POST: Para crear recursos
$app->post("/registro/", function() use($app, $db)
{
	// Recuperamos los valores con $app->request->'metodo'("key")
	// 'metodo' -> post, put o delete
	$status = 200;
	//echo "llego";
	//var_dump($app->request);
	//die();
	$nombre = $app->request->post("nombre");
	$apellido = $app->request->post("apellido");
	$dni = $app->request->post("dni");
	$sexo = $app->request->post("sexo");
	$password = $app->request->post("password");
	$foto = $app->request->post("foto");
	// Preparamos la consulta a la tabla.
	// En PDO los parámetros para las consultas se pasan con :param1
	$consulta = $db->prepare("insert into persona (nombre,apellido,dni,sexo,password,foto) values (:param1, :param2, :param3, :param4, :param5, :param6)");

	$status = 200;
	// En el execute es dónde asociamos el :param1 con el valor que le toque.
	if ($consulta->execute(array(':param1' => $nombre,':param2' => $apellido,':param3' => $dni,':param4' => $sexo,':param5' => $password,':param6' => $foto)))
		$res = array("rta" => true);	
	else{
		$res = array("rta" => false);
		$status = 500;
	}

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Access-Control-Allow-Origin", "http://localhost:4200");
	$app->response->status($status);
	$app->response->body(json_encode(json_encode($res)));

});

// DELETE: Para eliminar recursos
$app->delete("/registro/", function() use($app, $db)
{
	// Recuperamos los valores con $app->request->'metodo'("key")
	// 'metodo' -> post, put o delete
	$id = $app->request->delete("id");

	// Preparamos la consulta a la tabla.
	// En PDO los parámetros para las consultas se pasan con :param1
	$consulta = $db->prepare("delete from tabla where id=:id");
	
	$status = 200;
	// En el execute es dónde asociamos el :param1 con el valor que le toque.
	if($consulta->execute(array(':id' => $id))) 
		$res = array("rta" => true);	
	else{
		$res = array("rta" => false);
		$status = 500;
	}

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->response->headers->set("Content-type", "application/json");
	$app->response->status($status);
	$app->response->body(json_encode($res));
});

$app->run();