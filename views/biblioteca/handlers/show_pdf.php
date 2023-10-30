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
    }

    $permissions = !empty($user);
    $search = $_POST['search'];
    if(!empty($search)) {
        $query = "SELECT * FROM archivos_pdf WHERE name LIKE :search";
        $stmt = $conn->prepare($query);

        $searchValue = $search . '%';
        $stmt->bindParam(':search', $searchValue);

        if ($stmt->execute()) {
            $json = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $json[] = array(
                    'name' => $row['name'],
                    'ruta_pdf' => $row['ruta_pdf'],
                    'id' => $row['id'],
                    'permissions' => $permissions
                );
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        } else {
            die('Query Error');
        }
    }
?>