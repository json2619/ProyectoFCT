<?php
class Administrador
{
    private $ID_Usuario;
    private $Nombre;
    private $FechNac;
    private $Telefono;
    private $Correo;
    private $Contraseña;
    private $Tipo_usuario;

    public function __get($propiedad)
    {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }
}