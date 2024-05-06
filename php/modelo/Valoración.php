<?php
class ValoracionVendedor
{
    private $ID_Usuario;
    private $Comentario;
    private $Puntuacion;

    public function __get($propiedad)
    {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }
}