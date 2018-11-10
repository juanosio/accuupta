<?php

try {
   
    $conexion2 = new PDO('mysql:host=localhost;dbname=departamento', "root", "");
   

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}