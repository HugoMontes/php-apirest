<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/Database.php';
 
// instantiate product object
include_once '../model/Producto.php';
 
$database = new Database();
$db = $database->getConnection();
 
$producto = new Producto($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->nombre) &&
    !empty($data->precio) &&
    !empty($data->descripcion) &&
    !empty($data->categoria_id)
){
    // set product property values
    $producto->nombre = $data->nombre;
    $producto->precio = $data->precio;
    $producto->descripcion = $data->descripcion;
    $producto->categoria_id = $data->categoria_id;
    $producto->creado = date('Y-m-d H:i:s');
 
    // create the product
    if($producto->create()){
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "El producto fue creado."));
    }
    // if unable to create the product, tell the user
    else{
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "No se puede crear el producto."));
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "No se puede crear el producto. Los datos están incompletos."));
}