<?php


class Notifications{


  public function CheckForNotifications($mysqli, $restaurant_id) {
    $uiEncry  = new IdEncrypt();
    $status   = 0;

    $query = "SELECT * FROM notifications WHERE restaurant_id = '$restaurant_id' AND status = $status"; 
    $res = $mysqli->query($query);
    $NotArr       = [];
    while ($rows = $res->fetch_assoc()) {
      $resDataList = array(
        'notifications_id'        => $uiEncry->useridEencrypt($rows['notifications_id']),
        'message'                 => $rows['message'],
        'status'                  => $rows['status'],
        'time'                    => $rows['time'],
      );
     array_push($NotArr, $resDataList);
    }
   echo json_encode($NotArr, JSON_PRETTY_PRINT);      

  }


  public function changeNotificationStatus($mysqli, $notification_id){
    $status = 1;

    $query = "UPDATE notifications SET status = ?  WHERE notifications_id = ?";
      
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $status, $notification_id);
    

      if ($stmt->execute()) {
        echo json_encode("Status updated");
    } else {
        echo json_encode("Status not updated");
    }

  }



  public function changeReadNotificationStatus($mysqli, $notification_id){
    $read_status = 1;

    $query = "UPDATE notifications SET read_status = ?  WHERE notifications_id = ?";
      
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $read_status, $notification_id);
    

      if ($stmt->execute()) {
        echo json_encode("Status updated");
    } else {
        echo json_encode("Status not updated");
    }

  }







  public function GetNotifications($mysqli, $restaurant_id) {
    $uiEncry  = new IdEncrypt();
    $status   = 1;
    $read_status = 0;

    $query = "SELECT * FROM notifications WHERE restaurant_id = '$restaurant_id' AND status = $status AND read_status = $read_status"; 
    $res = $mysqli->query($query);
    $NotArr       = [];
    while ($rows = $res->fetch_assoc()) {
      $resDataList = array(
        'notifications_id'        => $uiEncry->useridEencrypt($rows['notifications_id']),
        'message'                 => $rows['message'],
        'time'                    => $rows['time'],
      );
      array_push($NotArr, $resDataList);
    }
    echo json_encode($NotArr, JSON_PRETTY_PRINT);      
  
  }


  public function GetRiderNotifications($mysqli) {
    $uiEncry  = new IdEncrypt();
    $status   = 3;
    $read_status = 0;

    $query = "SELECT * FROM notifications WHERE status = $status AND read_status = $read_status"; 
    $res = $mysqli->query($query);
    $NotArr       = [];
    while ($rows = $res->fetch_assoc()) {
      $resDataList = array(
        'notifications_id'        => $uiEncry->useridEencrypt($rows['notifications_id']),
        'message'                 => $rows['message'],
        'time'                    => $rows['time'],
      );
      array_push($NotArr, $resDataList);
    }
    echo json_encode($NotArr, JSON_PRETTY_PRINT);      
  
  }

  



  public function GetReadNotifications($mysqli, $restaurant_id) {
    $uiEncry  = new IdEncrypt();
    $read_status = 1;

    $query = "SELECT * FROM notifications WHERE restaurant_id = '$restaurant_id' AND read_status = $read_status"; 
    $res = $mysqli->query($query);
    $NotArr       = [];
    while ($rows = $res->fetch_assoc()) {
      $resDataList = array(
        'notifications_id'        => $uiEncry->useridEencrypt($rows['notifications_id']),
        'message'                 => $rows['message'],
        'time'                    => $rows['time'],
      );
      array_push($NotArr, $resDataList);
    }
    echo json_encode($NotArr, JSON_PRETTY_PRINT);      
  
  }



  public function NotifyRestaurant($mysqli, $user_id, $restaurant_id, $message, $status) {
    $query = "INSERT INTO notifications (user_id, restaurant_id, message, status) VALUES (?, ?, ?, ?)";
    $res  = $mysqli->prepare($query);
    $res->bind_param("ssss", $user_id, $restaurant_id, $message, $status);

    if($res->execute()){
      echo json_encode("Notification sent");
    }
    else{
      echo json_decode("Notification was not sent");
    }
  }



  public function NotifyRiders($mysqli, $user_id, $restaurant_id, $message, $status) {
    $query = "INSERT INTO notifications (user_id, restaurant_id, message, status) VALUES (?, ?, ?, ?)";
    $res  = $mysqli->prepare($query);
    $res->bind_param("ssss", $user_id, $restaurant_id, $message, $status);

    if($res->execute()){
      echo json_encode("Notification sent");
    }
    else{
      echo json_decode("Notification was not sent");
    }
  }


  public function CheckForRiderNotifications($mysqli) {
    $uiEncry  = new IdEncrypt();
    $status   = 2;

    $query = "SELECT * FROM notifications WHERE status = $status"; 
    $res = $mysqli->query($query);
    $NotArr       = [];
    while ($rows = $res->fetch_assoc()) {
      $resDataList = array(
        'notifications_id'        => $uiEncry->useridEencrypt($rows['notifications_id']),
        'message'                 => $rows['message'],
        'status'                  => $rows['status'],
        'time'                    => $rows['time'],
      );
     array_push($NotArr, $resDataList);
    }
   echo json_encode($NotArr, JSON_PRETTY_PRINT);      

  }




  public function changeRiderNotificationStatus($mysqli, $notification_id){
    $status = 3;

    $query = "UPDATE notifications SET status = ?  WHERE notifications_id = ?";
      
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $status, $notification_id);
    

      if ($stmt->execute()) {
        echo json_encode("Status updated");
      } else {
        echo json_encode("Status not updated");
      }

  }



  public function riderAcceptedOrder($mysqli, $notification_id, $rider_id, $message, $status, $read_status) {

    $rider_number = '#'. rand(111111,999999);
    $update = "UPDATE riders SET rider_number = ?";
    $res = $mysqli->prepare($update);
    $res->bind_param('s', $rider_number);
    $res->execute();

    $query = "UPDATE notifications SET rider_id = ?, status = ?, read_status = ?, message = ?  WHERE notifications_id = ?";  
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssss", $rider_id, $status, $read_status, $message, $notification_id);
    

      if ($stmt->execute()) {
        echo json_encode("Status updated");
      } else {
        echo json_encode("Status not updated");
      }
  }





  public function getRiderInfo($mysqli, $restaurant_id) {
    $uiEncry  = new IdEncrypt();

    $rider = "SELECT * FROM notifications WHERE restaurant_id = '$restaurant_id' AND status = 4";
    $res = $mysqli->query($rider);
    $riderArr       = [];
    $row = $res->fetch_assoc();
    $rider_id = $row['rider_id'];

    if ($restaurant_id == $row['restaurant_id']) {
      $query = "SELECT * FROM riders WHERE rider_id = $rider_id";
      $response = $mysqli->query($query);

      while ($rows = $response->fetch_assoc()) {
        $riderDataList =  array(
          'rider_id'        =>  $uiEncry->useridEencrypt($rows['rider_id']),
          'rider_number'    =>  $rows['rider_number'],
          'rider_name'      => $rows['rider_name'],
          'rider_pic'       => $rows['rider_pic'],
          'rider_contact'   => $rows['rider_contact'],
          'rider_email'     => $rows['rider_email'],
          'longitude'       => $rows['longitude'],
          'latitude'        => $rows['latitude'],
          'status'          => $row['status'],
        );

        array_push($riderArr, $riderDataList);
      }
    }

    echo json_encode($riderArr);


  }




  public function checkRiderAcceptedOrder($mysqli, $restaurant_id) {
    $uiEncry  = new IdEncrypt();
    $status   = 4;

    $query = "SELECT * FROM notifications WHERE restaurant_id = '$restaurant_id' AND status = $status"; 
    $res = $mysqli->query($query);
    $NotArr       = [];
    while ($rows = $res->fetch_assoc()) {
      $resDataList = array(
        'notifications_id'        => $uiEncry->useridEencrypt($rows['notifications_id']),
        'message'                 => $rows['message'],
        'status'                  => $rows['status'],
        'time'                    => $rows['time'],
      );
     array_push($NotArr, $resDataList);
    }
   echo json_encode($NotArr, JSON_PRETTY_PRINT);      

  }



  public function RiderPickUp($mysqli, $restaurant_id) {
    $uiEncry  = new IdEncrypt();
    $status   = 5;

    $query = "SELECT * FROM notifications WHERE restaurant_id = '$restaurant_id' AND status = $status"; 
    $res = $mysqli->query($query);
    $NotArr       = [];
    while ($rows = $res->fetch_assoc()) {
      $resDataList = array(
        'notifications_id'        => $uiEncry->useridEencrypt($rows['notifications_id']),
        'message'                 => $rows['message'],
        'status'                  => $rows['status'],
        'time'                    => $rows['time'],
      );
     array_push($NotArr, $resDataList);
    }
   echo json_encode($NotArr, JSON_PRETTY_PRINT);      

  }



  public function TrackOrder($mysqli, $user_id) {
    $status   = 1;

    $query = "SELECT * FROM notifications WHERE user_id = '$user_id' AND status = $status"; 
    $res = $mysqli->query($query);
    $NotArr       = [];
    while ($rows = $res->fetch_assoc()) {
      $resDataList = array(
        'status'                  => $rows['status'],
      );
     array_push($NotArr, $resDataList);
    }
   echo json_encode($NotArr, JSON_PRETTY_PRINT);      

  }


}