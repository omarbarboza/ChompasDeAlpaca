<?php
require_once '../persistence/Persistence.php';
require_once '../ds/SQL.php';
class Chompa {


    private $_chompaId;
    private $_nombre;
    private $_insumoId;
    private $_currentStock;
    private $_minStock;

    public function get_chompaId() {
        return $this->_chompaId;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function get_insumoId() {
        return $this->_insumoId;
    }

    public function get_currentStock() {
        return $this->_currentStock;
    }

    public function get_minStock() {
        return $this->_minStock;
    }



    function __construct($_chompaId="", $_nombre="", $_insumoId="", $_currentStock="", $_minStock="") {
        $this->_chompaId = $_chompaId;
        $this->_nombre = $_nombre;
        $this->_insumoId = $_insumoId;
        $this->_currentStock = $_currentStock;
        $this->_minStock = $_minStock;
    }
    public function getAllChompas()
    {
        $sql= new SQL("select * from chompas",1);
        $resultado=Persistence::consultar($sql);
        foreach($resultado as $key=>$value)
        {
            $_chompaId=$value['chompaId'];
            $_nombre=$value['nombre'];
            $_insumoId=$value['insumoId'];
            $_currentStock=$value['currentStock'];
            $_minStock=$value['minStock'];
            $chompas[]=new Chompa($_chompaId, $_nombre, $_insumoId, $_currentStock, $_minStock);
            
        }
        return $chompas;
    }
    public function get_insumoName()
    {
        $query="select nombre,insumoId from insumos where insumoId=".$this->get_insumoId();
        //echo '..'.$query."...";
        $sql= new SQL($query,1);
        //echo $sql->get_type();
        $resultado=Persistence::consultar($sql);
       // print_r($resultado);
        foreach($resultado as $key=>$value)
        {
            $nombre= $value['nombre'];
            //echo $nombre;
            
        }
        return $nombre;
        
    }
    public function get_numeroEquivalente()
    {
        $sql= new SQL("select ic.cantidadEquivalenteChompas,c.chompaId  from insumos i,chompas c,insumosChompas ic where i.insumoId=ic.insumoId and c.chompaId=ic.chompaId and c.chompaId=".$this->get_chompaId(),1);
       // echo $sql->get_type();
        //echo $sql;
        $resultado=Persistence::consultar($sql);
        foreach($resultado as $key=>$value)
        {
            $numero= $value['cantidadEquivalenteChompas'];
            //echo $numero;
        }
        return $numero;
        
    }
    public function updateStock($nuevoStock)
    {
        $query="update chompas set currentStock=".$nuevoStock." where chompaId=".$this->_chompaId;
        $sql= new SQL($query,2);
        Persistence::consultar($sql);
        
    }
   
    







}
?>
