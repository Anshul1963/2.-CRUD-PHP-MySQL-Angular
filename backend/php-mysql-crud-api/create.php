<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");

    include_once 'config/database.php';

    $database = new DB();
    $db = $database->getConnection();

    $data = json_decode(file_get_contents("php://input")); 

    try { 
        $name = htmlspecialchars(trim($data->name));
        $email = htmlspecialchars(trim($data->email));
        $mobile = htmlspecialchars(trim($data->mobile));
        $address = $data->address;
        $state = $data->state;
        $gender = $data->gender;
        $message = $data->message;
        $newsletter = $data->newsletter;

        if( !empty($name) && !empty($email) && !empty($mobile) && !empty($address) && !empty($state) 
            && !empty($gender) && !empty($message))
        {
            $query = "INSERT INTO `user_details` (name,email,mobile,address,state,gender,message,newsletter) 
                VALUES('$name','$email','$mobile','$address','$state','$gender','$message','$newsletter')";
        }
        $stmt = $db->prepare($query);
 
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':mobile', $mobile, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':state', $state, PDO::PARAM_STR);
        $stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
        $stmt->bindValue(':message', $message, PDO::PARAM_STR);
        $stmt->bindValue(':newsletter', $newsletter, PDO::PARAM_STR);   

        if ($stmt->execute()) {
            http_response_code(201);
            echo json_encode([
                'success' => 1,
                'message' => 'Data Inserted Successfully.',
            ]);
            exit;
        }
        else{
            echo json_encode([
                'success' => 0,
                'message' => 'There is some problem in data inserting'
            ]);
            exit;
        }
 
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
