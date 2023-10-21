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

    if (!empty($_POST['name']) && !empty($_POST['grade']) && isset($_FILES['pdf']) && isset($_FILES['image'])) {
        $name = strtoupper($_POST['name']);
        $grade = $_POST['grade'];
        $pdfFile = $_FILES['pdf']; // Cambiado de $file a $pdfFile
        $imageFile = $_FILES['image']; // Cambiado de $image a $imageFile
    
        if ($pdfFile['error'] === 0 && $imageFile['error'] === 0) { // Cambiado de $file a $pdfFile y $image a $imageFile
            $pdfContent = file_get_contents($pdfFile['tmp_name']);
            $imageContent = file_get_contents($imageFile['tmp_name']); // Cambiado de $image a $imageFile
    
            $sql = "INSERT INTO pdfs (name, file, grade, image) VALUES (:name, :file, :grade, :image)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':file', $pdfContent, PDO::PARAM_LOB);
            $stmt->bindParam(':grade', $grade);
            $stmt->bindParam(':image', $imageContent, PDO::PARAM_LOB);
    
            if ($stmt->execute()) {
                $message = 'PDF enviado correctamente';
            } else {
                $message = 'Error al enviar PDF';
            }
        } else {
            $message = 'Error al subir PDF';
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
                        <a href="#" class="nav-link">
                            <i class='bx bx-chat icon'></i>
                            <span class="link">Foro</span>
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
            <label for="image">Suba una imagen a la vez.</label>
            <input type="file" name="image" accept="image/*">
            <label for="pdf">Suba un pdf a la vez.*</label>
            <input type="file" name="pdf" accept=".pdf">    
            <label for="grade">Indique a que año (grado) pertenece el PDF</label>
            <input type="number" name="grade" placeholder="Grado">                  
            <?php if(!empty($message)): ?>
                <p class="text-info"> <?= $message ?></p>
            <?php endif; ?>
            <input type="submit" value="Subir PDF">
        </form>                                                                                             
    </div>
    <script src="../../script.js"></script>
</body>
</html>
