<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
  //include_once '../../config/Database.php';
  include_once '../../models/Parking.php';
  include_once '../../models/Slot.php';
  include_once '../../models/Booking.php';
  // Instantiate DB & connect
  //$database = new Database();
  //$db = $database->connect();
  // Instantiate blog post object
  $parking = new Parking;
  $slot= new Slot;
  $booking= new Booking;
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
 
   
  
  $booking->vehicleno=$data->vehicleno;
  $booking->id_user= 1;
  $booking->id_parkingspot=$data->id_parkingspot;
  $booking->hour=$data->hour;
  


// Create Category
if($booking->createBook()) {
  $slot->id_parkingspot = $data->id_parkingspot;
   $slot->etat = 2;
  $slot->UpdateStatus();
    
               
  echo json_encode(
    array('message' => 'Category Created')
  );
} else {
  echo json_encode(
    array('message' => 'Category Not Created')
  );
}




   
   

  








