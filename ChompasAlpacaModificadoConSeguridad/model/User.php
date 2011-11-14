<?php
require_once '../persistence/Persistence.php';

class User {
    
    private $_username;
    private $_pwd;
    
    
    function __construct($username="",$pwd=""){
       
        $this->_username = $username;
        $this->_pwd = $pwd;
       
    }
    
    function getUsername(){return $this->_username;}
    function getPwd(){return $this->_pwd;}
    
    
    function getUsers(){
        
        $sql= new SQL("select * from users",1);
        $resultado=Persistence::consultar($sql);
        
        
        $users = array();
        foreach($resultado as $usr){
           
            $name = $usr['nombre'];
            $pwd = $usr['password'];
           
            $user = new User($name,$pwd);
            $users[] = $user;
        }
        return $users;    
    }
}

?>
