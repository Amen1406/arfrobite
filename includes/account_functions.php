<?php

class GetProfile{
   public function GetUserProfile($mysqli, $user_id){
    $uiEncry  = new IdEncrypt();

    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $res = $mysqli->query($query);
    $UserArr       = [];
        while ($rows = $res->fetch_assoc()) {
          $resDataList = array(
            'user_id'           => $uiEncry->useridEencrypt($rows['user_id']),
            'first_name'        => $rows['first_name'],
            'last_name'         => $rows['last_name'],
            'profile_picture'   => $rows['profile_pic'],
            'phone_number'      => $rows['phone_number'],
            'email'             => $rows['email'],
          );
         array_push($UserArr, $resDataList);
        }
     echo json_encode($UserArr);    
   }



   public function GetResProfile($mysqli, $restaurant_id){
    $uiEncry  = new IdEncrypt();

    $query = "SELECT * FROM restaurants WHERE restaurant_id = '$restaurant_id'";
    $res = $mysqli->query($query);
    $ResArr       = [];
    $rows = $res->fetch_assoc();
    
      $resDataList = array(
        'restaurant_name'      => $rows['restaurant_name'],
        'restaurant_picture'   => $rows['restaurant_picture'],
        'owner'                => $rows['owner'],
        'number_of_workers'    => $rows['number_of_workers'],
        'contact'              => $rows['contact'],
        'email'                => $rows['email'],
        'restaurant_type'      => $rows['restaurant_type'],
        'working_hours'        => $rows['working_hours'],
        'location'             => $rows['location'],
        'ratings'              => $rows['ratings'],
      );
     array_push($ResArr, $resDataList);
    
    echo json_encode($ResArr, JSON_PRETTY_PRINT);      
 
   }
}