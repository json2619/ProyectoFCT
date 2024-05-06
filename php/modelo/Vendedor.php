<?php
class Vendedor
{
    private $ID_Vendedor;
    private $ID_Usuario;
    private $Reputacion;

    public function __get($propiedad)
    {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }
}