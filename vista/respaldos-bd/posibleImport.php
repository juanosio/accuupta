include ("config.php");

$archivo = $_FILES["archivo"];
$cadena=implode($archivo);

$nueva = substr ( $cadena ,0 , -54 );
$dir = "respaldos/$nueva";

$comando = "C:/xampp/mysql/bin/mysql --user=$user --password=$pass $db < respaldos/$nueva";
system ($comando, $error);
header ("Location:mantenimiento.php?restaurado=true");