<?php

class Pedido {

    private $_pedidoId;
    private $_insumoId;
    private $_chompaId;
    private $_fecha;
    private $_pendiente;
    
  
    
    public function set_fecha($_fecha) {
        $this->_fecha = $_fecha;
    }
    public function set_pendiente($_pendiente)
    {
        $this->_pendiente=$_pendiente;
    }

        public function __construct($_pedidoId="", $_insumoId="", $_chompaId="") 
    {
        $this->_pedidoId = $_pedidoId;
        $this->_insumoId = $_insumoId;
        $this->_chompaId = $_chompaId;
        $this->_fecha = new DateTime();
        $this->_pendiente=1;
        
    }
    
    public function __construct1($_pedidoId="", $_insumoId="", $_chompaId="",$_fecha="",$_pendiente="") 
    {
        $this->_pedidoId = $_pedidoId;
        $this->_insumoId = $_insumoId;
        $this->_chompaId = $_chompaId;
        $this->_fecha = $_fecha;
        $this->_pendiente=$_pendiente;
        
        
    }
    
    
    
    
    public function get_pedidoId() {
        return $this->_pedidoId;
    }

    public function get_insumoId() {
        return $this->_insumoId;
    }

    public function get_chompaId() {
        return $this->_chompaId;
    }

    public function get_fecha() {
        return $this->_fecha;
    }
    public function getPendiente()
    {
        return $this->_pendiente;
    }

    public function getAllPedidos()
    {
        
         $sql= new SQL("select * from pedidos where pendiente=1",1);
        $resultado=Persistence::consultar($sql);
        if($resultado!=null)
        {
        foreach($resultado as $key=>$value)
        {
            $_pedidoId=$value['pedidoId'];
            $_insumoId=$value['insumoId'];
            $_chompaId=$value['chompaId'];
            $_fecha=$value['fecha'];
            $_pendiente=$value['pendiente'];
           
            $pedido=new Pedido($_pedidoId, $_insumoId, $_chompaId);
                    $pedido->set_fecha($_fecha);
                    $pedido->set_pendiente($_pendiente);
            $pedidos[]=$pedido;
            
        }
        return $pedidos;
        }
    }
    
    public function getEquivalente()
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
    public function getChompaNombre()
    {
        $query="select nombre,chompaId from chompas where chompaId=".$this->_chompaId;
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
    
    
        public function getInsumoNombre()
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
    public function insertarPedido()
    {
        
        $fecha_formateada=  $this->get_fecha()->format('Y-m-d');
        //echo $fecha_formateada;
        $query="insert into pedidos (pedidoid,insumoid,chompaid,fecha,pendiente) values (null,$this->_insumoId,$this->_chompaId,str_to_date('$fecha_formateada','%Y-%m-%d'),$this->_pendiente)";
        $sql= new SQL($query,2);
        Persistence::consultar($sql);
    }
    public function existePedidoParaChompaId($id)
    {
        $query="select chompaid from pedidos where chompaid=".$id;
        //echo $query;
        $sql= new SQL($query,1);
        $resultado=Persistence::consultar($sql);
        if($resultado==null)
        {return false;}
        else
        {
            return true;
        }
        
       
        
    }
    public function  autorizarPedido()
    {
        $query="update pedidos set pendiente=0 where pedidoId=".$this->_pedidoId;
        $sql= new SQL($query,2);
        Persistence::consultar($sql);
        
    }

    
}

?>
