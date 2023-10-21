<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require '../../../../db.php';

    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM foro WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Task Deleted Successfully";
        } else {
            echo "Failed to delete task.";
        }
    }else{
        echo "No task selected";
    }                                                               
?>
