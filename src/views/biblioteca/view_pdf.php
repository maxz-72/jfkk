<?php
require '../../../db.php';

if (isset($_GET['pdf_name'])) {
    $pdf_name = $_GET['pdf_name'];

    // Consulta SQL para obtener el contenido del PDF por su ID
    $sql = "SELECT name, file FROM pdfs WHERE name = :pdf_name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':pdf_name', $pdf_name);
    $stmt->execute();
    
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pdfName = $row['name'];
        $pdfContent = $row['file'];

        // Configurar las cabeceras HTTP para indicar que es un archivo PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $pdfName . '"');

        // Enviar el contenido del PDF al cliente
        echo $pdfContent;
    } else {
        echo 'PDF no encontrado.';
    }
} else {
    echo 'Nombre del PDF no proporcionado.';
}
?>
