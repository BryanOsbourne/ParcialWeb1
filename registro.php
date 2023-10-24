<!DOCTYPE html>
<html lang="en">
<?php

session_start();
if (!isset($_SESSION['user_loged'])) 
{
    header("Location: login.php");
}

if ($_POST) 
{
    $link = new mysqli('aws.connect.psdb.cloud', 'e3a7feva4305ap9bbsqv', 'pscale_pw_1lXfooeYPh8T5zjHjA5EzGjZC5eHUO0M8XTbNsj5aVl', 'parcial');

    if ($link->connect_errno) 
    {
        echo "Falló la conexión a MySQL: (" . $link->connect_errno . ") " . $link->connect_error;
    } else 
    {
        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $correo = $_POST['email'];
        $tipo = $_POST['tipo'];
        $sql = "INSERT INTO usuario (nombre, username, password, correo, tipo) 
        VALUES ('$nombre', '$usuario','$password', '$correo', '$tipo')";

        $result = $link->query($sql);
        if ($result == true) 
        {
            echo "Usuario Creado Exitosamente";
            header("Location: usuarios.php");
        } 
        else 
        {
            echo "Error al crear el Usuario " . $link->error;
        }
    }
    mysqli_close($link);
}

?>

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
            <div class="col-md-2">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
            </div>
            <div class="col-md-2">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese el usuario" required>
            </div>
            <div class="col-md-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
            </div>
            <div class="col-md-2">
                <label for="tipo" class="form-label">Tipo De Usuario</label>
                <select class="form-control" name="tipo">
                    <option value="ADMINISTRADOR">Administrador</option>
                    <option value="USUARIO">Usuario</option>
                </select>
            </div>
            <input type="submit" class="w-100 btn btn-lg btn-primary mt-3" name="save" value="Registrar">
        </form>
    </div>
</body>
</html>