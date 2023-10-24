<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        body {
            height: 100%;
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body class="text-center">
    <main class="form-signin">
        <form action="" method="post">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <div class="form-floating">
                <input type="username" class="form-control" id="username" name="username" placeholder="Ingrese su usuario" required>
                <label for="username">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                <label for="password">Password</label>
            </div>
            <input class="w-100 btn btn-lg btn-primary" type="submit" name="login" value="login">
        </form>
    </main>
</body>
<?php
phpinfo();
    if (isset($_POST['login'])) 
    {

        $link = new mysqli('aws.connect.psdb.cloud', 'e3a7feva4305ap9bbsqv', 'pscale_pw_1lXfooeYPh8T5zjHjA5EzGjZC5eHUO0M8XTbNsj5aVl', 'parcial');

        if ($link->connect_errno) 
        {
            echo "Falló la conexión a MySQL: (" . $link->connect_errno . ") " . $link->connect_error;
        } 
        else 
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM usuario WHERE username = '$username' and password = '$password'";
            $result = $link->query($sql);

            if ($row = $result->fetch_assoc()) 
            {
                session_start();
                $_SESSION['Reg'] = 'ok';
                $_SESSION['user_loged'] = $row['nombre'];
                $_SESSION['username_loged'] = $username;
                header('Location: index.php');
            } 
            else 
            {
                $_SESSION['Reg'] = 'fail';
                echo "Usuario o Contraseña Incorrecto";
            }
        }
        mysqli_close($link);
    }
?>
</html>