<?php 

class DeliveryFunctions{
  
  public function foodPickUp($mysqli, $restaurant_id) {
      $status = 5;
      $num = 4;

      $query = "UPDATE notifications SET status = ?  WHERE restaurant_id = ? AND status = ?";  
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("sss", $status, $restaurant_id, $num);
  

    if ($stmt->execute()) {
      echo json_encode("Status updated");
    } else {
      echo json_encode("Status not updated");
    }
  }



  public function DisplayDeliverySuccess($mysqli, $restaurant_id) {
    $status = 5;
   
    $query = "SELECT status FROM notifications WHERE restaurant_id = '$restaurant_id' AND status = $status";
    $res = $mysqli->query($query);
    $statArr       = [];
    while ($rows = $res->fetch_assoc()) {
      $resDataList = array(
        'status'              => $rows['status'],
      );
     array_push($statArr, $resDataList);
    }
    echo json_encode($statArr, JSON_PRETTY_PRINT); 
  }



  public function RiderArrived($mysqli, $restaurant_id, $user_id) {
    $status        = 0;
    $order_status  = 1;
   
    $query = "UPDATE orders SET order_status = '$order_status' WHERE restaurant_id = '$restaurant_id' AND order_status = $status AND user_id = '$user_id'";
    $res = $mysqli->query($query);

    if ($res) {
      echo json_encode('Order status updated');
    }
    else{
      echo json_encode('Order status not updated');
    }
  }

}