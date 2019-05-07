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
 
   
   
   
   $parking->latitude = $data->latitude;
   $parking->longitude = $data->longitude;

   

   $result = $parking->getAllCollegesNearBy($data->raduis);
  
  // Get row count
  $num = $result->rowCount();
  // Check if any posts
  if($num > 0) {
    // Post array
    $parkings_arr = array();
    // $posts_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
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

      
      // Push to "data"
      array_push($parkings_arr, $park_item);
      // array_push($posts_arr['data'], $post_item);
    }
    // Turn to JSON & output
    echo json_encode($parkings_arr);
  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }

















