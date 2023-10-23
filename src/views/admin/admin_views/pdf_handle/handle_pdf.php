<?php
    require '../../../../../db.php';

    session_start();

    if(isset($_SESSION['user_id'])){
        $records = $conn->prepare('SELECT id, username, password from usuarios where id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if(count($results) > 0){
            $user = $results;
        }
    }else{
        header('Location: ../../../../../index.php');
        exit();
    }

    if (isset($_FILES['pdf']) && !empty($_POST['name'])){
        $nombreArchivo = $_FILES['pdf']['name'];
        $rutaTemporal = $_FILES['pdf']['tmp_name'];
        $rutaDestino = '../../../biblioteca/pdfs/' . $nombreArchivo;
        $ruta_fija = 'pdfs/' . $nombreArchivo;

        if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
            echo "Archivo subido con éxito.";
        } else {
            echo "Error al subir el archivo.";
        }

        $sql = "INSERT INTO archivos_pdf (name, ruta_pdf) VALUES (:name, :ruta_pdf)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':ruta_pdf', $ruta_fija);

        if($stmt->execute()){
            $message = 'Pdf enviado correctamente';
        }else{
            $message = 'Lo siento, hubo un problema al enviar el pdf';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../../images/logo.png" type="image/x-icon">
    <title>John Fitzgerald Kennedy | Panel de administrador</title>
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="logo">
            <i class="bx bx-menu menu-icon"></i>
        </div>
        <div class="sidebar">
            <div class="logo">
                <i class="bx bx-menu menu-icon"></i>
                <span class="logo-name">Dashboard</span>
            </div>
            <div class="sidebar-content">
                <ul class="lists">
                    <li class="list">
                        <a href="../../../../../index.php" class="nav-link">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="link">Inicio</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="handle_pdf.php" class="nav-link">
                            <i class='bx bx-file-blank icon'></i>
                            <span class="link">Pdfs</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="../forum_handle/forum_handle.php" class="nav-link">
                            <i class='bx bx-chat icon'></i>
                            <span class="link">Foro</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="../users_handle/users_handle.php" class="nav-link">
                            <i class='bx bx-cylinder icon'></i>
                            <span class="link">Crear usuario</span>
                        </a>
                    </li>                                                                              
                </ul>
                <div class="bottom-cotent">
                    <li class="list">
                        <a href="../../../../../logout.php" class="nav-link">
                            <i class="bx bx-log-out icon"></i>
                            <span class="link">Cerrar sesión</span>
                        </a>
                    </li>
                </div>
            </div>
        </div>
    </nav>
    <div class="form__container">
        <form action="handle_pdf.php" method="post" enctype="multipart/form-data">
            <label for="name">Nombre del PDF:</label>
            <input type="text" name="name" placeholder="Nombre del PDF">
            <label for="pdf">Suba un pdf a la vez.*</label>
            <input type="file" name="pdf" accept=".pdf">    
            <?php if(!empty($message)): ?>
                <p class="text-info"> <?= $message ?></p>
            <?php endif; ?>
            <input type="submit" value="Subir PDF">
        </form>                                                                                             
    </div>
    <script src="../../script.js"></script>
</body>
</html>
