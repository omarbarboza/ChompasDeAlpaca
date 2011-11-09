<?php
require_once '../control/Controlador.php';
require_once '../persistence/Persistence.php';


if(!isset($_SESSION)) 
{ 
session_start(); 
}  
class ViewPHP {

    public static function run()
    {

        $miLogic=new Controlador();
        
        $view=isset($_GET['view'])?($_GET['view']):'default';
        
        switch($view)
        {
            case 'default':
                $productos=$miLogic->getChompas();

                break;
            case 'agregar':$miLogic->agregarProductos($_GET['id']);
                            header('location:ViewPHP.php');

                break;

            case 'update':$miLogic->actualizarCarrito();
                 header('location:ViewPHP.php?view=detalle');


                break;
            case 'cerrar': $miLogic->cerrarSesion();
                break;

            case 'detalle':
                $productos=$miLogic->getChompas();

                break;
            case 'pedidos':
                $productos=$productos=$miLogic->getChompas();
                $pedidos=$miLogic->getPedidos();
                
                break;
            
            case 'autorizar':
                $pedidoId=$_GET['id'];
                echo $pedidoId;
                
                $miLogic->autorizarPedidoByPedidoId($pedidoId);
                header('location:ViewPHP.php?view=pedidos');
                //llamar controlador para actualizar
                
                //llmar a la vista pedidos nuevamente actualizada
                break;
            
             case 'presentar':
                    $name = $_POST['name'];
                    $address = $_POST['address'];
                    $city = $_POST['city'];
                    $province = $_POST['province'];
                    $email = $_POST['email'];
                    $country = $_POST['country'];
                    $shippingMethod = $_POST['shippingMethod'];
                    $paymentMethod = $_POST['paymentMethod'];
                    $zipCode = $_POST['zipCode'];
                    $phone = $_POST['phone'];
                    $orden=$miLogic->crearOrden($name,$address,$city,
                                    $province,$email,$country,$shippingMethod,
                                    $paymentMethod,$zipCode,$phone);
                    
                    break;
             case 'imagen':
                 $imagen=$miLogic->loadImage($_GET['id']);
                 header('Content-type:image/png');
                 echo $imagen->getBytes();
                 break;
            case 'login':
                if(isset($_POST['username']) && isset($_POST['pwd'])){
                    if($_POST['username']!=null && $_POST['pwd']!=null){
                        $r_username =$_POST['username'];
                        $r_pwd = $_POST['pwd'];
                        $userLogic = new UserLogic();
                        $rs = $userLogic->auth($r_username,$r_pwd);
                        header('location:ViewPHP.php');
                    }
                }
                break;
            case 'register':
                break;

            default:
                    break;

        }
        require_once 'generalView.html';


    }
}
ViewPHP::run();
?>
