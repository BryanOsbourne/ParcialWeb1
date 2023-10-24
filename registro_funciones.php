<?php

session_start();
if (!isset($_SESSION['user_loged'])) 
{
    header("Location: login.php");
	exit();
}

require_once("conexion.php");
$con = new conexion();
$link = $con->conectar();

function listarPeliculas($link)
{
    $sql = 'SELECT * FROM pelicula';
    $result = $link->query($sql);
    $arr = array();
    while ($fil = $result->fetch_assoc()) $arr[] = $fil;
    return ($arr);
}

function listarSalas($link)
{
    $sql = 'SELECT * FROM sala';
    $result = $link->query($sql);
    $arr = array();
    while ($fil = $result->fetch_assoc()) $arr[] = $fil;
    return ($arr);
}

$arrPeli = listarPeliculas($con->conectar());
$arrSala = listarSalas($con->conectar());

if ($_POST) 
{
    $link = new mysqli('localhost', 'id21445984_admin', 'Adminadmin1!', 'id21445984_parcial');

    if ($link->connect_errno) 
    {
        echo "Falló la conexión a MySQL: (" . $link->connect_errno . ") " . $link->connect_error;
    } 
    else 
    {
        $codigo = $_POST['codigo'];
        $fecha = $_POST['fecha'];
        $codigoPelicula = $_POST['pelicula'];
        $codigoSala = $_POST['sala'];
        $sql = "INSERT INTO funcion (codigo, fecha, codigo_pelicula, codigo_sala) 
        VALUES ('$codigo', '$fecha','$codigoPelicula', '$codigoSala')";

        $result = $link->query($sql);
        if ($result == true) 
        {
            echo "Funcion Creada Exitosamente";
			echo "<script>window.location.href = 'index.php';</script>";
	        exit();
            
        } else 
        {
            echo "Error al crear el Usuario " . $link->error;
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
            <div class="col-md-2">
                <label for="codigo" class="form-label">Codigo</label>
                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo de funcion" required>
            </div>
            <div class="col-md-2">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Ingrese la fecha" required>
            </div>
            <div class="col-md-6">
            <label for="pelicula" class="form-label">Pelicula</label>
                <select class="form-control" name="pelicula" required>
                <?php for ($i = 0; $i < count($arrPeli); $i++) { ?>
                    <option value="<?php echo $arrPeli[$i]['codigo'] ?>"><?php echo $arrPeli[$i]['nombre'] ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="col-md-2">
            <label for="sala" class="form-label">Sala</label>
            <select class="form-control" name="sala" required>
                <?php for ($i = 0; $i < count($arrSala); $i++) { ?>
                    <option value="<?php echo $arrSala[$i]['codigo'] ?>"><?php echo $arrSala[$i]['nombre'] ?></option>
                <?php } ?>
                </select>
            </div>
            <input type="submit" class="w-100 btn btn-lg btn-primary mt-3" name="save" value="Registrar">
        </form>
    </div>
</body>
</html>