<?php
require_once 'db/db.php';
require_once 'Transaccion.php';

class DaoTransaccion extends DB
{
    public $transacciones = array();  

    public function __construct($base)  
    {
        $this->dbname = $base;
    }

    public function insertar($transaccion)      
    {
        $consulta = "INSERT INTO transaccion (ID_Comprador, ID_Vendedor, ID_Deportiva, Fecha, Tipo_Transaccion, Costo) VALUES (:ID_Comprador, :ID_Vendedor, :ID_Deportiva, :Fecha, :Tipo_Transaccion, :Costo)";

        $param = array();

        $param[":ID_Comprador"] = $transaccion->__get("ID_Comprador");
        $param[":ID_Vendedor"] = $transaccion->__get("ID_Vendedor");
        $param[":ID_Deportiva"] = $transaccion->__get("ID_Deportiva");
        $param[":Fecha"] = $transaccion->__get("Fecha");
        $param[":Tipo_Transaccion"] = $transaccion->__get("Tipo_Transaccion");
        $param[":Costo"] = $transaccion->__get("Costo");

        $this->ConsultaSimple($consulta, $param);
    }

    public function obtener() 
    {
        $consulta = "SELECT * FROM transaccion";
        $param = array();

        $this->transacciones = array();  

        $this->ConsultaDatos($consulta, $param);

        $transacciones = array(); 

        foreach ($this->filas as $fila) {
            $transaccion = new Transaccion();

            $transaccion->__set("ID_Transaccion", $fila['ID_Transaccion']);
            $transaccion->__set("ID_Comprador", $fila['ID_Comprador']);
            $transaccion->__set("ID_Vendedor", $fila['ID_Vendedor']);
            $transaccion->__set("ID_Deportiva", $fila['ID_Deportiva']);
            $transaccion->__set("Fecha", $fila['Fecha']);
            $transaccion->__set("Tipo_Transaccion", $fila['Tipo_Transaccion']);
            $transaccion->__set("Costo", $fila['Costo']);

            $transacciones[] = $transaccion;
        }

        return $transacciones;
    }

    public function borrar($id)       
    {
        $consulta = "DELETE FROM transaccion WHERE ID_Transaccion = :id";

        $param = array(":id" => $id);

        $this->ConsultaSimple($consulta, $param);
    }
    
    public function actualizar($transaccion)    
    { 
        $consulta = "UPDATE transaccion SET ID_Comprador = :ID_Comprador, ID_Vendedor = :ID_Vendedor, ID_Deportiva = :ID_Deportiva, Fecha = :Fecha, Tipo_Transaccion = :Tipo_Transaccion, Costo = :Costo WHERE ID_Transaccion = :ID_Transaccion";
        
        $param = array();
        
        $param[":ID_Transaccion"] = $transaccion->__get("ID_Transaccion");
        $param[":ID_Comprador"] = $transaccion->__get("ID_Comprador");
        $param[":ID_Vendedor"] = $transaccion->__get("ID_Vendedor");
        $param[":ID_Deportiva"] = $transaccion->__get("ID_Deportiva");
        $param[":Fecha"] = $transaccion->__get("Fecha");
        $param[":Tipo_Transaccion"] = $transaccion->__get("Tipo_Transaccion");
        $param[":Costo"] = $transaccion->__get("Costo");
        
        $this->ConsultaSimple($consulta, $param);
    }
}