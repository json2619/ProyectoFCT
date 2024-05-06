<?php
class Transaccion
{
    private $ID_Transaccion;
    private $ID_Comprador;
    private $ID_Vendedor;
    private $ID_Deportiva;
    private $Fecha;
    private $Tipo_Transaccion;
    private $Costo;

    public function __get($propiedad)
    {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }
}