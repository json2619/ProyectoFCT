<?php
require_once 'db/db.php';
require_once 'ValoracionVendedor.php';

class DaoValoracionVendedor extends DB
{
    public $valoraciones = array();  

    public function __construct($base)  
    {
        $this->dbname = $base;
    }

    public function insertar($valoracion)      
    {
        $consulta = "INSERT INTO valoracion_vendedor (ID_Usuario, Comentario, Puntuacion) VALUES (:ID_Usuario, :Comentario, :Puntuacion)";

        $param = array();

        $param[":ID_Usuario"] = $valoracion->__get("ID_Usuario");
        $param[":Comentario"] = $valoracion->__get("Comentario");
        $param[":Puntuacion"] = $valoracion->__get("Puntuacion");

        $this->ConsultaSimple($consulta, $param);
    }

    public function obtener() 
    {
        $consulta = "SELECT * FROM valoracion_vendedor";
        $param = array();

        $this->valoraciones = array();  

        $this->ConsultaDatos($consulta, $param);

        $valoraciones = array(); 

        foreach ($this->filas as $fila) {
            $valoracion = new ValoracionVendedor();

            $valoracion->__set("ID_Valoracion", $fila['ID_Valoracion']);
            $valoracion->__set("ID_Usuario", $fila['ID_Usuario']);
            $valoracion->__set("Comentario", $fila['Comentario']);
            $valoracion->__set("Puntuacion", $fila['Puntuacion']);

            $valoraciones[] = $valoracion;
        }

        return $valoraciones;
    }

    public function borrar($id)       
    {
        $consulta = "DELETE FROM valoracion_vendedor WHERE ID_Valoracion = :id";

        $param = array(":id" => $id);

        $this->ConsultaSimple($consulta, $param);
    }
    
    public function actualizar($valoracion)    
    { 
        $consulta = "UPDATE valoracion_vendedor SET ID_Usuario = :ID_Usuario, Comentario = :Comentario, Puntuacion = :Puntuacion WHERE ID_Valoracion = :ID_Valoracion";
        
        $param = array();
        
        $param[":ID_Valoracion"] = $valoracion->__get("ID_Valoracion");
        $param[":ID_Usuario"] = $valoracion->__get("ID_Usuario");
        $param[":Comentario"] = $valoracion->__get("Comentario");
        $param[":Puntuacion"] = $valoracion->__get("Puntuacion");
        
        $this->ConsultaSimple($consulta, $param);
    }
}