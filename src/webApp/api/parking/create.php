<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
  //include_once '../../config/Database.php';
  include_once '../../models/Parking.php';
  include_once '../../models/Slot.php';
  // Instantiate DB & connect
  //$database = new Database();
  //$db = $database->connect();
  // Instantiate blog post object
  $parking = new Parking;
  $slot= new Slot;
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
 
   
   $parking->name = $data->name;
   $parking->status ='1';  
   $parking->available = $data->capacity;
   $parking->capacity = $data->capacity;
   $parking->latitude = $data->latitude;
   $parking->longitude = $data->longitude;
   $parking->address = $data->address;
   $parking->zipcode = $data->zipcode;
   $parking->cost = $data->cost;

   

  // Create Category
  if($parking->createparking()) {
      $slot->id_parkinglot = $parking->lastParkingInserted();
    for ($i = 1; $i <= $parking->capacity; $i++) {
        
  
        $slot->parkingspotname = "slot".$i;
        
        $slot->createParkingSlot();
        
    }

    echo json_encode(
      array('message' => 'Category Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Category Not Created')
    );
  }








