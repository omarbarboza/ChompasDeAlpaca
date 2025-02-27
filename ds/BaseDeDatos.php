<?php
require_once '/../interface/IManejadorBaseDeDatos.php';
require_once 'SQL.php';
class BaseDeDatos {
    private $_manejador;
    public function __construct(IManejadorBaseDeDatos $manejador) {
        $this->_manejador = $manejador;
    }

    public function ejecutar(SQL $sql){
        $this->_manejador->conectar();
        $datos = $this->_manejador->ejecutarQuery($sql);
        $this->_manejador->desconectar();
        if($sql->get_type()==1 && $datos!=null)//select
        {
            return $datos;
        }
        
    }
}
