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
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo 'no id';
    exit;
}
$sql = 'delete from producto where id = :id';
$sentence = $connection->prepare($sql);
$parameters = ['id' => $id];
foreach($parameters as $nombreParametro => $valorParametro) {
    $sentence->bindValue($nombreParametro, $valorParametro);
}
if(!$sentence->execute()){
    echo 'no sql';
    exit;
}
$resultado = $sentence->rowCount();
$connection = null;
$url = '.?op=deleteproducto&resultado=' . $resultado;
header('Location: ' . $url);