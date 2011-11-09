<?php
require_once '../model/Chompa.php';
require_once '../model/Pedido.php';
session_start();

class Controlador
{
    private $_carro=array();
    private $_items_nro;
    private $_items_precio;

    public function getPedidos()
    {
        $pedido= new Pedido();
        return $pedido->getAllPedidos();
        
    }
    
    public function autorizarPedidoByPedidoId($pedidoId)
    {
        $pedido= $this->findPedidoByID($pedidoId);
        $pedido->autorizarPedido();//lo vuelve no pendiente
        $producto= $this->findProductById($pedido->get_chompaId());
        $producto->updateStock($producto->get_currentStock()+$pedido->getEquivalente());//actualiza el stock de chompas
        
    }
    
    
    
    public function loadImage($id)
    {
        $image=new Image();
        return $image->loadImage($id);
        
    }

    public function cerrarSesion()
    {
        session_start();
        session_destroy();
        header('location:../index.php');

    }
    
    public function existePedidoParaChompaPorID($id)
    {
        $pedido= new Pedido();
        return $pedido->existePedidoParaChompaId($id);
        
    }

    public function crearOrden($_name,$_address,$_city,$_province,$_email,$_country,
                            $_shippingMethod,$_paymentMethod,$_zipCode,$_phone)
    {
        $orden= new Order($_SESSION['carro']);
        $orden->insertar($_name,$_address,$_city,$_province,$_email,$_country,
                            $_shippingMethod,$_paymentMethod,$_zipCode,$_phone);
        return $orden;

    }

    public function  __construct() {

        $this->inicializarParametros();

    }
    public function estaRojo(Chompa $producto)
    {
        if($producto->get_currentStock()<$producto->get_minStock())
        {
            return true;
        }
        else
        {
            return false;
        }
            
        
    }
    public function actualizarCarrito()
    {
        $_SESSION['carro'];
        
        foreach($_SESSION['carro'] as $id=>$item)
        {
            
            $producto=$this->findProductById($id);
        
            if($_POST["$id"]==0)
            {
                unset ($_SESSION['carro'][$id]);
                $producto->updateStock($producto->get_currentStock()+$_POST["old$id"]);
                
                
                
            }
            else
            {
                $_SESSION['carro'][$id]=$_POST["$id"];
                $producto->updateStock($producto->get_currentStock()+$_POST["old$id"]-$_POST["$id"]);
                
                //$chompa=$this->findProductById($id);
                
                
            }
            
            $this->decidirPedidoPorFaltanteDeStockDeProductoConId($id);
        }
        $_SESSION['items_nro']=$this->calcularNumeroItems($_SESSION['carro']);
     
    }
    public function calcularNumeroItems($carro)
    {
        $nro=0;
        foreach($carro as $key =>$item)
        {
            $nro=$nro+$item;

        }
        return $nro;

    }
    public function calcularPrecio($carro)
    {
        $nro=0;
        foreach($carro as $key =>$item)
        {
            $producto=$this->findProductById($key);

            $nro=$nro+$item*$producto->getPrice();

        }
        return $nro;
    }
    
    public function decidirPedidoPorFaltanteDeStockDeProductoConId($id)
    {
        $prodFinal=$this->findProductById($id);
        if($this->estaRojo($prodFinal) && !$this->existePedidoParaChompaPorID($id))
        {
            //marcar letras como rojo
            $this->generarPedido($prodFinal);
        }
       
    }

    public function agregarProductos($id)
    {
        $producto=$this->findProductById($id);

        if(isset($_SESSION['carro'][$id]))
        {
            $_SESSION['carro'][$id]++;
            //$producto->updateStock($producto->get_currentStock()-1);
        }
        else
        {
            $_SESSION['carro'][$id]=1;
        }
        $producto->updateStock($producto->get_currentStock()-1);
        
        //evaluar posible generacion d pedidos
        $this->decidirPedidoPorFaltanteDeStockDeProductoConId($id);
       
        
        $_SESSION['items_nro']=$this->calcularNumeroItems($_SESSION['carro']);
        


    }

    public function generarPedido(Chompa $producto)
    {
             $pedido= new Pedido(1,$producto->get_insumoId(),$producto->get_chompaId());
             $pedido->insertarPedido();
        
    }

    public function findProductById($id)
    {
        $productos=$this->getChompas();
        foreach($productos as $prod)
        {
            if($prod->get_chompaId()==$id)
            {
                return $prod;
            }
        }

    }
    public function findPedidoByID($id)
    {
        $pedido= new Pedido();
        $pedidos= $pedido->getAllPedidos();
        foreach($pedidos as $key=>$value)
        {
            if($value->get_pedidoId()==$id)
            {
                return $value;
            }
            
        }
        
    }
    
    
    public function inicializarParametros()
    {
        if(isset($_SESSION['carro']))
        {
            $this->_carro=$_SESSION['carro'];
            $this->_items_nro=count($_SESSION['items_nro']);

        }
        else
        {
            $this->_items_nro=0;
            $this->_items_precio=0.00;
            $_SESSION['items_nro']=$this->_items_nro;
            $_SESSION['items_precio']=$this->_items_precio;

        }
    }
   
    public function getChompas()
    {
        $chompa= new Chompa();
        return $chompa->getAllChompas();
        
        
    }


    
    
}


?>
