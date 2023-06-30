<?php
	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");
    session_start();
    include_once 'config/database.php';

    $database = new DB();
    $db = $database->getConnection();

    if(isset($_GET['userName']) && isset($_GET['password']) && empty($_SESSION['name']))
    {
        $uname = $_GET['userName'];
        $pass = $_GET['password'];

        if(!empty($uname) && !empty($pass))
        {
            $sql = "SELECT * FROM `accounts` WHERE `user_name`='$uname' AND `password`='$pass' ";
            $result = $db->prepare($sql);
            $result->execute();
            if ($result->rowCount() === 1) {
                $data2 = $result->fetch(PDO::FETCH_ASSOC);
                if ($data2['user_name'] === $uname && $data2['password'] === $pass) {
                    $_SESSION['name'] = $data2['user_name'];
                    $_SESSION['id'] = $data2['id'];
                    echo json_encode([
                        'result' => 'loggedIn',
                        'id' => $data2['id'],
                        'name' => $data2['user_name']
                    ]);
                }
                else{
                    echo json_encode([
                        'result' => 'Invalid Credentials',
                        'name' => $data2['user_name']
                    ]);   
                }
            }
            else{
                echo json_encode([
                    'result' => 'Invalid Credentials',
                    'name' => $data2['user_name']
                ]);   
            }
        }
        else{
            echo json_encode([
                'result' => 'Invalid Credentials',
                'name' => $data2['user_name']
            ]); 
        }
    }
    else{
        echo json_encode([
            'result' => 'Logout first',
            'name' => $data2['user_name']
        ]); 
    }
?>