<?php
class HomePage {


 
   public function GetAllRestaurants($mysqli) {
      $uiEncry  = new IdEncrypt();

        $query = "SELECT * FROM restaurants"; 
        $res = $mysqli->query($query);
        $ResArr       = [];
        while ($rows = $res->fetch_assoc()) {
          $resDataList = array(
            'restaurant_id'        => $uiEncry->useridEencrypt($rows['restaurant_id']),
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
        }
     echo json_encode($ResArr, JSON_PRETTY_PRINT);      
    }













    public function GetAllRiders($mysqli) {
      $uiEncry  = new IdEncrypt();

        $query = "SELECT * FROM riders"; 
        $res = $mysqli->query($query);
        $RidersArr       = [];
        while ($rows = $res->fetch_assoc()) {
          $resDataList = array(
            'rider_id'        => $uiEncry->useridEencrypt($rows['rider_id']),
            'rider_name'      => $rows['rider_name'],
            'rider_pic'       => $rows['rider_pic'],
            'rider_contact'   => $rows['rider_contact'],
            'rider_location'  => $rows['rider_location'],
            'rider_email'     => $rows['rider_email'],
          );
         array_push($RidersArr, $resDataList);
        }
     echo json_encode($RidersArr, JSON_PRETTY_PRINT);      
    }




    public function GetAllDishes($mysqli) {
      $uiEncry  = new IdEncrypt();

        $query = "SELECT * FROM dishes"; 
        $res = $mysqli->query($query);
        $DishArr       = [];
        while ($rows = $res->fetch_assoc()) {
          $resDataList = array(
            'dish_id'        => $uiEncry->useridEencrypt($rows['dish_id']),
            'dish_name'      => $rows['dish_name'],
            'dish_pic'       => $rows['dish_pic'],
            'dish_price'     => $rows['dish_price'],
            'description'    => $rows['description'],
          );
         array_push($DishArr, $resDataList);
        }
     echo json_encode($DishArr, JSON_PRETTY_PRINT);      
    }



    

    public function GetRestaurantId($mysqli, $restaurant_id){
      $uiEncry  = new IdEncrypt();

      $query = "SELECT restaurant_id, restaurant_name, restaurant_picture, location FROM restaurants WHERE restaurant_id = '$restaurant_id'"; 
        $res = $mysqli->query($query);
        $ResArr       = [];
        while ($rows = $res->fetch_assoc()) {
          $resDataList = array(
          'restaurant_id'        => $uiEncry->useridEencrypt($rows['restaurant_id']),
          'restaurant_name'      => $rows['restaurant_name'],
          'restaurant_picture'   => $rows['restaurant_picture'],
          'location'             => $rows['location'],
          );

          array_push($ResArr, $resDataList);
        }
        echo json_encode($ResArr, JSON_PRETTY_PRINT);
    }

    public function GetRestaurantDishes($mysqli, $restaurant_id){
      $uiEncry  = new IdEncrypt();

      $query = "SELECT dish_id, dish_name, dish_pic, dish_price, description FROM dishes WHERE restaurant_id = '$restaurant_id'"; 
        $res = $mysqli->query($query);
        $ResDArr       = [];
        while ($rows = $res->fetch_assoc()) {
          $resDataList = array(
          'dish_id'        => $uiEncry->useridEencrypt($rows['dish_id']),
          'dish_name'      => $rows['dish_name'],
          'dish_pic'       => $rows['dish_pic'],
          'dish_price'     => $rows['dish_price'],
          'description'    => $rows['description']
          );

          array_push($ResDArr, $resDataList);
        }
        echo json_encode($ResDArr, JSON_PRETTY_PRINT);
    }



    
    public function CheckUserAddress($mysqli, $user_id){
      
      // Check if the user already has an address
      $checkUserQuery = "SELECT * FROM address WHERE user_id = ?";
      $checkUserStmt = $mysqli->prepare($checkUserQuery);
      $checkUserStmt->bind_param("s", $user_id);
      $checkUserStmt->execute();
      $result = $checkUserStmt->get_result();
  
      if ($result->num_rows > 0) {
       echo json_encode("User has address");
      }
      else{
        echo json_encode("User has no address");
      }
    }


    public function searchResults($mysqli, $query){
      try {
        $stmt = $mysqli->prepare("SELECT * FROM restaurants WHERE restaurant_name LIKE :query");
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($results);
    } catch (PDOException $e) {
        return json_encode(array('error' => $e->getMessage()));
    }

  }
  
  



}