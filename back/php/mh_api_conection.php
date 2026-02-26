<!-- 
1.- Crear variable base URL con https://wilds.mhdb.io/es/ 

2.- Hacer función que reciba un endpoint (texto) y que reciba una variable que se llame "params"
    2.1- Dentro de la función hay que concatenar la base URL con el endpoint (weapons, etc) y los params (?limit=10&offset=0)
    2.2- Hacer la petición Get a la URL recuperando la respuesta devuelta 
    2.3- Convertir el JSON en un array php y mostrar el resultado por consola (por ahora)

    Crear script de python que reciba el json(entrada) y cree tablas sql(salida) ORM json a sql
-->
 
<?php
echo "SAPI:".php_sapi_name() .PHP_EOL;
echo "PHP:" .PHP_VERSION . PHP_EOL;

echo "curl_init exists?";
var_dump(function_exists('curl_init'));

echo "CURLOPT_RETURNTRANSFER
defined?";
var_dump(defined('CURLOPT_RETURNTRANSFER'));
// $CH = curl_init("https://wilds.mhdb.io/es/weapons?limit=10&offset=0"); /* Dónde vamos a apuntar */

// curl_setopt($CH, CURLOPT_RETURNTRANSFER, true); /* Información en texto */

// $RESPONSE = curl_exec($CH); /* Recupera la respuesta de la petición */

// curl_close($CH); /* Cerramos la petición */

// $DATA = json_decode($RESPONSE, true);
// print_r($DATA); 

?> 