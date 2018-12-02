<?php
// required headers
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
    
// include database and object files
include_once '../config/Database.php';
include_once '../model/Producto.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$producto = new Producto($db);
 
// query products
$stmt = $producto->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
    // products array
    $productos=array();
    $productos=array();
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $producto_item=array(
            "id" => $id,
            "nombre" => $nombre,
            "descripcion" => $descripcion,
            "precio" => $precio,
            "categoria_id" => $categoria_id,
            "categoria_nombre" => $categoria_nombre
        );
        array_push($productos, $producto_item);
    }
    // print_r($productos);
    // set response code - 200 OK
    http_response_code(200); 
    // show products data in json format
    echo json_encode($productos);
} else {
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user no products found
    echo json_encode(
        array("message" => "No se encontraron productos.")
    );
}
