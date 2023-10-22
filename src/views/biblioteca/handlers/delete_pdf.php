<?php
    require '../../../../db.php';

    if (isset($_POST['id'])){
        $id = $_POST['id'];

        $query = "SELECT ruta_pdf FROM archivos_pdf WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            $deleteQuery = "DELETE FROM archivos_pdf WHERE id = :id";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($deleteStmt->execute()) {
                $rutaArchivo = '../' . $result['ruta_pdf'];
                if (file_exists($rutaArchivo)) {
                    unlink($rutaArchivo);
                }
            }
        }
    }
?>
