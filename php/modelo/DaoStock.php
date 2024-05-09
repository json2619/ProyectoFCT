<?php
require_once 'db/db.php';
require_once 'Stock.php';

class DaoStock extends DB
{
    public $stocks = array();  

    public function __construct($base)  
    {
        $this->dbname = $base;
    }

    public function insertar($stock)      
    {
        $consulta = "INSERT INTO stock (ID_Deportiva, Cantidad, Estado) VALUES (:ID_Deportiva, :Cantidad, :Estado)";

        $param = array();

        $param[":ID_Deportiva"] = $stock->__get("ID_Deportiva");
        $param[":Cantidad"] = $stock->__get("Cantidad");
        $param[":Estado"] = $stock->__get("Estado");

        $this->ConsultaSimple($consulta, $param);
    }

    public function obtener() 
    {
        $consulta = "SELECT * FROM stock";
        $param = array();

        $this->stocks = array();  

        $this->ConsultaDatos($consulta, $param);

        $stocks = array(); 

        foreach ($this->filas as $fila) {
            $stock = new Stock();

            $stock->__set("ID_Stock", $fila['ID_Stock']);
            $stock->__set("ID_Deportiva", $fila['ID_Deportiva']);
            $stock->__set("Cantidad", $fila['Cantidad']);
            $stock->__set("Estado", $fila['Estado']);

            $stocks[] = $stock;
        }

        return $stocks;
    }

    public function borrar($id)       
    {
        $consulta = "DELETE FROM stock WHERE ID_Stock = :id";

        $param = array(":id" => $id);

        $this->ConsultaSimple($consulta, $param);
    }
    
    public function actualizar($stock)    
    { 
        $consulta = "UPDATE stock SET ID_Deportiva = :ID_Deportiva, Cantidad = :Cantidad, Estado = :Estado WHERE ID_Stock = :ID_Stock";
        
        $param = array();
        
        $param[":ID_Stock"] = $stock->__get("ID_Stock");
        $param[":ID_Deportiva"] = $stock->__get("ID_Deportiva");
        $param[":Cantidad"] = $stock->__get("Cantidad");
        $param[":Estado"] = $stock->__get("Estado");
        
        $this->ConsultaSimple($consulta, $param);
    }
}