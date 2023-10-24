<?php
session_start();
if (!isset($_SESSION['user_loged'])) {
    header("Location: login.php");
	exit();
}

if (isset($_POST['registrar'])) {
    $link = new mysqli('localhost', 'id21445984_admin', 'Adminadmin1!', 'id21445984_parcial');

    if ($link->connect_errno) {
        echo "Falló la conexión a MySQL: (" . $link->connect_errno . ") " . $link->connect_error;
    } else {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $capacidad = $_POST['capacidad'];
        $sql = "INSERT INTO sala (codigo, nombre, capacidad) VALUES ('$codigo', '$nombre','$capacidad')";
        $result = $link->query($sql);
        if ($result == true) {
            echo "Sala creada exitosamente";
            echo "<script>window.location.href = 'sala.php';</script>";
            exit();
        } else {
            echo "Error al crear la sala " . $link->error;
        }
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo de registro de usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li>
                    <a href="index.php" class="nav-link px-2 link-secondary">Funciones</a>
                </li>
                <li>
                    <a href="usuarios.php" class="nav-link px-2 link-secondary">Usuarios</a>
                </li>
                <li>
                    <a href="sala.php" class="nav-link px-2 link-secondary">Salas</a>
                </li>
                <li>
                    <a href="pelicula.php" class="nav-link px-2 link-secondary">Peliculas</a>
                </li>
            </ul>
            <div class="dropdown text-end">
                <a href="" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    <?php echo $_SESSION['user_loged'] ?>
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>

<body>
    <div class="container">
        <form class="row g-3" action="" method="post">
            <h1>Registro De Salas</h1>
            <div class="row">
                <form method="post">
                    <div class="col-md-4">
                        <label for="codigo">Codigo De Sala</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ingrese el codigo de sala" required>
                    </div>
                    <div class="col-md-4">
                        <label for="nombre">Nombre De Sala</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre de la sala" required>
                    </div>
                    <div class="col-md-4">
                        <label for="capacidad">Capacidad</label>
                        <input type="number" class="form-control" id="capacidad" name="capacidad" placeholder="Ingrese la capacidad de sala" required>
                    </div>
                    <input class="w-100 btn btn-lg btn-primary mt-3" type="submit" name="registrar" value="Registrar">
                </form>
            </div>
        </form>
    </div>
</body>
</html>