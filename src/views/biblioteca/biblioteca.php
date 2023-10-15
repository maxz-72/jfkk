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
    $sql = "SELECT id, name, grade, file, image FROM pdfs";
    $stmt = $conn->query($sql);
    $pdfs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($pdfs) > 0) {
        foreach ($pdfs as &$pdf) {
            if ($pdf['file'] !== null) {
                $pdf['file'] = base64_encode($pdf['file']);
            }
            if ($pdf['image'] !== null) {
                $pdf['image'] = base64_encode($pdf['image']);
            }
        }
        $pdfsJson = json_encode($pdfs);
    } else {
        $pdfsJson = '[]';
    }                                                                                       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../images/logo.png" type="image/x-icon">
    <title>John Fitzgerald Kennedy | Ver PDFs</title>
    <link rel="stylesheet" href="../../styles/header.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
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
                                    <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-house bi-ul-r"></i>Inicio</a>
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
                                    <li><a class="dropdown-item" href="./src/views/Biblioteca/biblioteca.html"><i class="bi bi-laptop bi-ul-r"></i>Programación</a></li>
                                    </ul>
                                </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-file-earmark-text bi-ul-r"></i>Inscripción</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-camera bi-ul-r"></i>Galería</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-bank bi-ul-r"></i>Historia</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-envelope-paper bi-ul-r"></i>Contacto</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="menu">
            <ul>
                <li><a href="#"><i class="bi bi-house bi-ul-r"></i>Inicio</a></li>
                <li class="specialties"><a href="#" class="toggle-icon"><i class="bi bi-caret-down bi-ul-r"></i>Especialidades</a>
                    <ul class="submenu animate__animated animate__fadeIn">
                        <li><a href="#"><i class="bi bi-gear bi-ul-r"></i>Electromecánica</a></li>
                        <li><a href="#"><i class="bi bi-motherboard bi-ul-r"></i>Informática</a></li>
                        <li><a href="#"><i class="bi bi-laptop bi-ul-r"></i>Programación</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="bi bi-file-earmark-text bi-ul-r"></i>Inscripción</a></li>
                <li><a href="#"><i class="bi bi-chat-left-dots bi-ul-r"></i>Foro</a></li>
                <li><a href="./src/views/biblioteca/biblioteca.php"><i class="bi bi-archive bi-ul-r"></i>Biblioteca</a></li>
                <li class="school"><a href="#" class="toggle-icon"><i class="bi bi-caret-down bi-ul-r"></i>Escuela</a>
                    <ul class="submenu animate__animated animate__fadeIn">
                        <li><a href="#"><i class="bi bi-camera bi-ul-r"></i>Galería</a></li>
                        <li><a href="#"><i class="bi bi-bank bi-ul-r"></i>Historia</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="bi bi-envelope-paper bi-ul-r"></i>Contacto</a></li>
                    <?php if(!empty($user)): ?>
                        <li><a href="./src/views/admin/panel.php">Panel de administrador</a></li>
                    <?php else: ?>
                        <li><a href="./src/views/login/login.php"><i class="bi bi-info-circle"></i></a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </header>
    <nav class="sidebar">
        <div class="wrap">
            <div class="search">
                <input type="text" id="searchTerm" class="searchTerm" placeholder="Buscar...">
                <button type="button" id="searchButton" class="searchButton">
                    <i class="bi bi-search"></i>
                </button>
                    </div>
        </div>
        <div>
            <ul class="lists">
                <li class="list">
                    <a class="nav-link" href="#">
                        <span class="link">1° año</span>
                    </a>
                </li>
                <li class="list">
                    <a class="nav-link" href="#">
                        <span class="link">2° año</span>
                    </a>
                </li>
                <li class="list">
                    <a class="nav-link" href="#">
                        <span class="link">3° año</span>
                    </a>
                </li>
                <li class="list">
                    <a class="nav-link" href="#">
                        <span class="link">4° año</span>
                    </a>
                </li>
                <li class="list">
                    <a class="nav-link" href="#">
                        <span class="link">5° año</span>
                    </a>
                </li>
                <li class="list">
                    <a class="nav-link" href="#">
                        <span class="link">6° año</span>
                    </a>
                </li>
                <li class="list">
                    <a class="nav-link" href="#">
                        <span class="link">7° año</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="lottie-player"></div>
    <div id="pdfLinks" class="pdf-links">
        <?php
            $sql = "SELECT * FROM pdfs";
            $stmt = $conn->query($sql);
            $pdfs = $stmt->fetchAll(PDO::FETCH_ASSOC);                         
            foreach ($pdfs as $pdf) {
                $onlyName = $pdf['name'];
                $pdfPath = 'view_pdf.php?pdf_name=' . $pdf['name'];
                echo '<div class="container">';
                echo "<a href='$pdfPath' class='aPDFS'>$onlyName";
                if ($pdf['image'] !== null) {
                    $imageData = $pdf['image'];
                    $imageType = 'image/png';
                    if ($imageType === 'image/jpeg' || $imageType === 'image/png') {
                        echo '<img src="data:' . $imageType . ';base64,' . base64_encode($imageData) . '" class="img" alt="Imagen">';
                    }
                }else{
                    echo "<img src='../../images/pdf.png' class='img' alt='PDF Icon'>";
                }
                echo '</a>';
                echo '</div>';
            }
        ?>
    </div>
    
    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            const searchText = document.getElementById('searchTerm').value.toUpperCase();
            const pdfLinksContainer = document.getElementById('pdfLinks');
            while (pdfLinksContainer.firstChild) {
                pdfLinksContainer.removeChild(pdfLinksContainer.firstChild);
            }
            const pdfs = <?php echo $pdfsJson; ?>;
                pdfs.forEach(pdf => {
                    const onlyName = pdf.name;
                    const image = pdf.image
                    const pdfPath = 'view_pdf.php?pdf_name=' + pdf.name;
                        if (onlyName.includes(searchText)) {
                            const extension = image.split('.').pop().toLowerCase();
                            const imageType = extension === 'jpg' || extension === 'jpeg' ? 'image/jpeg' :
                                extension === 'png' ? 'image/png' : 'otra';
                            const codeHTML = `
                                <div class="container">
                                    <a href="${pdfPath}" class="aPDFS">
                                        ${onlyName}
                                        <img src="data:${imageType};base64,${image}" class="img" alt="PDF Icon">
                                    </a>
                                </div>`;
                            pdfLinksContainer.innerHTML += codeHTML;
                            document.querySelector('.lottie-player').innerHTML = '';
                        } else {
                            codeHTML = `
                                    <dotlottie-player src="https://lottie.host/72984e55-a4d3-4f5d-930e-d1a672588134/v161dJOcOB.json" background="transparent" speed="1" style="width: 400px; height: 400px;" loop autoplay></dotlottie-player>
                                    <p>Lo siento, no se ha podido encontrar el PDF indicado. Pruebe otro nombre.</p>`;
                                document.querySelector('.lottie-player').innerHTML += codeHTML;
                            pdfLinksContainer.innerHTML = '';
                        }
                    });
                })                                          
    </script>                                                                                                                                                                                                                                    
    <script src="../../js/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
