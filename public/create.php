<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header('.');
    exit;
}
$precio = '';
$nombre = '';
if(isset($_SESSION['old']['nombre'])) {
    $nombre = $_SESSION['old']['nombre'];
    unset($_SESSION['old']['nombre']);
}
if(isset($_SESSION['old']['precio'])) {
    $precio = $_SESSION['old']['precio'];
    unset($_SESSION['old']['precio']);
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
                    <h4 class="display-4">Agregar productos</h4>
                </div>
            </div>
            <div class="container">
                <?php
                if(isset($_GET['op'])) {
                    ?>
                    <div class="alert alert-primary" role="alert">
                        Resultado: <?= $_GET['op'] ?>
                    </div>
                    <?php
                }
                ?>
                <div>
                    <form action="store.php" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre del producto</label>
                            <input value="<?= $nombre ?>" required type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce el nombre del producto">
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio del producto</label>
                            <input value="<?= $precio ?>" required type="number" step="0.001" class="form-control" id="precio" name="precio" placeholder="Introduce el precio del producto">
                        </div>
                        <button type="submit" class="btn btn-primary">Alta</button>
                    </form>
                </div>
                <hr>
            </div>
        </main>
        <footer class="container">
            <p>&copy; IZV 2020</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>