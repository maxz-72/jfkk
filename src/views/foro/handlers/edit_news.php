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

    if (!empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['description'])){
        $sql = "UPDATE foro SET name = :name, description = :description WHERE id = :id";
        //statement
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':description', $_POST['description']);                           
    
    
        if($stmt->execute()){
            $message = 'Noticia actualizada correctamente';
        }else{
            $message = 'Lo siento, hubo un problema al actualizar la noticia';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="edit_news.php" method="post">
        <input type="number" name="id">
        <input type="text" name="name">
        <input type="text" name="description">
        <input type="submit">
    </form>
</body>
</html>