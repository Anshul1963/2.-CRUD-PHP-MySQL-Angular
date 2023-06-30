<?php
	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");

    include_once 'config/database.php';
   	
   	$database = new DB();
    $db = $database->getConnection();
        
    if( isset($_GET['userName']) && isset($_GET['password']) && isset($_GET['email']) )
    {
        $Email = $_GET['email'];
        $uname = $_GET['userName'];
        $pass = $_GET['password'];
        $sql = "INSERT INTO `accounts` (`email`, `user_name`, `password`)
                VALUES('$Email', '$uname', '$pass')";
        $result = $db->prepare($sql);
        $result->execute();
        if($result->execute() == TRUE){
            echo json_encode([
                'result' => 'User Created',
            ]);
        }
        else{
            echo json_encode([
                'result'=> 'User already Existed!'
            ]);
        }
    }
?>