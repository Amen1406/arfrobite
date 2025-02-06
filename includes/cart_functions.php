<?php
class SaveToCart {

    public function SaveToCart($mysqli, $restaurant_id, $user_id, $dish_id, $dish_name, $dish_pic, $item_count, $dish_price) {
        $insertQuery = "INSERT INTO cart (restaurant_id, user_id, dish_id, item_name, item_quantity, item_pic, item_price) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $mysqli->prepare($insertQuery);
        $insertStmt->bind_param("sssssss", $restaurant_id, $user_id, $dish_id, $dish_name, $item_count, $dish_pic,  $dish_price  );
        if ($insertStmt->execute()) {
          echo json_encode("Item saved to cart successful");
        } else {
            echo json_encode("Item failed to not save to chat");
        }
    }





    public function GetCartList($mysqli, $u_user_id) {
        $uiEncry  = new IdEncrypt();

        $query = "SELECT cart_id, user_id, dish_id, item_name, item_quantity, item_pic, item_price, status FROM cart WHERE user_id = '$u_user_id'"; 
          $res = $mysqli->query($query);
          $cartArr       = [];
          while ($rows = $res->fetch_assoc()) {
            $resDataList = array(
            'cart_id'             => $uiEncry->useridEencrypt($rows['cart_id']),
            'user_id'             => $uiEncry->useridEencrypt($rows['user_id']),
            'dish_id'             => $uiEncry->useridEencrypt($rows['dish_id']),
            'item_name'           => $rows['item_name'],
            'item_quantity'       => $rows['item_quantity'],
            'item_pic'            => $rows['item_pic'],
            'item_price'          => $rows['item_price'],
            'status'              => $rows['status']
            );
  
            array_push($cartArr, $resDataList);
          }
          echo json_encode($cartArr);
      }



    

      public function itemPriceUpdate($mysqli, $user_id, $dish_id, $item, $dish_price) {
        $query = "UPDATE cart SET item_quantity = ?, item_price = ? WHERE user_id = ? AND dish_id = ?";
    
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssss", $item, $dish_price, $user_id, $dish_id);
        
  
          if ($stmt->execute()) {
            echo json_encode("Item updated");
        } else {
            echo json_encode("Item not updated");
        }
      }




      public function itemPriceCartUpdate($mysqli, $user_id, $cart_id, $item, $dish_price) {
        $query = "UPDATE cart SET item_quantity = ?, item_price = ? WHERE user_id = ? AND cart_id = ?";
    
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssss", $item, $dish_price, $user_id, $cart_id);
        
  
          if ($stmt->execute()) {
            echo json_encode("Item updated");
        } else {
            echo json_encode("Item not updated");
        }
      }




      public function DeleteFromCart($mysqli, $cart_id){
        $query = "DELETE FROM cart WHERE cart_id = ?";

        $res = $mysqli->prepare($query);
        $res->bind_param("s", $cart_id);

        if ($res->execute()) {
          echo json_encode("Item deleted");
        } else {
            echo json_encode("Item not deleted");
        }
      }



      public function SaveOrder($mysqli, $cart_id, $delivery_status, $subtotal, $total) {

        $query = "INSERT INTO orders (cart_id, delivery_status, order_subtotal, order_amount) VALUES (?, ?, ?, ?)";
              
        $res  = $mysqli->prepare($query);
        $res->bind_param("ssss", $cart_id, $delivery_status, $subtotal, $total);

        if($res->execute()){
          echo json_encode("Order has been placed");
        }
        else{
          echo json_decode("Order was not placed");
        }
      }


      public function UpdateOrder($mysqli, $order_id, $user_id, $dish_id, $restaurant_id, $generated_order_id, $item_name, $item_pic, $quantity) {

        $query = "UPDATE orders SET user_id = ?, dish_id = ?, restaurant_id = ?, order_number = ?, item_name= ?, item_pic = ?, order_quantity = ? WHERE order_id = ?";
              
        $res  = $mysqli->prepare($query);
        $res->bind_param("ssssssss", $user_id, $dish_id, $restaurant_id, $generated_order_id, $item_name, $item_pic, $quantity, $order_id);

        if($res->execute()){
          echo json_encode("Order has been updated");
        }
        else{
          echo json_decode("Order was not updated");
        }
      }



      public function GetCartDetails($mysqli){
        $uiEncry  = new IdEncrypt();

        $query = "SELECT * FROM cart"; 
          $res = $mysqli->query($query);
          $cartArr       = [];

          while ($rows = $res->fetch_assoc()) {

                $resDataList = array(
                'cart_id'             => $uiEncry->useridEencrypt($rows['cart_id']),
                'user_id'             => $uiEncry->useridEencrypt($rows['user_id']),
                'dish_id'             => $uiEncry->useridEencrypt($rows['dish_id']),
                'restaurant_id'       => $uiEncry->useridEencrypt($rows['restaurant_id']),
                'item_name'           => $rows['item_name'],
                'item_quantity'       => $rows['item_quantity'],
                'item_pic'            => $rows['item_pic'],
                'item_price'          => $rows['item_price'],
                'status'              => $rows['status']
                );
      
                array_push($cartArr, $resDataList);
          }
          echo json_encode($cartArr);
      }




     
      

}