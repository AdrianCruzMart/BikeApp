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
    echo 'no connection';
    exit;
}
if(isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
} else {
    echo 'no nombre';
    exit;
}
if(isset($_POST['precio'])) {
    $precio = $_POST['precio'];
} else {
    echo 'no precio';
    exit;
}
if(isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    echo 'no id';
    exit;
}
$sql = 'update producto set nombre = :nombre, precio = :precio where id = :id';
$sentence = $connection->prepare($sql);
$parameters = ['nombre' => $nombre, 'precio' => $precio, 'id' => $id];
foreach($parameters as $nombreParametro => $valorParametro) {
    $sentence->bindValue($nombreParametro, $valorParametro);
}
if(!$sentence->execute()){
    echo 'no sql';
    exit;
}
$resultado = $sentence->rowCount();
$url = '.?op=editproducto&resultado=' . $resultado;
header('Location: ' . $url);