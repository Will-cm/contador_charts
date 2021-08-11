<?php
//set_time_limit(3600); ////maximo 60 minutos de espera
//require('config.php');
include_once 'conexion.php';

$tipo       = $_FILES['dataCliente']['type'];   //dataCliente
$tamanio    = $_FILES['dataCliente']['size'];
$archivotmp = $_FILES['dataCliente']['tmp_name'];
$lineas     = file($archivotmp);


//////vvvv
function json_output($status = 200, $msg = 'OK', $data = null){
  header('Content-Type: aplication/json');
  echo json_encode([
    'status' => $status,
    'msg' => $msg,
    'data' => $data
  ]);
  die;
}
//////vvvv

///Devuelve 1 si existe el parametro $word buscado
function indexOf($array, $word) {
    foreach($array as $value){
      if(substr_count($value, $word) > 0 ) return 1;
    } 
    return -1;
}

///Devuelve 1 si existe el parametro $word buscado
function exist($string, $word) {
    if(substr_count($string, $word) > 0 ) return 1;
    return -1;
}
/////INICIO
$array_lp = array("LA PAZ", "LAPAZ", "la paz", "lapaz", "La paz");
$array_scz = array("SANTA CRUZ", "SANTACRUZ", "santa cruz", "santacruz", "Santa cruz");
$array_cb = array("COCHABAMBA", "cochabamba", "Cochabamba");  //3
$array_ch = array("CHUQUISACA", "chuquisaca", "Chuquisaca");  //4
$array_tj = array("TARIJA", "tarija", "Tarija");  //5
$array_or = array("ORURO", "oruro", "Oruro");  //6
$array_pt = array("POTOSI", "potosi", "Potosi");  //7
$array_be = array("BENI", "beni", "Beni");  //8
$array_pd = array("PANDO", "pando", "Pando");  //9

$i = 0;
$contador = 0;
foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    //$cantidad_regist_agregados =  ($cantidad_registros - 1); //menos cabecera

    if ($i != 0){   
        $datos = explode(";", $linea);       
        $nombre = !empty($datos[0])  ? ($datos[0]) : '';
       
        if( strlen($nombre) > 3 ){
          $nombre =substr($nombre, 0, strlen($nombre)-2);    ///error
          //echo $nombre[-3];  //obtener el caracter de la ultima posicion
          
          if(indexOf($array_lp, $nombre) === 1 ){
            $nombre = 'La paz'; //1
          }
          if(indexOf($array_scz, $nombre) === 1 ){
            $nombre = 'Santa cruz'; //2
          }
          if(indexOf($array_cb, $nombre) === 1 ){
            $nombre = 'Cochabamba';  //3
          }
          if(indexOf($array_ch, $nombre) === 1 ){
            $nombre = 'Chuquisaca';  //4
          }
          if(indexOf($array_tj, $nombre) === 1 ){
            $nombre = 'Tarija';  //5
          }
          if(indexOf($array_or, $nombre) === 1 ){
            $nombre = 'Oruro';  //6
          }
          if(indexOf($array_pt, $nombre) === 1 ){
            $nombre = 'Potosi';  //7
          }
          if(indexOf($array_be, $nombre) === 1 ){
            $nombre = 'Beni';   //8
          }
          if(indexOf($array_pd, $nombre) === 1 ){
            $nombre = 'Pando';   //9
          }

          $actualizar = "UPDATE departamentos SET cantidad_pedidos = cantidad_pedidos + 1 where (nombre = :nombre)";
          $sentencia = $pdo->prepare($actualizar);
          $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR); 
          $resultado = $sentencia -> execute();
          //------------------------1  
          /*
          $insertar = "INSERT INTO departamentos( nombre ) VALUES (:nombre)";
          $sentencia = $pdo->prepare($insertar); 
          $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR); 
          $resultado = $sentencia -> execute();   */
          //------------------------1
          //mysqli_query($con, $insertar); 
        // echo '<div>'. $i. "). " .$linea.'</div>';
          $contador++;
          
        }           
    }
    $match = array();
    $i++;
}


//  echo '<p style="text-aling:center; color:#333;">Total Registros: '. $contador .' de: '. $cantidad_registros .'</p>';
//echo $contador .'  de:  '. $cantidad_registros;
if ($contador === 0) {
  json_output(400, 'Hubo un error al subir el archivo.');
}

json_output(200, 'Archivo subido con exito.', $contador);
?>
<!-- otro -->
<!-- <a href="index.php">Atras</a>    -->