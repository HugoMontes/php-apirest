<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// include database and object files
include_once '../config/Database.php';
include_once '../model/Producto.php'; 
// get database connection
$database = new Database();
$db = $database->getConnection();
// prepare product object
$producto = new Producto($db);
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
// set ID property of product to be edited
$producto->id = $data->id;
// set product property values
$producto->nombre = $data->nombre;
$producto->precio = $data->precio;
$producto->descripcion = $data->descripcion;
$producto->categoria_id = $data->categoria_id;
// update the product
if($producto->update()){
    // set response code - 200 ok
    http_response_code(200);
    // tell the user
    echo json_encode(array("message" => "El producto fue actualizado."));
} else{
    // set response code - 503 service unavailable
    http_response_code(503);
    // tell the user
    echo json_encode(array("message" => "No se puede actualizar el producto."));
}