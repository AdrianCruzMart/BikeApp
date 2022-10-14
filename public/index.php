<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
try {
    $connection = new PDO(
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
$sql = 'select * from producto order by nombre, id';
$sentence = $connection->prepare($sql);
if(!$sentence->execute()) {
    echo 'no sql';
    exit;
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>dwes</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="..">dwes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="..">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="./">Producto</a>
                    </li>
                </ul>
            </div>
        </nav>
        <main role="main">
            <div class="jumbotron">
                <div class="container">
                    <h4 class="display-4">Productos</h4>
                </div>
            </div>
            <div class="container">
                <?php
                if(isset($_GET['op']) && isset($_GET['resultado'])) {
                    ?>
                    <div class="alert alert-primary" role="alert">
                        Resultado: <?= $_GET['op'] . ' ' . $_GET['resultado'] ?>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <h3>Listado de productos</h3>
                </div>
                <table class="table table-striped table-hover" id="tablaProducto">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <?php
                            if(isset($_SESSION['usuario'])) {
                                ?>
                                <th>Borrar</th>
                                <th>Editar</th>
                                <?php
                            }
                            ?>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($fila = $sentence->fetch()) {
                                ?>
                                <tr >
                                    <td><?php echo $fila['id']; ?></td>
                                    <td><?= $fila['nombre']; ?></td>
                                    <td><?= $fila['precio']; ?></td>
                                    <?php
                                    if(isset($_SESSION['usuario'])) {
                                        ?>
                                        <td><a href="destroy.php?id=<?= $fila['id'] ?>" class = "borrar">Borrar</a></td>
                                        <td><a href="edit.php?id=<?= $fila['id'] ?>">Editar</a></td>
                                        <?php
                                    }
                                    ?>
                                    <td><a href="show.php?id=<?= $fila['id'] ?>">Ver</a></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
                <div class="row">
                    <?php
                    if(isset($_SESSION['usuario'])) {
                        ?>
                        <a href="create.php" class="btn btn-success">agregar producto</a>
                        <?php
                    }
                    ?>
                </div>
                <hr>
            </div>
        </main>
        <footer class="container">
            <p>&copy; IZV 2020</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
    </body>
</html>
<?php
$connection = null;