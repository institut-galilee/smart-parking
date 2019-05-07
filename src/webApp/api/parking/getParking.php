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
 
   
  $parking->id_parkinglot = $data->id_parkinglot;


  

   

  // Create Category
 $res =  $parking->getParking();
 extract($res);

 $park_item = array(
  'id' => $id_parkinglot,
  'name' => $parknom,
  'etat' => $etat,
  'available' => $available,
  'capacity' => $capacity,
  'latitude' => $latitude,
  'longitude' => $longitude,
  'addresse' => utf8_decode ($addresse),
  'zipcode' => $zipcode,
  'cost'=> $cost
);
 
echo json_encode($park_item);
  
  








