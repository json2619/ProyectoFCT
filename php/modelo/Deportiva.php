<?php
class Deportiva
{
    private $ID_Deportiva;
    private $ID_Vendedor;
    private $Modelo;
    private $Marca;
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