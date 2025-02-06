<?php

class OrderSystem{



  public function getOrderDetails($mysqli, $user_id) {
    $uiEncry  = new IdEncrypt();
    
    $query = "SELECT * FROM  orders"; 
    $response = $mysqli->query($query);
    $orderArr       = [];

    if ($row = $response->fetch_assoc()){
        $sub_query = "SELECT item_name, item_quantity, item_pic FROM cart WHERE user_id = '$user_id'";
        $res = $mysqli->query($sub_query);
        
        while ($rows = $res->fetch_assoc()) {
            $resDataList = array(
                'order_id'               => $uiEncry->useridEencrypt($row['order_id']),
                'cart_id'                => $uiEncry->useridEencrypt($row['cart_id']),
                'dish_id'                => $uiEncry->useridEencrypt($row['dish_id']),
                'order_quantity'         => $row['order_quantity'],
                'order_subtotal'         => $row['order_subtotal'],
                'order_amount'           => $row['order_amount'],
                'delivery_status'        => $row['delivery_status'],
                'order_status'           => $row['order_status'],
                'order_number'           => $row['order_number'],
                'order_time'             => $row['order_time'],
                'item_name'              => $rows['item_name'],
                'item_quantity'          => $rows['item_quantity'],
                'item_pic'               => $rows['item_pic'],
            );

            array_push($orderArr, $resDataList);
        }
    }
    echo json_encode($orderArr);
  }




  
    
  public function GetOrders($mysqli, $restaurant_id){
    $uiEncry  = new IdEncrypt();

    $query = "SELECT * FROM  orders WHERE restaurant_id = '$restaurant_id'"; 
    $res = $mysqli->query($query);
    $orderArr       = [];

    while ($rows = $res->fetch_assoc()) {
        $orderDataList = array(
            'order_id'               => $uiEncry->useridEencrypt($rows['order_id']),
            'cart_id'                => $uiEncry->useridEencrypt($rows['cart_id']),
            'dish_id'                => $uiEncry->useridEencrypt($rows['dish_id']),
            'order_number'           => $rows['order_number'],
            'item_name'              => $rows['item_name'],
            'item_pic'               => $rows['item_pic'],
            'order_quantity'         => $rows['order_quantity'],
            'order_subtotal'         => $rows['order_subtotal'],
            'order_amount'           => $rows['order_amount'],
            'delivery_status'        => $rows['delivery_status'],
            'order_time'             => $rows['order_time'],
        );


        array_push($orderArr, $orderDataList);
    }
    echo json_encode($orderArr);

}


public function UsersOrder($mysqli, $restaurant_id) {
    $uiEncry  = new IdEncrypt();

    
    $query = "SELECT * FROM  orders WHERE restaurant_id = '$restaurant_id'"; 
    $res = $mysqli->query($query);
    $userArr       = [];
    $row = $res->fetch_assoc();
    $user_id = $row['user_id'];

    if ("$restaurant_id" === $row['restaurant_id']) {
        
        $new_query = "SELECT * FROM  users WHERE user_id = '$user_id'"; 
        $response = $mysqli->query($new_query);

        while($rows = $response->fetch_assoc()){

            $userDataList = array(
                'user_id'                => $uiEncry->useridEencrypt($rows['user_id']),
                'order_id'               => $rows['order_id'],
                'first_name'             => $rows['first_name'],
                'last_name'              => $rows['last_name'],
                'profile_pic'            => $rows['profile_pic'],
                'phone_number'           => $rows['phone_number'],
                'email'                  => $rows['email'],
                'longitude'              => $rows['longitude'],
                'latitude'               => $rows['latitude'],
                'order_subtotal'         => $row['order_subtotal'],
                'order_amount'           => $row['order_amount'],
                'delivery_status'        => $row['delivery_status'],
                'order_time'             => $row['order_time'],
            );

            array_push($userArr, $userDataList);
        }
    }

    echo json_encode($userArr);
}


public function getUserAndOrderDetails($mysqli, $restaurant_id) {
$uiEncry = new IdEncrypt();

$query = "SELECT * FROM orders WHERE restaurant_id = '$restaurant_id'";
$res = $mysqli->query($query);
$orderArr = [];

while ($rows = $res->fetch_assoc()) {
    $user_id = $rows['user_id'];

    $new_query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $response = $mysqli->query($new_query);
    $row = $response->fetch_assoc(); 

    $orderDataList = array(
        'order_id'        => $uiEncry->useridEencrypt($rows['order_id']),
        'cart_id'         => $uiEncry->useridEencrypt($rows['cart_id']),
        'dish_id'         => $uiEncry->useridEencrypt($rows['dish_id']),
        'order_number'    => $rows['order_number'],
        'item_name'       => $rows['item_name'],
        'item_pic'        => $rows['item_pic'],
        'order_quantity'  => $rows['order_quantity'],
        'order_subtotal'  => $rows['order_subtotal'],
        'order_amount'    => $rows['order_amount'],
        'delivery_status' => $rows['delivery_status'],
        'order_time'      => $rows['order_time'],
        'user_data' => array(
            'user_id'     => $uiEncry->useridEencrypt($row['user_id']),
            'order_id'    => $row['order_id'],
            'first_name'  => $row['first_name'],
            'last_name'   => $row['last_name'],
            'profile_pic' => $row['profile_pic'],
            'phone_number'=> $row['phone_number'],
            'email'       => $row['email'],
            'longitude'   => $row['longitude'],
            'latitude'    => $row['latitude'],
        ),
    );

    array_push($orderArr, $orderDataList);
}

echo json_encode($orderArr);

}





public function changeOrderStatus($mysqli, $delivery_status, $restaurant_id, $user_id, $cart_id, $dish_id) {

    $query = "UPDATE orders SET delivery_status = ?  WHERE restaurant_id = ? AND cart_id = ? AND user_id = ? AND dish_id = ?";
    $res = $mysqli->prepare($query);
    $res->bind_param('sssss', $delivery_status, $restaurant_id, $cart_id, $user_id, $dish_id );

    if($res->execute()){
        echo json_encode("Order status changed");
    }
    else{
        echo json_encode("Order status could not changed");
    }
}



public function changeDeliveryOrderStatus($mysqli, $delivery_status, $restaurant_id, $user_id, $cart_id, $dish_id) {

    $query = "UPDATE orders SET delivery_status = ?  WHERE restaurant_id = ? AND cart_id = ? AND user_id = ? AND dish_id = ?";
    $res = $mysqli->prepare($query);
    $res->bind_param('sssss', $delivery_status, $restaurant_id, $cart_id, $user_id, $dish_id );

    if($res->execute()){
        echo json_encode("Order status changed");
    }
    else{
        echo json_encode("Order status could not changed");
    }
}



public function GetLocationName($mysqli, $lat, $long) {
    $query = "SELECT * FROM cities WHERE latitude = $lat AND longitude = $long";
    $res = $mysqli->query($query);
    $rows = $res->fetch_assoc();
    $locArr = [];

    $locDataList = array(
        'name'             => $rows['name'],
    );

    array_push($locArr, $locDataList);


    echo json_encode($locArr);
}



public function getOrderForRider($mysqli,  $rider_id) {
    $uiEncry  = new IdEncrypt();
    $status  = 4;

    
    $query = "SELECT * FROM  notifications WHERE rider_id = '$rider_id' AND status = '$status'"; 
    $res = $mysqli->query($query);
    $orderArr       = [];
    $row = $res->fetch_assoc();
    $restaurant_id = $row['restaurant_id'];
    $user_id       = $row['user_id'];
    $order_status = 0;


    if ("$restaurant_id" === $row['restaurant_id']) {

      $user_query = "SELECT * FROM users WHERE user_id = '$user_id'";
      $user_res   = $mysqli->query($user_query);
      $user = $user_res->fetch_assoc();

      $res_query = "SELECT * FROM restaurants WHERE restaurant_id = '$restaurant_id'";
      $res_res   = $mysqli->query($res_query);
      $res = $res_res->fetch_assoc();
        
        $new_query = "SELECT * FROM  orders WHERE restaurant_id = '$restaurant_id' AND user_id = '$user_id' AND order_status = $order_status"; 
        $response = $mysqli->query($new_query);

        while($rows = $response->fetch_assoc()){

            $orderDataList = array(
                'order_id'               => $uiEncry->useridEencrypt($rows['order_id']),
                'user_id'                => $uiEncry->useridEencrypt($rows['user_id']),
                'cart_id'                => $uiEncry->useridEencrypt($rows['cart_id']),
                'dish_id'                => $uiEncry->useridEencrypt($rows['dish_id']),
                'restaurant_id'          => $uiEncry->useridEencrypt($rows['restaurant_id']),
                'order_number'           => $rows['order_number'],
                'item_name'              => $rows['item_name'],
                'item_pic'               => $rows['item_pic'],
                'order_quantity'         => $rows['order_quantity'],
                'order_subtotal'         => $rows['order_subtotal'],
                'order_amount'           => $rows['order_amount'],
                'delivery_status'        => $rows['delivery_status'],
                'order_status'           => $rows['order_status'],
                'order_time'             => $rows['order_time'],
                'user_data' => array(
                  'user_id'     => $uiEncry->useridEencrypt($user['user_id']),
                  'order_id'    => $user['order_id'],
                  'first_name'  => $user['first_name'],
                  'last_name'   => $user['last_name'],
                  'profile_pic' => $user['profile_pic'],
                  'phone_number'=> $user['phone_number'],
                  'email'       => $user['email'],
                  'longitude'   => $user['longitude'],
                  'latitude'    => $user['latitude'],
              ),
              'restaurant_data' => array(
                'restaurant_id'       => $uiEncry->useridEencrypt($res['restaurant_id']),
                'login_id'            => $res['login_id'],
                'restaurant_name'     => $res['restaurant_name'],
                'restaurant_picture'  => $res['restaurant_picture'],
                'owner'               => $res['owner'],
                'number_of_workers'   => $res['number_of_workers'],
                'contact'             => $res['contact'],
                'email'               => $res['email'],
                'restaurant_type'     => $res['restaurant_type'],
                'working_hours'       => $res['working_hours'],
                'location'            => $res['location'],
                'ratings'             => $res['ratings'],
                'longitude'           => $res['longitude'],
                'latitude'            => $res['latitude'],
            ),
            );

            array_push($orderArr, $orderDataList);
        }
    }

    echo json_encode($orderArr);
  }










public function GetTrackOrderInfo($mysqli, $order_id) {
    $uiEncry  = new IdEncrypt();
    $orderArr       = [];


    $query = "SELECT * FROM  orders WHERE order_id = '$order_id'"; 
    $res = $mysqli->query($query);
    $row = $res->fetch_assoc();
    $restaurant_id = $row['restaurant_id'];
    $user_id       = $row['user_id'];
    $dish_id       = $row['dish_id'];


    $user_query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $user_res   = $mysqli->query($user_query);
    $user       = $user_res->fetch_assoc();

    $res_query  = "SELECT * FROM restaurants WHERE restaurant_id = '$restaurant_id'";
    $res_res    = $mysqli->query($res_query);
    $res        = $res_res->fetch_assoc();

    $dish_query  = "SELECT * FROM dishes WHERE dish_id = '$dish_id'";
    $dish_res    = $mysqli->query($dish_query);
    $dish        = $dish_res->fetch_assoc();
    
    $new_query = "SELECT * FROM  orders WHERE restaurant_id = '$restaurant_id' AND user_id = '$user_id'"; 
    $response = $mysqli->query($new_query);

    while($rows = $response->fetch_assoc()){

        $orderDataList = array(
            'order_number'           => $rows['order_number'],
            'order_quantity'         => $rows['order_quantity'],
            'order_subtotal'         => $rows['order_subtotal'],
            'order_amount'           => $rows['order_amount'],
            'user_data' => array(
                'phone_number'       => $user['phone_number'],
                'longitude'          => $user['longitude'],
                'latitude'           => $user['latitude'],
            ),
            'restaurant_data' => array(
            'restaurant_name'        => $res['restaurant_name'],
           ),
           'dish_data' => array(
            'dish_name'              => $dish['dish_name'],
            'dish_price'             => $dish['dish_price'],
            'description'            => $dish['description'],
           )
        );

        array_push($orderArr, $orderDataList);
    }
    

    echo json_encode($orderArr);
  }


}