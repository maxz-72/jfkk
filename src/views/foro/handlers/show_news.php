<?php
    require '../../../../db.php';

    $search = $_POST['search'];
    if(!empty($search)) {
        $query = "SELECT * FROM foro WHERE name LIKE :search";
        $stmt = $conn->prepare($query);

        $searchValue = $search . '%';
        $stmt->bindParam(':search', $searchValue);
        

        if ($stmt->execute()) {
            $json = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $json[] = array(
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'id' => $row['id']
                );
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        } else {
            die('Query Error');
        }
    }
?>