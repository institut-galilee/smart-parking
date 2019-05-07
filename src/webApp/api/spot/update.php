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
  $id1 = $data->id1;
  $id2 = $data->id2;

 $value1 =  $data->value1;
 $value2 =  $data->value2;


  
    $slot->id_parkingspot = $id1;  
    $res=$slot->getParkingSlot();
    $slot->etat = $value1;
    if( $res['etat'] != $slot->etat ){
        $parking->id_parkinglot=$res['id_parkinglot'];
        $slot->UpdateStatus();
        $park = $parking->getParking();

      
        
        $parking->available = $park['available'];
        $parking->UpdateAvailibilty($slot->etat);
    }

    $slot->id_parkingspot = $id2;  
    $res=$slot->getParkingSlot();
    $slot->etat = $value2;
    if( $res['etat'] != $slot->etat ){
        $parking->id_parkinglot=$res['id_parkinglot'];
        $slot->UpdateStatus();
        $park = $parking->getParking();

      
        
        $parking->available = $park['available'];
        $parking->UpdateAvailibilty($slot->etat);
    }



/*foreach( $data as $row ){

    $slot->id_parkingspot = $row->id;  
    $res=$slot->getParkingSlot();
    $slot->etat = $row->value;
    if( $res['etat'] != $slot->etat ){
        $parking->id_parkinglot=$res['id_parkinglot'];
        $slot->UpdateStatus();
        $park = $parking->getParking();

      
        
        $parking->available = $park['available'];
        $parking->UpdateAvailibilty($slot->etat);
    }
    
}*/
  
   

  
    
    echo json_encode(
      array('message' => "etat updated")
    );

  








