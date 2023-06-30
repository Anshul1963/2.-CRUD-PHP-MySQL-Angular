<?php 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: X-Requested-With,Content-Type, Origin, Cache-Control, Pragma, Authorization,Accept, Accept-Encoding");
    header("Content-Type: application/json;");
    
    include_once 'config/database.php';
   
    $database = new DB();
    $db = $database->getConnection();


 // PAGINATION
    if (isset($_GET['pageNo'])){
        $pageNo = $_GET['pageNo'];
    }
        $limit = 5;
        $offset = ($pageNo-1) * $limit;
        $sql = "SELECT * FROM `user_details`";
        $result = $db->prepare($sql);
        $result->execute();
        $totalRows = $result->rowCount();
        $totalPages = ceil($totalRows / $limit);

        $sqlQuery = "SELECT * FROM `user_details` LIMIT $offset, $limit";
        $stmt = $db->prepare($sqlQuery);
        $stmt->execute();


    // SEARCHING
    if(isset($_GET['searchInput']) && isset($_GET['searchBy']))
    {   
        $searchInput = $_GET['searchInput']; 
        $searchBy = $_GET['searchBy'];   
        $sql = "SELECT * FROM `user_details` WHERE ".$searchBy." LIKE '%".$searchInput."%'";
        $stmt = $db->prepare($sql); 
        $stmt->execute();
    }

    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $userArr = array();
       
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "mobile" => $mobile,
                "address" => $address,
                "state" => $state,
                "gender" => $gender,
                "message" => $message,
                "newsletter" => $newsletter,
            );

            array_push($userArr, $e);
        }
        echo json_encode($userArr);
    }
?>