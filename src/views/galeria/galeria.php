<?php
session_start();
require '../../../db.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, username, password from usuarios where id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John Fitzgerald Kennedy | Galería</title>
    <link rel="shortcut icon" href="../../images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../styles/footer.css">
    <link rel="stylesheet" href="../../styles/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar .navbar-expand-lg. fixed-top s">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon "></span>
                </button>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img src="src/images/logo.svg" alt=""
                                width="70" height="94">John F. Kennedy</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../../../index.php"><i
                                        class="bi bi-house bi-ul-r"></i>Inicio</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="bi bi-caret-down bi-ul-r"></i>
                                    Especialidades
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-gear bi-ul-r"></i>Electromecánica</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-motherboard bi-ul-r"></i>Informática</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="./src/views/Biblioteca/biblioteca.html"><i
                                                class="bi bi-laptop bi-ul-r"></i>Programación</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><i
                                        class="bi bi-file-earmark-text bi-ul-r"></i>Inscripción</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../foro/foro.php"><i class="bi bi-chat-left-dots bi-ul-r">Foro</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../biblioteca/biblioteca.php"><i class="bi bi-archive bi-ul-r">Biblioteca</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="galeria.php"><i
                                        class="bi bi-camera bi-ul-r"></i>Galería</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../historia/historia.php"><i
                                        class="bi bi-bank bi-ul-r"></i>Historia</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><i
                                        class="bi bi-envelope-paper bi-ul-r"></i>Contacto</a>
                            </li>
                            <?php if (!empty($user)): ?>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="../admin/panel.php">Panel de administrador</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="../login/login.php"><i class="bi bi-info-circle"></i></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="menu">
            <ul>
                <li><a href="../../../index.php"><i class="bi bi-house bi-ul-r"></i>Inicio</a></li>
                <li class="specialties"><a href="#" class="toggle-icon"><i
                            class="bi bi-caret-down bi-ul-r"></i>Especialidades</a>
                    <ul class="submenu animate__animated animate__fadeIn">
                        <li><a href="#"><i class="bi bi-gear bi-ul-r"></i>Electromecánica</a></li>
                        <li><a href="#"><i class="bi bi-motherboard bi-ul-r"></i>Informática</a></li>
                        <li><a href="#"><i class="bi bi-laptop bi-ul-r"></i>Programación</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="bi bi-file-earmark-text bi-ul-r"></i>Inscripción</a></li>
                <li><a href="../foro/foro.php"><i class="bi bi-chat-left-dots bi-ul-r"></i>Foro</a></li>
                <li><a href="../biblioteca/biblioteca.php"><i class="bi bi-archive bi-ul-r"></i>Biblioteca</a>
                </li>
                <li class="school"><a href="#" class="toggle-icon"><i class="bi bi-caret-down bi-ul-r"></i>Escuela</a>
                    <ul class="submenu animate__animated animate__fadeIn">
                        <li><a href="galeria.php"><i class="bi bi-camera bi-ul-r"></i>Galería</a></li>
                        <li><a href="../historia/historia.php"><i class="bi bi-bank bi-ul-r"></i>Historia</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="bi bi-envelope-paper bi-ul-r"></i>Contacto</a></li>
                <?php if (!empty($user)): ?>
                    <li><a href="../admin/panel.php">Panel de administrador</a></li>
                <?php else: ?>
                    <li><a href="../login/login.php"><i class="bi bi-info-circle"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>
    <p class="heading">CSS Gallery</p>
    <div class="gallery-image">
        <a href="imagenes/img (1).jpg" data-fancybox="gallery" data-caption="Taller de Electromecánica">
            <div class="img-box">
                <img src="imagenes/img (1).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Taller de Electromecánica</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (2).jpg" data-fancybox="gallery" data-caption="Entrada principal">
            <div class="img-box">
                <img src="imagenes/img (2).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Entrada principal</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (3).jpg" data-fancybox="gallery" data-caption="Laboratorio de Programación">
            <div class="img-box">
                <img src="imagenes/img (3).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Laboratorio de Programación</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (4).jpg" data-fancybox="gallery" data-caption="Cuadros honorarios">
            <div class="img-box">
                <img src="imagenes/img (4).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Cuadros honorarios</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (5).jpg" data-fancybox="gallery" data-caption="Entrada al patio">
            <div class="img-box">
                <img src="imagenes/img (5).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Entrada al patio</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (6).jpg" data-fancybox="gallery" data-caption="Taller de carpintería">
            <div class="img-box">
                <img src="imagenes/img (6).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Taller de carpintería</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (7).jpg" data-fancybox="gallery" data-caption="Seccion de tornos mécanicos">
            <div class="img-box">
                <img src="imagenes/img (7).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Seccion de tornos mécanicos</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (8).jpg" data-fancybox="gallery" data-caption="Taller de herrería">
            <div class="img-box">
                <img src="imagenes/img (8).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Patio del colegio</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (9).jpg" data-fancybox="gallery" data-caption="Taller de herrería">
            <div class="img-box">
                <img src="imagenes/img (9).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Taller de herrería</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (25).jpg" data-fancybox="gallery" data-caption="Fundador del colegio">
            <div class="img-box">
                <img src="imagenes/img (25).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Fundador del colegio</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (11).jpg" data-fancybox="gallery" data-caption="Taller de Electromecánica">
            <div class="img-box">
                <img src="imagenes/img (11).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Taller de Electromecánica</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (12).jpg" data-fancybox="gallery" data-caption="Cancha de Fútbol 11">
            <div class="img-box">
                <img src="imagenes/img (12).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Cancha de Fútbol 11</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (13).jpg" data-fancybox="gallery" data-caption="Edificio de teoría">
            <div class="img-box">
                <img src="imagenes/img (13).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Edificio de teoría</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (14).jpg" data-fancybox="gallery" data-caption="Laboratorio de Programación">
            <div class="img-box">
                <img src="imagenes/img (14).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Laboratorio de Programación</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (15).jpg" data-fancybox="gallery" data-caption="Laboratorio de Neumática">
            <div class="img-box">
                <img src="imagenes/img (15).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>Tea Talk</p>
                        <p class="opacity-low">Laboratorio de Neumática</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (16).jpg" data-fancybox="gallery" data-caption="Patio del colegio">
            <div class="img-box">
                <img src="imagenes/img (16).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Patio del colegio</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (17).jpg" data-fancybox="gallery" data-caption="Taller de carpintería">
            <div class="img-box">
                <img src="imagenes/img (17).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Taller de carpintería</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (18).jpg" data-fancybox="gallery" data-caption="Taller de herrería">
            <div class="img-box">
                <img src="imagenes/img (18).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Taller de herrería</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (19).jpg" data-fancybox="gallery" data-caption="Patio del colegio">
            <div class="img-box">
                <img src="imagenes/img (19).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Patio del colegio</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (20).jpg" data-fancybox="gallery" data-caption="Aula de Taller">
            <div class="img-box">
                <img src="imagenes/img (20).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Aula de Taller</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (26).jpg" data-fancybox="gallery" data-caption="Auto fabricado por el colegio">
            <div class="img-box">
                <img src="imagenes/img (26).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Auto fabricado por el colegio</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (28).jpg" data-fancybox="gallery" data-caption="Mural hecho por el centro de estudiantes">
            <div class="img-box">
                <img src="imagenes/img (28).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Mural hecho por el centro de estudiantes</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (23).jpg" data-fancybox="gallery" data-caption="Estacionamiento del colegio">
            <div class="img-box">
                <img src="imagenes/img (23).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Estacionamiento del colegio</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (24).jpg" data-fancybox="gallery" data-caption="Aula de Electromecánica">
            <div class="img-box">
                <img src="imagenes/img (24).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Aula de Electromecánica</p>
                    </div>
                </div>
            </div>
        </a>
        <a href="imagenes/img (27).jpg" data-fancybox="gallery" data-caption="Bancos y sillas reparados por alumnos">
            <div class="img-box">
                <img src="imagenes/img (27).jpg" alt="" />
                <div class="transparent-box">
                    <div class="caption">
                        <p>John F. Kennedy</p>
                        <p class="opacity-low">Bancos y sillas reparados por alumnos</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <footer>
        <div class="footer__container">
            <div class="footer__box">
                <figure class="footer__contimg">
                    <img class="footer__img" src="../../images/logo.png">
                </figure>
            </div>
            <div class="footer__box">
                <h2 class="footer__h2">Redes Sociales</h2>
                <ul class="footer__ul">
                    <li class="footer__1er-item"><a href="https://www.facebook.com/profile.php?id=100000755543895"
                            target="_blank">Facebook</a></li>
                    <li class="footer__1er-item"><a href="https://www.instagram.com/escuelatecnica5lanus/?next=%2F"
                            target="_blank">Instagram</a></li>
                    <li class="footer__1er-item"><a
                            href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcRzBzDMLffdnFrgKFlGmqBpmkfHbDkljwwWdmxXZnVbXXJRNLxTzbDCktZJPdmXlwMdFXWxH"
                            target="_blank">E-mail</a></li>
                </ul>
            </div>
            <div class="footer__box">
                <h2 class="footer__h2">Qué Estudiar</h2>
                <ul class="footer__ul">
                    <li class="footer__1er-item"><a href="Especialidades/programacion/programacion.html"
                            target="_blank">Programación</a></li>
                    <li class="footer__1er-item"><a href="https://www.instagram.com/escuelatecnica5lanus/?next=%2F"
                            target="_blank">Informatica</a></li>
                    <li class="footer__1er-item"><a
                            href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcRzBzDMLffdnFrgKFlGmqBpmkfHbDkljwwWdmxXZnVbXXJRNLxTzbDCktZJPdmXlwMdFXWxH"
                            target="_blank">Electromecánica</a></li>
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
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="../../js/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script type="module" src="main.js"></script>
    <script src="fancy.js"></script>
</body>
</html>