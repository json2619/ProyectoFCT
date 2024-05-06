<?php
class Stock
{
    private $ID_Deportiva;
    private $Cantidad;
    private $Estado;

    public function __get($propiedad)
    {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }
}