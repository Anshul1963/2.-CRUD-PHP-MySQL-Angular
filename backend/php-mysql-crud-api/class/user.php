<?php
    class User{
        // conn
        private $conn;
        // table
        private $dbTable = "user_details";
        // col
        public $id;
        public $name;
        public $email;
        public $mobile;
        public $address;
        public $state;
        public $gender;
        public $message;
        public $newsletter;
      
        // db conn
        public function __construct($db){
            $this->conn = $db;
        }

        // // GET Users
        // public function getUsers($page_num){
        //     $sqlQuery = "SELECT id,name,email,mobile,address,state,gender,message,newsletter FROM " . $this->dbTable . " LIMIT ".$page_num;
        //     $stmt = $this->conn->prepare($sqlQuery);
        //     $stmt->execute();
        //     return $stmt;
        // }


        // // CREATE User
        // public function createUser(){
        //     $sqlQuery = "INSERT INTO". $this->dbTable ."
        //             SET
        //             name = :name, 
        //             email = :email,
        //             mobile = :mobile,
        //             address = :address,
        //             state = :state,
        //             gender = :gender,
        //             message = :message,
        //             newsletter = :newsletter";
        
        //     $stmt = $this->conn->prepare($sqlQuery);
        
        //     // sanitize
        //     $this->name=htmlspecialchars(strip_tags($this->name));
        //     $this->email=htmlspecialchars(strip_tags($this->email));
        //     // $this->mobile = $this->mobile;
        //     // $this->address = $this->address;
        //     // $this->state = $this->state;
        //     // $this->gender = $this->gender; 
        //     // $this->message = $this->message;
        //     // $this->newsletter = $this->newletter; 
                   
        //     // bind data
        //     $stmt->bindParam(":name", $this->name);
        //     $stmt->bindParam(":email", $this->email);
        //     $stmt->bindParam(":mobile", $this->mobile);
        //     $stmt->bindParam(":address", $this->address);
        //     $stmt->bindParam(":state", $this->state);
        //     $stmt->bindParam(":gender", $this->gender);
        //     $stmt->bindParam(":message", $this->message);
        //     $stmt->bindParam(":newsletter", $this->newsletter);
           
        
        //     if($stmt->execute()){
        //        return true;
        //     }
        //     return false;
        // }


        // GET User
        public function getSingleUser(){
            $sqlQuery = "SELECT * FROM". $this->dbTable ." WHERE id = ? LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
            $this->name = $dataRow['name'];
            $this->email = $dataRow['email'];
            $this->mobile = $dataRow['mobile'];
            $this->address = $dataRow['address'];
            $this->state = $dataRow['state'];
            $this->gender = $dataRow['gender'];
            $this->message = $dataRow['message'];
            $this->newsletter = $dataRow['newsletter'];
        }      
        

        // UPDATE User
        public function updateUser(){

            $sqlQuery = "UPDATE
                        ". $this->dbTable ."
                    SET
                    name = :name,  
                    email= :email,
                    mobile = :mobile,
                    address = :address,
                    state = :state,
                    gender = :gender,
                    message =:message,
                    newsletter = :newsletter
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->mobile=htmlspecialchars(strip_tags($this->mobile));
            $this->address=htmlspecialchars(strip_tags($this->address));
            $this->state=htmlspecialchars(strip_tags($this->state));
            $this->gender=htmlspecialchars(strip_tags($this->gender));
            $this->message=htmlspecialchars(strip_tags($this->message));
            $this->newsletter=htmlspecialchars(strip_tags($this->newsletter));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":mobile", $this->mobile);
            $stmt->bindParam(":address", $this->address);
            $stmt->bindParam(":state", $this->state);
            $stmt->bindParam(":gender", $this->gender);
            $stmt->bindParam(":message", $this->message);
            $stmt->bindParam(":newsletter", $this->newsletter);
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        

        // DELETE User
        function deleteUser(){
            $sqlQuery = "DELETE FROM " . $this->dbTable . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>