<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// include database and object file
include_once '../config/Database.php';
include_once '../model/Producto.php';
 // get database connection
$database = new Database();
$db = $database->getConnection();
 // prepare product object
$producto = new Producto($db);
 // get product id
$data = json_decode(file_get_contents("php://input"));
 // set product id to be deleted
$producto->id = $data->id;
 // delete the product
if($producto->delete()){
     // set response code - 200 ok
    http_response_code(200);
     // tell the user
    echo json_encode(array("message" => "El producto fue eliminado."));
} else {
    // set response code - 503 service unavailable
    http_response_code(503);
    // tell the user
    echo json_encode(array("message" => "No se puede eliminar el producto."));
}