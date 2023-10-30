<?php
    require '../../../../../db.php';

    session_start();

    $message = '';

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

    if (!empty($_POST['name']) && !empty($_POST['description'])){
        $sql = "INSERT INTO foro (name, description) VALUES (:name, :description)";
        //statement
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':description', $_POST['description']);                           
    
    
        if($stmt->execute()){
            $message = 'Noticia creada correctamente';
        }else{
            $message = 'Lo siento, hubo un problema al crear la noticia';
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
                        <a href="../pdf_handle/handle_pdf.php" class="nav-link">
                            <i class='bx bx-file-blank icon'></i>
                            <span class="link">Pdfs</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="forum_handle.php" class="nav-link">
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
        <form action="forum_handle.php" method="post">
            <div class="form-group">
                <label for="name">Nombre de la noticia</label>
                <input type="text" name="name" placeholder="Nombre de la noticia">
            </div>
            <div class="form-group">
                <label for="description">Descripcion de la noticia</label>
                <textarea name="description" id="description" rows="4" cols="50"></textarea>
            </div>
            <div class="form-group">              
                <input type="submit" value="Crear noticia">
            </div>
            <?php if(!empty($message)): ?>
                <div class="form-group">
                    <p class="text-info"> <?= $message ?></p>
                </div>
            <?php endif; ?>
        </form>                                                                                             
    </div>
    <script src="../../script.js"></script>
</body>
</html>
