<?php

require_once 'db/db.php';
require_once 'Usuario.php';

class Daousuductos extends DB
{
    public $usuarios = array();  

    public function __construct($base)  
    {
        $this->dbname = $base;
    }

    public function insertar($admin)      
    {
        $consulta = "insert into usuario values(:ID_Usuario,:Nombre,:FechNac,:Telefono,:Correo,:Contraseña,:Tipo_usuario)";

        $param = array();

        $param[":ID_Usuario"] = $admin->__get("ID_Usuario");
        $param[":Nombre"] = $admin->__get("Nombre");
        $param[":FechNac"] = $admin->__get("FechNac");
        $param[":Telefono"] = $admin->__get("Telefono");
        $param[":Correo"] = $admin->__get("Correo");
        $param[":Contraseña"] = $admin->__get("Contraseña");
        $param[":Tipo_usuario"] = $admin->__get("Tipo_usuario");

        $this->ConsultaSimple($consulta, $param);

    }


    public function obtener() 
    {
        $consulta = "select * from usuario";
        $param = array();

        $this->usuarios = array();  

        $this->ConsultaDatos($consulta, $param);

        $usu = null; 

        if (count($this->filas) == 1) {
            $fila = $this->filas[0];  

            $usu = new Usuario();

            $usu->__set("ID_Usuario", $fila['ID_Usuario']);
            $usu->__set("Nombre", $fila['Nombre']);
            $usu->__set("FechNac", $fila['FechNac']);
            $usu->__set("Telefono", $fila['Telefono']);
            $usu->__set("Correo", $fila['Correo']);
            $usu->__set("Contraseña", $fila['Contraseña']);
            $usu->__set("Tipo_usuario", $fila['Tipo_usuario']);
        }

        return $usu;
    }

    public function borrar($id)       //Lista los usuductos de una familia
    {
        $consulta = "Delete
                FROM  usuario
                where ID_Usuario=:id; ";

        $param = array(":id" => $id);

        $this->consultaSimple($consulta, $param);

    }
    
    public function actualizar($alu)     //Recibimos como parámetro un objeto con los datos a actualizar   
    { 
        $consulta="update usuario set ID_Usuario=:ID_Usuario,
                                    Nombre=:Nombre,
                                    FechNac=:FechNac, 
                                    Telefono=:Telefono,    
                                    Correo=:Correo,
                                    Contraseña=:Contraseña,
                                    Tipo_usuario=:Tipo_usuario where NIF=:NIF";
        
        $param=array();
        
        $param[":ID_Usuario"]=$alu->__get("ID_Usuario");
        $param[":Nombre"]=$alu->__get("Nombre");
        $param[":FechNac"]=$alu->__get("FechNac");
        $param[":Telefono"]=$alu->__get("Telefono");
        $param[":Correo"]=$alu->__get("Correo");
        $param[":Contraseña"]=$alu->__get("Contraseña");
        $param[":Tipo_usuario"]=$alu->__get("Tipo_usuario");
        
        $this->ConsultaSimple($consulta,$param);
        
    }

}