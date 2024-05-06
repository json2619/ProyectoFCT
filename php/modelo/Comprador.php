<?php
class Comprador
{
    private $ID_Comprador;
    private $ID_Usuario;

    public function __get($propiedad)
    {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }
}
