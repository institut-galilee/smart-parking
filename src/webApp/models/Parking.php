<?php 
	
	class Parking	{
        public $id_parkinglot;
        public $name;
		public $status;
		public $available;
		public $capacity;
		public $latitude;
        public $longitude;
        public $address;
        public $zipcode;
        public $cost;

        private $conn;
		private $tableName = "parkinglots";

		
		public function __construct() {
			require_once('../../config/Database.php');
			$conn = new Database;
			$this->conn = $conn->connect();
        }
        

        public function createparking(){
            
            $sql = "INSERT INTO $this->tableName (`parknom`, `etat`, `available`, `capacity`, `latitude`, `longitude`, `addresse`, `zipcode`, `cost`) VALUES
             (:parknom,:etat,:available,:capacity,:latitude,:longitude,:addresse,:zipcode,:cost) ";

 


            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindParam(':parknom', $this->name);
			$stmt->bindParam(':etat', $this->status);
            $stmt->bindParam(':available', $this->available);
			$stmt->bindParam(':capacity', $this->capacity);
            $stmt->bindParam(':latitude', $this->latitude);
			$stmt->bindParam(':longitude', $this->longitude);
            $stmt->bindParam(':addresse', $this->address);
            $stmt->bindParam(':zipcode', $this->zipcode);
			$stmt->bindParam(':cost', $this->cost);
           

              // Execute query
             if($stmt->execute()) {
             return true;
                }
  // Print error if something goes wrong
                printf("Error: $s.\n", $stmt->error);
                 return false;
        }



        public function lastParkingInserted(){
            $id = $this->conn->lastInsertId();
            return $id;
        }
        


        public function getAllParking(){
            $sql = "SELECT * FROM $this->tableName";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getAllSlotByParking(){
            $sql = "SELECT * FROM parkingspots where id_parkinglot = :id_parkinglot";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_parkingspot',$this->id_parkingspot );   
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
		
        public function getParking(){
            $sql = "SELECT * FROM $this->tableName WHERE id_parkinglot = :id_parkinglot";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_parkinglot',$this->id_parkinglot );   
            
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            

            return $row;
            
        }

        public function deleteParking(){

            $sql = "SELECT FROM $this->tableName WHERE id = :id";


            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id',$this->id_parkinglot);   
			  // Execute query
              if($stmt->execute()) {
                return true;
                   }
     // Print error if something goes wrong
                   printf("Error: $s.\n", $stmt->error);
                    return false;
        }

        public function UpdateAvailibilty($status){

           
                $sql = "UPDATE $this->tableName SET  available = :available  WHERE id_parkinglot = :id_parkinglot";
                $stmt = $this->conn->prepare($sql);
               

                if($status == 1 ){
                    $this->available = $this->available -1;
                }else{
                    $this->available = $this->available +1;
                }
                $stmt->bindParam(':id_parkinglot', $this->id_parkinglot);
                $stmt->bindParam(':available', $this->available);
    
                 // Execute query
                 if($stmt->execute()) {
                return true;
                   }
     // Print error if something goes wrong
                   printf("Error: $s.\n", $stmt->error);
                    return false;


            }

        
            public function getAllCollegesNearBy($raduis) {
                
            $sql =" SELECT *, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(:lng) ) + sin( radians(:lat) ) * sin( radians( latitude ) ) ) ) AS distance FROM parkinglots HAVING distance < :rad ORDER BY distance";
            

                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':lat', $this->latitude);
                $stmt->bindParam(':lng', $this->longitude);
                $stmt->bindParam(':rad', $raduis);
    
    
                $stmt->execute();
                return $stmt;
            }
		
	}
