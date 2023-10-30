<?php
    require '../../../../db.php';

    if (isset($_POST['id'])){
        $id = $_POST['id'];
        $query = "DELETE FROM foro WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);  

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Task Deleted Successfully";
        } else {
            echo "Failed to delete task.";
        }
    } else {
        echo "No task selected";
    }
?>
