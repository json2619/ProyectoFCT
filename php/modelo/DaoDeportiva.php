<?php
require_once 'db/db.php';
require_once 'Deportiva.php';

class DaoDeportiva extends DB
{
    public $deportivas = array();  

    public function __construct($base)  
    {
        $this->dbname = $base;
    }

    public function insertar($deportiva)      
    {
        $consulta = "INSERT INTO deportiva (ID_Vendedor, Modelo, Marca, Estado) VALUES (:ID_Vendedor, :Modelo, :Marca, :Estado)";

        $param = array();

        $param[":ID_Vendedor"] = $deportiva->__get("ID_Vendedor");
        $param[":Modelo"] = $deportiva->__get("Modelo");
        $param[":Marca"] = $deportiva->__get("Marca");
        $param[":Estado"] = $deportiva->__get("Estado");

        $this->ConsultaSimple($consulta, $param);
    }

    public function obtener() 
    {
        $consulta = "SELECT * FROM deportiva";
        $param = array();

        $this->deportivas = array();  

        $this->ConsultaDatos($consulta, $param);

        $deportivas = array(); 

        foreach ($this->filas as $fila) {
            $deportiva = new Deportiva();

            $deportiva->__set("ID_Deportiva", $fila['ID_Deportiva']);
            $deportiva->__set("ID_Vendedor", $fila['ID_Vendedor']);
            $deportiva->__set("Modelo", $fila['Modelo']);
            $deportiva->__set("Marca", $fila['Marca']);
            $deportiva->__set("Estado", $fila['Estado']);

            $deportivas[] = $deportiva;
        }

        return $deportivas;
    }

    public function borrar($id)       
    {
        $consulta = "DELETE FROM deportiva WHERE ID_Deportiva = :id";

        $param = array(":id" => $id);

        $this->ConsultaSimple($consulta, $param);
    }
    
    public function actualizar($deportiva)    
    { 
        $consulta = "UPDATE deportiva SET ID_Vendedor = :ID_Vendedor, Modelo = :Modelo, Marca = :Marca, Estado = :Estado WHERE ID_Deportiva = :ID_Deportiva";
        
        $param = array();
        
        $param[":ID_Deportiva"] = $deportiva->__get("ID_Deportiva");
        $param[":ID_Vendedor"] = $deportiva->__get("ID_Vendedor");
        $param[":Modelo"] = $deportiva->__get("Modelo");
        $param[":Marca"] = $deportiva->__get("Marca");
        $param[":Estado"] = $deportiva->__get("Estado");
        
        $this->ConsultaSimple($consulta, $param);
    }
}