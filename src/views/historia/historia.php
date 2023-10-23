<?php
    session_start();
    require '../../../db.php';

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../styles/footer.css">
    <link rel="stylesheet" href="../../styles/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>John Fitzgerald Kennedy | Historia</title>
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
                                    <a class="nav-link active" aria-current="page" href="../../../index.php"><i class="bi bi-house bi-ul-r"></i>Inicio</a>
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
                                <a class="nav-link active" aria-current="page" href="../foro/foro.php"><i class="bi bi-chat-left-dots bi-ul-r">Foro</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../biblioteca/biblioteca.php"><i class="bi bi-archive bi-ul-r">Biblioteca</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../galeria/galeria.php"><i class="bi bi-camera bi-ul-r"></i>Galería</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="galeria.php"><i class="bi bi-bank bi-ul-r"></i>Historia</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-envelope-paper bi-ul-r"></i>Contacto</a>
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
                <li class="specialties"><a href="#" class="toggle-icon"><i class="bi bi-caret-down bi-ul-r"></i>Especialidades</a>
                    <ul class="submenu animate__animated animate__fadeIn">
                        <li><a href="#"><i class="bi bi-gear bi-ul-r"></i>Electromecánica</a></li>
                        <li><a href="#"><i class="bi bi-motherboard bi-ul-r"></i>Informática</a></li>
                        <li><a href="#"><i class="bi bi-laptop bi-ul-r"></i>Programación</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="bi bi-file-earmark-text bi-ul-r"></i>Inscripción</a></li>
                <li><a href="../foro/foro.php"><i class="bi bi-chat-left-dots bi-ul-r"></i>Foro</a></li>
                <li><a href="../biblioteca/biblioteca.php"><i class="bi bi-archive bi-ul-r"></i>Biblioteca</a></li>
                <li class="school"><a href="#" class="toggle-icon"><i class="bi bi-caret-down bi-ul-r"></i>Escuela</a>
                    <ul class="submenu animate__animated animate__fadeIn">
                        <li><a href="../galeria/galeria.php"><i class="bi bi-camera bi-ul-r"></i>Galería</a></li>
                        <li><a href="historia.php"><i class="bi bi-bank bi-ul-r"></i>Historia</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="bi bi-envelope-paper bi-ul-r"></i>Contacto</a></li>
                <?php if(!empty($user)): ?>
                    <li><a href="../admin/panel.php">Panel de administrador</a></li>
                <?php else: ?>
                    <li><a href="../login/login.php"><i class="bi bi-info-circle"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>
    <section>
        <div class="timeline-container" id="timeline-1">
            <div class="timeline-header">
                <h2 class="timeline-header__title">Nuestra Historia</h2>
                <h3 class="timeline-header__subtitle">E.E.S.T.N°5 
                JOHN F. KENNEDY</h3>
            </div>
            <div class="timeline">
                <div class="timeline-item" data-text="CREACIÓN DE ESCUELAS DE ARTES Y OFICIOS">
                    <div class="timeline__content"><img class="timeline__img" src="fotos/15.jpeg"/>
                    <h2 class="timeline__content-title">1943</h2>
                    <p class="timeline__content-desc">El 17 de abril de 1943, el Poder Ejecutivo Nacional resolvió, mediante el decreto N°148065, la creación de Escuelas de Artes y Oficios con el propósito de proporcionar formación y preparación a obreros calificados en diversas actividades industriales.</p>
                </div>
            </div>
            <div class="timeline-item" data-text="EXPANSIÓN DE LA ESCUELA">
                <div class="timeline__content"><img class="timeline__img" src="http://gazetemanifesto.com/wp-content/uploads/2015/11/mustafa-kemal.jpg"/>
                    <h2 class="timeline__content-title">1944</h2>
                    <p class="timeline__content-desc">En 1944, la Escuela ya tenía 150 alumnos y necesitó habilitar un nuevo taller. El Sr. Juan Rassetto puso a disposición tres casas destinadas a vivienda que fueron adaptadas para la instalación del establecimiento.</p>
                </div>
            </div>
            <div class="timeline-item" data-text="NUEVA UBICACIÓN">
                <div class="timeline__content"><img class="timeline__img" src="http://i.cdn.ensonhaber.com/resimler/diger/ataturk_3473.jpg"/>
                    <h2 class="timeline__content-title">1945</h2>
                    <p class="timeline__content-desc">En 1945, la Escuela se trasladó a su nuevo y cómodo local, con amplios talleres modernamente equipados para la época. Este local estaba ubicado en la calle Basavilbaso 2073, en Lanús Este.</p>
                </div>
            </div>
            <div class="timeline-item" data-text="CONVERSIÓN EN ESCUELA INDUSTRIAL">
                <div class="timeline__content"><img class="timeline__img" src="http://cdn.yemek.com/uploads/2014/11/ataturk-10-kasim.jpg"/>
                    <h2 class="timeline__content-title">1952</h2>
                    <p class="timeline__content-desc">En 1952, la escuela se convirtió en la Escuela Industrial de la Nación, especializándose en Mecánica en su ciclo superior.</p>
                </div>
            </div>
            <div class="timeline-item" data-text="CREACIÓN DE LA COOPERATIVA">
                <div class="timeline__content"><img class="timeline__img" src="fotos/coperativa.jpeg"/>
                    <h2 class="timeline__content-title">1959</h2>
                    <p class="timeline__content-desc">En agosto de 1959, se formó la Cooperativa de Producción, Consumo y Edificación de la Escuela Industrial de la Nación Lanús Ltda.  Esta cooperativa tenía como objetivo principal construir el edificio necesario para el establecimiento y equipar sus instalaciones. </p>
            </div>
            </div>
                <div class="timeline-item" data-text="CAMBIO DE NOMBRE">
                    <div class="timeline__content"><img class="timeline__img" src="https://cdn.britannica.com/32/172732-138-941D1E2C/overview-John-F-Kennedy.jpg"/>
                        <h2 class="timeline__content-title">1964</h2>
                        <p class="timeline__content-desc">En homenaje al presidente de los Estados Unidos, asesinado en 1963, John Fitzgerald Kennedy, las autoridades de la escuela, y las del C.O.N.E.T., decidieron instituir su nombre al establecimieto en un acto realizado el 4 de julio de 1964.</p>
                    </div>
                </div>
                <div class="timeline-item" data-text="EXPANSIÓN Y NUEVA ESPECIALIDAD">
                    <div class="timeline__content"><img class="timeline__img" src="fotos/2.jpeg"/>
                        <h2 class="timeline__content-title">1968</h2>
                        <p class="timeline__content-desc">En 1968, comenzó a funcionar el taller en el nuevo edificio. Ocupaba las dos aulas que hoy son laboratorios del ciclo superior, ya que todavía no estaba terminado el techo que cubre los talleres. Al año siguiente se mudó totalmente el taller y se habilitaron en el piso superior la preceptoría y dos aulas de dibujo. Simultáneamente se incorporaba una nueva especialidad: Electromecánica.</p>
                    </div>
                </div>
                <div class="timeline-item" data-text="CREACIÓN Y APERTURA DEL ANEXO">
                    <div class="timeline__content"><img class="timeline__img" src="fotos/0.jpeg"/>
                        <h2 class="timeline__content-title">1984</h2>
                        <p class="timeline__content-desc">
                        En diciembre de 1984, se creó el Anexo de la E.N.E.T. Nº1 como solución a la creciente demanda de estudiantes. Y en mayo de 1986, el Anexo abrió sus puertas con cuatro divisiones de primer año y dos de segundo año.
                        </p>
                    </div>
                </div>
                <div class="timeline-item" data-text="TRANSFORMACIÓN EN ESCUELA Nº3">
                    <div class="timeline__content"><img class="timeline__img" src="fotos/0.jpeg"/>
                        <h2 class="timeline__content-title">1988</h2>
                        <p class="timeline__content-desc">
                        En 1988, el Anexo se convirtió en la Escuela Nacional de Educación Técnica Nº3 de Lanús, especializándose en Electrónica.
                    </p>
                    </div>
                </div>
                <div class="timeline-item" data-text="INCORPORACIÓN DE LA INFORMÁTICA">
                    <div class="timeline__content"><img class="timeline__img" src="fotos/1.jpeg"/>
                        <h2 class="timeline__content-title">1997</h2>
                        <p class="timeline__content-desc">
                        En 1997, la escuela agregó la modalidad Informática, abriendo nuevas divisiones y aumentando las vacantes.
                        </p>
                    </div>
                </div>
                <div class="timeline-item" data-text="RECUPERACIÓN DE ALUMNOS DE 8º Y 9º AÑO">
                    <div class="timeline__content"><img class="timeline__img" src="fotos/14.jpeg"/>
                        <h2 class="timeline__content-title">2004</h2>
                        <p class="timeline__content-desc">
                        En 2004, se recuperó la pertenencia de los alumnos de 8º y 9º año, y en 2005 se incorporó el 7º año.
                        </p>
                    </div>
                </div>
                <div class="timeline-item" data-text="UNIDAD ACADÉMICA">
                    <div class="timeline__content"><img class="timeline__img" src="fotos/0.jpeg"/>
                        <h2 class="timeline__content-title">ACTUALIDAD</h2>
                        <p class="timeline__content-desc">
                        Actualmente, la escuela opera como una única unidad académica con alrededor de 1100 alumnos en Ciclo Básico y Ciclo Superior, especializándose en Electromecánica, Programacion e Informática.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    <script src="../../js/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>
</html>
