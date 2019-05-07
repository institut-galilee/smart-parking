<?php 
	
	class Slot	{
        public $id_parkingspot;
        public $parkingspotname;
		public $id_parkinglot;
        public $etat;
        

        private $conn;
		private $tableName = "parkingspots";

		

		public function __construct() {
			require_once('../../config/Database.php');
			$conn = new Database;
			$this->conn = $conn->connect();
        }
        
        

        public function createParkingSlot(){
            
            $sql = "INSERT INTO $this->tableName (`parkingspotname`,`id_parkinglot`, `etat`) VALUES
             (:parkingspotname,:id_parkinglot,:etat) ";

            $stmt = $this->conn->prepare($sql);
            $this->etat = 1;
			$stmt->bindParam(':parkingspotname', $this->parkingspotname);
            $stmt->bindParam(':id_parkinglot', $this->id_parkinglot);
            $stmt->bindParam(':etat',$this->etat);
			
            if($stmt->execute()) {
                return true;
                   }
     // Print error if something goes wrong
                   printf("Error: $s.\n", $stmt->error);
                    return false;

        }

       

        public function getAllSlotByParking(){
            $sql = "SELECT * FROM $this->tableName where id_parkinglot = :id_parkinglot";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_parkinglot',$this->id_parkinglot );   
			$stmt->execute();
			return $stmt;
        }

		
        public function getParkingSlot(){
            $sql = "SELECT * FROM $this->tableName WHERE id_parkingspot = :id_parkingspot";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_parkingspot',$this->id_parkingspot );   
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function deleteParkingSlot(){

            $sql = "SELECT FROM $this->tableName WHERE id_parkingspot = :id_parkingspot";


            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_parkingspot',$this->id_parkingspot);   
        
            if($stmt->execute()) {
                return true;
                   }
     // Print error if something goes wrong
                   printf("Error: $s.\n", $stmt->error);
                    return false;
        }
        public function deleteSlotOfParking($id_parkinglot){
            
                        $sql = "SELECT FROM $this->tableName WHERE id_parkinglot = :id_parkinglot";
            
            
                        $stmt = $this->conn->prepare($sql);
                        $stmt->bindParam(':id_parkinglot',$id_parkinglot );   
                        $stmt->execute();
                        if($stmt->execute()) {
                            return true;
                               }
                 // Print error if something goes wrong
                               printf("Error: $s.\n", $stmt->error);
                                return false;
                    }

        public function UpdateStatus(){

           
                $sql = "UPDATE $this->tableName SET  etat = :etat  WHERE id_parkingspot = :id_parkingspot";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id_parkingspot', $this->id_parkingspot);
                $stmt->bindParam(':etat', $this->etat);
    
                if($stmt->execute()) {
                    return true;
                       }
         // Print error if something goes wrong
                       printf("Error: $s.\n", $stmt->error);
                        return false;
            }

        

		
	}

?>