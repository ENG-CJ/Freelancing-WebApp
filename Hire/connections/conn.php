<?php


class Connections{

 
    public function connect(): mysqli {
       
        $conn= new mysqli("localhost","root","","hireme");
        return $conn;
        
    }
}



?>