<?php
    require '../../../../db.php';

    $query = "SELECT * FROM foro";
    $stmt = $conn->prepare($query);

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
    
?>