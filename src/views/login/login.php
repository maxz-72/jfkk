<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();

    require '../../../db.php';

    if(!empty($_POST['username'])  && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT * from usuarios where username = :username');
        $records->bindParam(':username', $_POST['username']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';
        $storedPassword = "administrador";
        $hashedPassword = password_hash($storedPassword, PASSWORD_DEFAULT);

        if ($results !== false) {
            if(count($results) > 0 && password_verify($_POST['password'], $hashedPassword)){
                $_SESSION['user_id'] = $results['id'];
                header("Location: ../../../index.php");
            }else{
                $message = 'Lo siento, credenciales incorrectas, verifique los datos';
            }    
        }else{
            $message = 'Usuario no encontrado';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" action="login.php" id="login-form" class="login-form" autocomplete="off" role="main">
        <h1 class="a11y-hidden">Inicio de sesión</h1>
        <div>
            <label class="label-username">
                <input type="text" class="text" name="username" placeholder="Nombre de usuario" tabindex="1" required />
                <span class="required">Nombre de usuario</span>
            </label>
        </div>
        <input type="checkbox" name="show-password" class="show-password a11y-hidden" id="show-password" tabindex="3" />
        <label class="label-show-password" for="show-password">
            <span>Mostrar contraseña</span>
        </label>
        <div>
            <label class="label-password">
                <input type="text" class="text" name="password" placeholder="Password" tabindex="2" required />
                <span class="required">Contraseña</span>
            </label>
        </div>
        <input type="submit" name="submit" value="Iniciar sesión" />
        <?php if(!empty($message)):?>
            <p class="text-info"> <?= $message ?></p>
        <?php endif;?>
        <figure aria-hidden="true">
            <div class="person-body"></div>
            <div class="neck skin"></div>
            <div class="head skin">
                <div class="eyes"></div>
                <div class="mouth"></div>
            </div>
            <div class="hair"></div>
            <div class="ears"></div>
            <div class="shirt-1"></div>
            <div class="shirt-2"></div>
        </figure>
    </form>
</body>
</html>