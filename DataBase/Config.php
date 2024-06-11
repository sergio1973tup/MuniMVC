<?php
    function getDataBaseConn() 
    {
        $conn = mysqli_connect("localhost","root","","joomla_db");

        if ($conn->connect_error){
            die("Error de Coneccion". $conn->connect_error);
        }
        return $conn;
    }
?>