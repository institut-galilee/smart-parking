<?php 
	
	class Booking	{
		public $id_booking;
		public $vehicleno;
		public $id_user;
		public $id_parkingspot;
        public $startTime;
        public $hours;
        public $paid;
        
		private $conn;
		private $tableName = "bookings";

		

		public function __construct() {
			require_once('../../config/Database.php');
			$conn = new Database;
			$this->conn = $conn->connect();
        }
        

        public function createBook(){
            $sql = "INSERT INTO $this->tableName (`vehicleno`, `id_user`, `id_parkingspot`,`hour`)
             VALUES (:vehicleno,:id_user,:id_parkingspot,:hour) ";

			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':vehicleno', $this->vehicleno);
			$stmt->bindParam(':id_user', $this->id_user);
            $stmt->bindParam(':id_parkingspot', $this->id_parkingspot);
            $stmt->bindParam(':hour', $this->hour);
            
            if($stmt->execute()) {
                return true;
                   }
     // Print error if something goes wrong
                   printf("Error: $s.\n", $stmt->error);
                    return false;
			
        }

        public function getAllBooking(){
            $sql = "SELECT * FROM $this->tableName";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

		
        public function getBook(){
            $sql = "SELECT * FROM $this->tableName WHERE id_booking = :id_booking";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_booking',$this->id_booking );   
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function deleteBook(){

            $sql = "SELECT FROM $this->tableName WHERE id_booking = :id_booking";


            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_booking',$this->id_booking );   
            if($stmt->execute()) {
                return true;
                   }
     // Print error if something goes wrong
                   printf("Error: $s.\n", $stmt->error);
                    return false;

		
    }
    
}
