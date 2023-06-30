<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: X-Requested-With,Content-Type, Origin, Cache-Control, Pragma,Authorization,Accept,Accept-Encoding");
    header("Content-Type: application/json;");
    
    include_once 'config/database.php';

    $database = new DB();
    $db = $database->getConnection();

    if (isset($_GET['id'])){
        $sId = $_GET['id'];
    }

    try {
        $sql = is_numeric($sId) ? "SELECT * FROM `user_details` WHERE id='$sId'" : "SELECT * FROM `user_details`";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) :
            $data = null;
            if ($sId) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            echo json_encode($data);

        else :
            echo json_encode([
                'success' => 0,
                'message' => 'No Record Found!',
                'error'=>$stmt,
            ]);
        endif;
    } 
    catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
            'success' => 0,
            'message' => $e->getMessage()
        ]);
        exit;
    }
?>