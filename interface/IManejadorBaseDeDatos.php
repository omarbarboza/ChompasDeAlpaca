<?php

interface IManejadorBaseDeDatos {
    public function conectar();
    public function ejecutarQuery(SQL $sql);
    public function desconectar();

}
?>
