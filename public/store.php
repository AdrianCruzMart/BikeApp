<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header('.');
    exit;
}
try {
    $connection = new \PDO(
      'mysql:host=localhost;dbname=producto',
      'uproducto',
      'cproducto',
      array(
        PDO::ATTR_PERSISTENT => true,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
    );
} catch(PDOException $e) {
    header('Location: create.php?op=errorconnection');
    exit;
}
if(isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
} else {
    header('Location: create.php?op=errornombre');
    exit;
}
if(isset($_POST['precio'])) {
    $precio = $_POST['precio'];
} else {
    header('Location: create.php?op=errorprecio');
    exit;
}
$nombre = trim($nombre);
$ok = true;
if(strlen($nombre) < 2 || strlen($nombre) > 100) {
    $ok = false;
}
if(!(is_numeric($precio) && $precio >= 0 && $precio <= 1000000)) {
    $ok = false;
}
if($ok === false) {
    $_SESSION['old']['nombre'] = $nombre;
    $_SESSION['old']['precio'] = $precio;
    header('Location: create.php?op=errordata');
    exit;
}
$sql = 'insert into producto (nombre, precio) values (:nombre, :precio)';
$sentence = $connection->prepare($sql);
$parameters = ['nombre' => $nombre, 'precio' => $precio];
foreach($parameters as $nombreParametro => $valorParametro) {
    $sentence->bindValue($nombreParametro, $valorParametro);
}
if(!$sentence->execute()){
    header('Location: create.php?op=errorsql');
    exit;
}
$resultado = $connection->lastInsertId();
$url = '.?op=insertproducto&resultado=' . $resultado;
//echo $url;
header('Location: ' . $url);
//siempre después de una operación (UPDATE, INSERT, DELETE), redirección