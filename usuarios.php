<?php
session_start();
if (!isset($_SESSION['user_loged'])) {
    header("Location: login.php");
	exit();
}
require_once("conexion.php");

$con = new conexion();
$link = $con->conectar();

function lis($link)
{
    $sql = 'SELECT * FROM usuario';
    $result = $link->query($sql);
    $arr = array();
    while ($fil = $result->fetch_assoc()) $arr[] = $fil;
    return ($arr);
}

$arr = lis($con->conectar());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
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
        <h1>Modulo de administrador</h1>
        <div class="row">
            <div class="col-6">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button class="btn btn-primary" onclick="window.location.href='registro.php';">Nuevo usuario</button>
                </div>
            </div>
            <div class="col-6">
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Username</th>
                        <th>Correo</th>
                        <th>Tipo De Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($arr); $i++) { ?>
                        <tr>
                            <td><?php echo $arr[$i]['nombre'] ?></td>
                            <td><?php echo $arr[$i]['username'] ?></td>
                            <td><?php echo $arr[$i]['correo'] ?></td>
                            <td><?php echo $arr[$i]['tipo'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>