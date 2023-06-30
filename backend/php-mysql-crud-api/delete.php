<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
      
    include_once 'config/database.php';
    
    $database = new DB();
    $db = $database->getConnection();
       
    $id = $_GET['id'];
    $query = "DELETE FROM `user_details` WHERE id = '$id'";
    $stmt = $db->prepare($query);

    echo json_encode($query);
    if($stmt->execute()){
        return true;
    }
    else{
        return false;
    }
?>
