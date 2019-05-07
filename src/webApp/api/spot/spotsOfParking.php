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
  $slot= new Slot;
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  $slot->id_parkinglot = $data->id_parkinglot;

 
  $result = $slot->getAllSlotByParking();

  
  // Get row count
  $num = $result->rowCount();
  // Check if any posts
  if($num > 0) {
    // Post array
    $spots_arr = array();
    // $posts_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $spot_item = array(
        "id_parkingspot"=> $id_parkingspot,
        "parkingspotname"=> $parkingspotname,
        "id_parkinglot"=> $id_parkinglot, 
        "etat"=> $etat
      );

      
      // Push to "data"
      array_push($spots_arr, $spot_item);
      // array_push($posts_arr['data'], $post_item);
    }
    // Turn to JSON & output
    echo json_encode($spots_arr);
  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }







