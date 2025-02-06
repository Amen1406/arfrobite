<?php

class PaymentFunctions {


    public function GetAddress($mysqli, $user_id) {
        $uiEncry  = new IdEncrypt();
  
        $query = "SELECT address_id, city, town, street FROM address WHERE user_id = '$user_id'"; 
          $res = $mysqli->query($query);
          $AddArr       = [];
          while ($rows = $res->fetch_assoc()) {
            $resDataList = array(
            'address_id'        => $uiEncry->useridEencrypt($rows['address_id']),
            'city'              => $rows['city'],
            'town'              => $rows['town'],
            'street'            => $rows['street'],
            );
  
            array_push($AddArr, $resDataList);
          }
          echo json_encode($AddArr);
    }



    public function GetOrderInfo($mysqli) {
        $uiEncry  = new IdEncrypt();
  
        $query = "SELECT * FROM orders"; 
          $res = $mysqli->query($query);
          $OrderArr       = [];
          while ($rows = $res->fetch_assoc()) {
            $resDataList = array(
            'order_id'              => $uiEncry->useridEencrypt($rows['order_id']),
            'order_subtotal'        => $rows['order_subtotal'],
            'order_amount'          => $rows['order_amount'],
            );
  
            array_push($OrderArr, $resDataList);
          }
          echo json_encode($OrderArr);
    }
}