<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
// include database and object files
include_once '../config/Database.php';
include_once '../model/Producto.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
// prepare product object
$producto = new Producto($db);
// set ID property of record to read
$producto->id = isset($_GET['id']) ? $_GET['id'] : die();
// read the details of product to be edited
$producto->find();
if($producto->nombre!=null){
    // create array
    $producto_arr = array(
        "id" =>  $producto->id,
        "nombre" => $producto->nombre,
        "descripcion" => $producto->descripcion,
        "precio" => $producto->precio,
        "categoria_id" => $producto->categoria_id,
        "categoria_nombre" => $producto->categoria_nombre
    );
    // set response code - 200 OK
    http_response_code(200);
    // make it json format
    echo json_encode($producto_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user product does not exist
    echo json_encode(array("message" => "El producto no existe."));
}