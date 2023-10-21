<?php
    require '../../../db.php';

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
        header('Location: ../../../index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../images/logo.png" type="image/x-icon">
    <title>John Fitzgerald Kennedy | Panel de administrador</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
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
                        <a href="../../../index.php" class="nav-link">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="link">Inicio</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="./admin_views/pdf_handle/handle_pdf.php" class="nav-link">
                            <i class='bx bx-file-blank icon'></i>
                            <span class="link">Pdfs</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="./admin_views/forum_handle/forum_handle.php" class="nav-link">
                            <i class='bx bx-chat icon'></i>
                            <span class="link">Foro</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="./admin_views/users_handle/users_handle.php" class="nav-link">
                            <i class='bx bx-cylinder icon'></i>
                            <span class="link">Crear usuario</span>
                        </a>
                    </li>                                                                              
                </ul>
                <div class="bottom-cotent">
                    <li class="list">
                        <a href="../../../logout.php" class="nav-link">
                            <i class="bx bx-log-out icon"></i>
                            <span class="link">Cerrar sesión</span>
                        </a>
                    </li>
                </div>
            </div>
        </div>
    </nav>
    <div class="lottie-player">
        <lottie-player src="https://lottie.host/8e1e9d82-659b-44c9-9685-61f99eb732c2/g4rqvM2Bp0.json" background="#ffffff" speed="1" style="width: 300px; height: 300px" loop autoplay direction="1" mode="normal"></lottie-player>
        <span>Vaya al panel lateral para acceder a las funcionalidades de administrador</span>
    </div>
    <script src="../../js/header.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>