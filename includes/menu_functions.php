<?php

class Menu {

  public function GetDishes($mysqli, $restaurant_id) {
      $uiEncry  = new IdEncrypt();

        $query = "SELECT * FROM dishes WHERE restaurant_id = '$restaurant_id'"; 
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



  public function GetDishForEdit($mysqli, $restaurant_id, $dish_id){
      $uiEncry  = new IdEncrypt();

      $query = "SELECT * FROM dishes WHERE restaurant_id = '$restaurant_id' AND dish_id = '$dish_id'"; 
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

  


  public function DeleteDish($mysqli, $dish_id){
    $query = "DELETE FROM dishes WHERE dish_id = ?";

    $res = $mysqli->prepare($query);
    $res->bind_param("s", $dish_id);

    if ($res->execute()) {
      echo json_encode("Item deleted");
    } else {
        echo json_encode("Item not deleted");
    }
  }



  public function EditDish($mysqli, $dish_id, $dish_name, $dish_pic, $price, $description) {
    $query = "UPDATE dishes SET dish_name = ?, dish_pic = ?, dish_price = ?, description = ? WHERE dish_id = ?";
    $res = $mysqli->prepare($query);
    $res->bind_param('sssss', $dish_name, $dish_pic, $price, $description, $dish_id);

    if($res->execute()){
      echo json_encode("Item edited");
    }
    else{
      echo json_encode("Item could not update");
    }
  }
  
}