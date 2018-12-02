<?php
class Producto{
 
    // database connection and table name
    private $conn;
    private $table_name = "productos";
 
    // object properties
    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $categoria_id;
    public $categoria_nombre;
    public $creado;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
        // select all query
        $query = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.categoria_id, p.creado, c.nombre as categoria_nombre FROM ".$this->table_name." p LEFT JOIN categorias c ON p.categoria_id = c.id ORDER BY p.creado DESC";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create product
    function create(){
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, precio=:precio, descripcion=:descripcion, categoria_id=:categoria_id, creado=:creado";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->precio=htmlspecialchars(strip_tags($this->precio));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->categoria_id=htmlspecialchars(strip_tags($this->categoria_id));
        $this->creado=htmlspecialchars(strip_tags($this->creado));
        // bind values
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":categoria_id", $this->categoria_id);
        $stmt->bindParam(":creado", $this->creado);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // used when filling up the update product form
    function find(){
        // query to read single record
        $query = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.categoria_id, p.creado, c.nombre as categoria_nombre  
                  FROM " . $this->table_name . " p LEFT JOIN categorias c ON p.categoria_id = c.id 
                  WHERE p.id = ? LIMIT 0,1";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
        // execute query
        $stmt->execute();
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // set values to object properties
        $this->nombre = $row['nombre'];
        $this->precio = $row['precio'];
        $this->descripcion = $row['descripcion'];
        $this->categoria_id = $row['categoria_id'];
        $this->categoria_nombre = $row['categoria_nombre'];
    }

    // update the product
    function update(){
        // update query
        $query = "UPDATE " . $this->table_name . " SET
                    nombre = :nombre,
                    precio = :precio,
                    descripcion = :descripcion,
                    categoria_id = :categoria_id
                WHERE
                    id = :id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->precio=htmlspecialchars(strip_tags($this->precio));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->categoria_id=htmlspecialchars(strip_tags($this->categoria_id));
        $this->id=htmlspecialchars(strip_tags($this->id));
        // bind new values
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':categoria_id', $this->categoria_id);
        $stmt->bindParam(':id', $this->id);
        // execute the query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete the product
    function delete(){
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;    
    }
}