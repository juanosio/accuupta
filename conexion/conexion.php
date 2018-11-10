<?php

try {
   
    $conexion = new PDO('mysql:host=localhost;dbname=accuupta', "root", "");
   

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}