<?php 
    session_start();

    require 'db.php';

    if(isset($_SESSION['user_id'])){
        $records = $conn->prepare('SELECT id, username, password from usuarios where id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if(count($results) > 0){
            $user = $results;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="src/images/logo.png" type="image/x-icon">
    <title>John Fitzgerald Kennedy | EEST N5</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="src/styles/footer.css">
    <link rel="stylesheet" href="src/styles/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar .navbar-expand-lg. fixed-top s">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
                </button>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img src="src/images/logo.svg" alt="" width="70" height="94">John F. Kennedy</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="index.php"><i class="bi bi-house bi-ul-r"></i>Inicio</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-caret-down bi-ul-r"></i>
                                        Especialidades
                                    </a>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear bi-ul-r"></i>Electromecánica</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-motherboard bi-ul-r"></i>Informática</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-laptop bi-ul-r"></i>Programación</a></li>
                                    </ul>
                                </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-file-earmark-text bi-ul-r"></i>Inscripción</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./src/views/foro/foro.php"><i class="bi bi-chat-left-dots bi-ul-r">Foro</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./src/views/biblioteca/biblioteca.php"><i class="bi bi-archive bi-ul-r">Biblioteca</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./src/views/galeria/galeria.php"><i class="bi bi-camera bi-ul-r"></i>Galería</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./src/views/historia/historia.php"><i class="bi bi-bank bi-ul-r"></i>Historia</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-envelope-paper bi-ul-r"></i>Contacto</a>
                            </li>
                            <?php if(!empty($user)): ?>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="./src/views/admin/panel.php">Panel de administrador</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="./src/views/login/login.php"><i class="bi bi-info-circle"></i></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="menu">
            <ul>
                <li><a href="index.php"><i class="bi bi-house bi-ul-r"></i>Inicio</a></li>
                <li class="specialties"><a href="#" class="toggle-icon"><i class="bi bi-caret-down bi-ul-r"></i>Especialidades</a>
                    <ul class="submenu animate__animated animate__fadeIn">
                        <li><a href="#"><i class="bi bi-gear bi-ul-r"></i>Electromecánica</a></li>
                        <li><a href="#"><i class="bi bi-motherboard bi-ul-r"></i>Informática</a></li>
                        <li><a href="#"><i class="bi bi-laptop bi-ul-r"></i>Programación</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="bi bi-file-earmark-text bi-ul-r"></i>Inscripción</a></li>
                <li><a href="./src/views/foro/foro.php"><i class="bi bi-chat-left-dots bi-ul-r"></i>Foro</a></li>
                <li><a href="./src/views/biblioteca/biblioteca.php"><i class="bi bi-archive bi-ul-r"></i>Biblioteca</a></li>
                <li class="school"><a href="#" class="toggle-icon"><i class="bi bi-caret-down bi-ul-r"></i>Escuela</a>
                    <ul class="submenu animate__animated animate__fadeIn">
                        <li><a href="./src/views/galeria/galeria.php"><i class="bi bi-camera bi-ul-r"></i>Galería</a></li>
                        <li><a href="./src/views/historia/historia.php"><i class="bi bi-bank bi-ul-r"></i>Historia</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="bi bi-envelope-paper bi-ul-r"></i>Contacto</a></li>
                <?php if(!empty($user)): ?>
                    <li><a href="./src/views/admin/panel.php">Panel de administrador</a></li>
                <?php else: ?>
                    <li><a href="./src/views/login/login.php"><i class="bi bi-info-circle"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>
    <main class="main">
        <section class="hero">
            <div class="left-section">
                <div class="info">
                    <span>Bienvenido a</span>
                    <h2>EEST N5 <br>JOHN F KENNEDY</br></h2>
                    <p>Somos una institución educativa comprometida con la excelencia académica y 
                        la formación integral de nuestros estudiantes en las áreas de programación, informática y 
                        electromecánica.
                    </p>
                </div>
            </div>
            <div class="rigth-section">
                <img src="./src/images/logo copia.svg" alt="Logo">
            </div>
        </section>
        <section class="hero-mobile">
            <div class="hero-mobile__info">
                <span>Bienvenido a</span>
                <h2>EEST N5 <br>JOHN F KENNEDY</br></h2>
                <img src="./src/images/logo copia.svg" alt="">
            </div>
        </section>
    </main>
    <section class="specialties-section">
        <div class="container-cards">
            <div>
                <h2 class="specialties-title">Especialidades</h2>
            </div>
            <div class="contain">
                <div class="box">
                    <figure>
                        <i class="bi bi-gear-fill"></i>
                    </figure>
                    <h3>Electromecánica</h3>
                    <p>En nuestra orientación de Electromecánica, los estudiantes adquieren habilidades esenciales para trabajar con sistemas eléctricos y mecánicos.</p>
                </div>
                <div class="box">
                    <figure>
                        <i class="bi bi-motherboard-fill"></i>
                    </figure>
                    <h3>Informática</h3>
                    <p>Nuestra orientación en Informática te sumerge en el emocionante mundo de la tecnología. Aprenderás a programar, administrar redes y comprender la ciberseguridad.</p>
                </div>
                <div class="box">
                    <figure>
                        <i class="bi bi-laptop"></i>
                    </figure>
                    <h3>Programación</h3>
                    <p>En nuestra orientación en programación, los estudiantes exploran el emocionante mundo de la codificación y el desarrollo de software.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="imagen">  
    </section>
    <section class="info__cards">
        <div class="card">
            <div class="card__title">
                <h2>Entérese de las últimas noticias.</h2>
                <p class="list">✅ Informese de las novedades de la escuela.</p>
                <p class="list">✅ Conecte con la comunidad escolar.</p>
                <p class="list">✅ Aprenda sobre temas relevantes.</p>
                <p class="list">✅ Participe en la vida escolar.</p>
                <button class="noticias">Ir a últimas noticias.</button>
            </div>
        </div>
        <div class="card">
            <div class="card__title">
                <h2>¿Está pensando inscribirse?</h2>
                <p class="list">✅ Prepárese para el futuro.</p>
                <p class="list">✅ Desarrolle su potencial.</p>
                <p class="list">✅ Conecte con otros.</p>
                <p class="list">✅ Ambiente positivo y acogedor.</p>
                <button class="noticias">Realice la preinscripción.</button>
            </div>
        </div>
    </section>
    <footer>
        <div class="footer__container">
            <div class="footer__box">
                <figure class="footer__contimg">
                    <img class="footer__img" src="./src/images/logo.png">
                </figure>
            </div>
            <div class="footer__box">
                <h2 class="footer__h2">Redes Sociales</h2>
                <ul class="footer__ul">
                    <li class="footer__1er-item"><a href="https://www.facebook.com/profile.php?id=100000755543895" target="_blank">Facebook</a></li>
                    <li class="footer__1er-item"><a href="https://www.instagram.com/escuelatecnica5lanus/?next=%2F" target="_blank">Instagram</a></li>
                    <li class="footer__1er-item"><a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcRzBzDMLffdnFrgKFlGmqBpmkfHbDkljwwWdmxXZnVbXXJRNLxTzbDCktZJPdmXlwMdFXWxH" target="_blank">E-mail</a></li>
                </ul>
            </div>
            <div class="footer__box">
                <h2 class="footer__h2">Qué Estudiar</h2>
                <ul class="footer__ul">
                    <li class="footer__1er-item"><a href="Especialidades/programacion/programacion.html" target="_blank">Programación</a></li>
                    <li class="footer__1er-item"><a href="https://www.instagram.com/escuelatecnica5lanus/?next=%2F" target="_blank">Informatica</a></li>
                    <li class="footer__1er-item"><a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcRzBzDMLffdnFrgKFlGmqBpmkfHbDkljwwWdmxXZnVbXXJRNLxTzbDCktZJPdmXlwMdFXWxH" target="_blank">Electromecánica</a></li>
                </ul>
            </div>
            <div class="footer__box">
                <h2 class="footer__h2">Contacto</h2>
                <ul class="footer__ul">
                    <li class="footer__2do-item"><a href="#">(+54) 9 11 4241-8547</a></li>
                    <li class="footer__2do-item"><a href="#">4240-5026</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="./src/js/vanilla-tilt.js"></script>
    <script src="./src/js/header.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>