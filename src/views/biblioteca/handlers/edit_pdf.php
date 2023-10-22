<?php
    session_start();

    require '../../../../db.php';

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

    if (!empty($_POST['id']) && !empty($_POST['name'])){
        $sql = "UPDATE archivos_pdf SET name = :name WHERE id = :id";
        //statement
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->bindParam(':name', $_POST['name']);                          
    
    
        if($stmt->execute()){
            $message = 'Noticia actualizada correctamente';
            header('Location: ../biblioteca.php');
            exit();
        }else{
            $message = 'Lo siento, hubo un problema al actualizar la noticia';
        }
    }

?>