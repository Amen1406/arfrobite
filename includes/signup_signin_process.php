<?php

class SignUp_SignIn{
    
////////////////////////////////////////////////////////////////
/////// Sign Up new user in web mobile//////////////////////////
////////////////////////////////////////////////////////////////


public function RegisterNewUser($mysqli, $fname, $lname, $phone, $email, $password, $generated_user_id) {
  $uiEncry  = new IdEncrypt();
  
  $defaultImage = "http://localhost/arfrobite/assets/default.png";

    // Check if the user already exists
    $checkUserQuery = "SELECT * FROM users WHERE phone_number = ?";
    $checkUserStmt = $mysqli->prepare($checkUserQuery);
    $checkUserStmt->bind_param("s", $phone);
    $checkUserStmt->execute();
    $result = $checkUserStmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode("User already exists");
    }
    else{
            // User doesn't exist, proceed with registration
            $insertQuery = "INSERT INTO users (order_id, first_name, last_name, profile_pic, phone_number, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $mysqli->prepare($insertQuery);

            // Hash the password before storing it in the database for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Bind parameters
            $insertStmt->bind_param("sssssss", $generated_user_id, $fname, $lname, $defaultImage, $phone, $email, $hashedPassword);

            // Execute the query
            if ($insertStmt->execute()) {

                $token = "SELECT user_id,password FROM users WHERE phone_number = ?";
                $res = $mysqli->prepare($token);
                $res->bind_param("s", $phone);
                $res->execute();
                $result = $res->get_result();

                $user = $result->fetch_assoc();
                $passcode = $user['password'];
                $user_u_id = $uiEncry->useridEencrypt($user['user_id']);

                if (password_verify($password, $passcode)) {
                  $otp = rand(111111,999999);
                  $datetime = date('Y-m-d H:i:s');

                  $tokenCall = $mysqli->query("SELECT user_id FROM  login_details WHERE user_id = '$user_u_id'");
                  $t = $tokenCall->fetch_assoc();

                if ($t['user_id'] !=null) {
                    $mysqli->query("UPDATE login_details SET loginotp = $otp  WHERE user_id = '$user_u_id'");
                 } else{
                    $sub_query = "INSERT INTO login_details(user_id,loginotp,login_time)VALUES ('".$user_u_id."','".$otp."','".$datetime."')";
                    $res = $mysqli->query($sub_query);
                    }

                    $DBCrud       = new SignUp_SignIn();
                  $DBCrud->Send($otp,$user_u_id,$phone);
                }

              //echo json_encode("Registration successful");
            } else {
                echo json_encode("Registration failed");
            }
    }


}



////////////////////////////////////////////////////////////////////////
/////////////////// Login user in web mobile ///////////////////////////
////////////////////////////////////////////////////////////////////////

public function LoginInto($mysqli, $phone, $password) {
  $uiEncry  = new IdEncrypt();

    // Check if the user exists
    $checkUserQuery = "SELECT * FROM users WHERE phone_number = ?";
    $checkUserStmt = $mysqli->prepare($checkUserQuery);
    $checkUserStmt->bind_param("s", $phone);
    $checkUserStmt->execute();
    $result = $checkUserStmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode("User does not exist");
    }
    else{
      
    // User exists, verify password
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {

        $token = "SELECT user_id,password FROM users WHERE phone_number = ?";
        $res = $mysqli->prepare($token);
        $res->bind_param("s", $phone);
        $res->execute();
        $result = $res->get_result();

        $user = $result->fetch_assoc();
        
        $passcode = $user['password'];
        $user_u_id = $uiEncry->useridEencrypt($user['user_id']);

        if (password_verify($password, $passcode)) {
            $otp = rand(111111,999999);
            $datetime = date('Y-m-d H:i:s');

            $tokenCall = $mysqli->query("SELECT user_id FROM  login_details WHERE user_id = '$user_u_id'");
          $t = $tokenCall->fetch_assoc();

          if ($t['user_id'] !=null) {
            $mysqli->query("UPDATE login_details SET loginotp = $otp  WHERE user_id = '$user_u_id'");
          } else{
              $sub_query = "INSERT INTO login_details(user_id,loginotp,login_time)VALUES ('".$user_u_id."','".$otp."','".$datetime."')";
              $res = $mysqli->query($sub_query);
            }

            $DBCrud   = new SignUp_SignIn();
           $DBCrud->Send($otp,$user_u_id,$phone);
        }



        // Password is correct, login successful
        //echo json_encode("Login Succesfull");
    } else {
        // Password is incorrect, handle accordingly (e.g., return an error message)
        echo json_encode("Login not successfull");
    }
    }

}


public function Send($otp,$user_u_id,$phoneNumber){

     
    //   $authKey = "412420Ar72TN13865877cecP1";


    //   $postData = array(
    //     'authkey'  => $authKey,
    //   );

    // //API url
    // $url = "https://control.msg91.com/api/v5/otp?template_id=6588461bd6fc05596170fe82&mobile=$phoneNumber&otp=$otp&otp_length=6&otp_expiry=300";

    // $curl = curl_init($url);

    // curl_setopt_array($curl, array(
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => "",
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 30,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => "POST",
    //     CURLOPT_POSTFIELDS => $postData,
    //     CURLOPT_SSL_VERIFYHOST => 0,
    //     CURLOPT_SSL_VERIFYPEER => 0,
    // ));

    // $response = curl_exec($curl);
    // $err = curl_error($curl);

    // if($err){
    //     echo "cURL Error #:" . $err;
    // }

    // curl_close($curl);


      echo json_encode(array('response' =>'success','user_id'=> $user_u_id));
    
  }
    
    
    
    public function VerifyAndSetUpUser($mysqli,$requestSource,$otpCode,$identityToken){
    
      $tokenquery = $mysqli->query("SELECT loginotp FROM  login_details WHERE user_id = '$identityToken'");
      
      if(mysqli_num_rows($tokenquery) > 0){
      $res = $tokenquery->fetch_assoc();
      $token_code = $res['loginotp'];
    
    // if ($requestSource == "mobileApp") {
    
    //   if ($token_code == $otpCode) {
    //     $mysqli->query("UPDATE login_details SET loginotp = 'loginVerified' WHERE user_id = '$identityToken'");
    
    //         $Loguserdata      = FindUserData(useridDecrypt($identityToken));
    //         $userdata[] = array(
    //           'Log_user_id'      => $identityToken,
    //           'Log_username'     => $Loguserdata['username'],
    //           'Log_userprofile'  => $Loguserdata['userprofile'],
    //           'Log_PhoneNumber'  => $Loguserdata['Phone']
    //         );
    
    //       echo json_encode($userdata);
    //     }else{
    
    //       $error[] = array(
    //         'response' => 'incorrect'
    //        );
    
    //       echo json_encode($error);
    
    //     }
    
    
    //     }
     if ($requestSource == "webResquest"){
    
      if ($token_code == $otpCode) {
        $mysqli->query("UPDATE login_details SET loginotp = 'loginVerified' WHERE user_id = '$identityToken'");
    
          setcookie('uid', $identityToken, time() + (86400 * 30), '/');
           $resOut  = array('response' =>'success');
    
           echo json_encode($resOut);
    
        }else{
          echo json_encode(array('response' =>'incorrect'));
    
        }
    }
    
    }else{
        echo json_encode('network error');
      }
    
    }
    
    


    public function EditUserProfile($mysqli, $user_id, $profile_img, $fname, $lname, $number, $email){
      $query = "UPDATE users SET first_name = ?, last_name = ?, profile_pic = ?, phone_number = ?, email = ? WHERE user_id = ?";
    
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("sssssi", $fname, $lname, $profile_img, $number, $email, $user_id);
      

        if ($stmt->execute()) {
          echo json_encode("User profile update successful");
      } else {
          echo json_encode("User profile update failed");
      }
    }
    


    public function EditUserAddress($mysqli, $user_id, $city, $town, $street){

      
    // Check if the user already has an address
    $checkUserQuery = "SELECT * FROM address WHERE user_id = ?";
    $checkUserStmt = $mysqli->prepare($checkUserQuery);
    $checkUserStmt->bind_param("s", $user_id);
    $checkUserStmt->execute();
    $result = $checkUserStmt->get_result();

    if ($result->num_rows > 0) {
      $query = "UPDATE address SET city = ?, town = ?, street = ? WHERE user_id = ?";
    
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("ssssi", $city, $town, $street, $user_id);
      

        if ($stmt->execute()) {
          echo json_encode("User address update successful");
      } else {
          echo json_encode("User address update failed");
      }
    }
    else{

      $query = "INSERT INTO address (user_id, city, town, street) VALUES (?, ?, ?, ?)";
    
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("ssss", $user_id, $city, $town, $street);
      

        if ($stmt->execute()) {
          echo json_encode("User address added successfully");
      } else {
          echo json_encode("User address failed to add");
      }
    }
  }





  public function LogUserOut() {
    setcookie('uid', "", time() + (86400 * 30), '/');
    echo json_encode("Logout successful");
  }

  


  public function insertCoordinates($mysqli, $user_id, $lat, $long){

      $query = "UPDATE users SET longitude = ?, latitude = ?  WHERE user_id = ?";
    
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("ssi", $long, $lat, $user_id);
      

        if ($stmt->execute()) {
          echo json_encode("Coordinates have been set");
      } else {
          echo json_encode("Coordinates have been set");
      }

  }
  


  public function insertResCoordinates($mysqli, $restaurant_id, $lat, $long){

      $query = "UPDATE restaurant SET longitude = ?, latitude = ?  WHERE restaurant_id = ?";
    
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("ssi", $long, $lat, $restaurant_id);
      

        if ($stmt->execute()) {
          echo json_encode("Coordinates have been set");
      } else {
          echo json_encode("Coordinates have been set");
      }

  }
  


  public function insertRiderCoordinates($mysqli, $rider_id, $lat, $long){

      $query = "UPDATE riders SET longitude = ?, latitude = ?  WHERE rider_id = ?";
    
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("ssi", $long, $lat, $rider_id);
      

        if ($stmt->execute()) {
          echo json_encode("Coordinates have been set");
      } else {
          echo json_encode("Coordinates have been set");
      }

  }




  public function getUserCoordinates($mysqli,$user_id) {
    $uiEncry  = new IdEncrypt();

    $query = "SELECT user_id, longitude, latitude FROM users WHERE user_id = '$user_id'"; 
    $res = $mysqli->query($query);
    $CoorArr       = [];
    $rows = $res->fetch_assoc();
    $resDataList = array(
      'user_id'        => $uiEncry->useridEencrypt($rows['user_id']),
      'longitude'      => $rows['longitude'],
      'latitude'       => $rows['latitude'],
    );
    array_push($CoorArr, $resDataList);
    echo json_encode($CoorArr);
  }



  public function getRiderCoordinates($mysqli,$rider_id) {
    $uiEncry  = new IdEncrypt();

    $query = "SELECT rider_id, longitude, latitude FROM riders WHERE rider_id = '$rider_id'"; 
    $res = $mysqli->query($query);
    $CoorArr       = [];
    $rows = $res->fetch_assoc();
    $resDataList = array(
      'rider_id'        => $uiEncry->useridEencrypt($rows['rider_id']),
      'longitude'      => $rows['longitude'],
      'latitude'       => $rows['latitude'],
    );
    array_push($CoorArr, $resDataList);
    echo json_encode($CoorArr);
  }


  public function getResCoordinates($mysqli,$restaurant_id) {
    $uiEncry  = new IdEncrypt();

    $query = "SELECT restaurant_id, longitude, latitude FROM restaurants WHERE restaurant_id = '$restaurant_id'"; 
    $res = $mysqli->query($query);
    $CoorArr       = [];
    $rows = $res->fetch_assoc();
    $resDataList = array(
      'restaurant_id'        => $uiEncry->useridEencrypt($rows['restaurant_id']),
      'longitude'      => $rows['longitude'],
      'latitude'       => $rows['latitude'],
    );
    array_push($CoorArr, $resDataList);
    echo json_encode($CoorArr);
  }



  
  public function LoginIntoRes($mysqli, $login_id, $password) {
    $uiEncry  = new IdEncrypt();

    // Check if the user exists
    $checkUserQuery = "SELECT * FROM restaurants WHERE login_id = ?";
    $checkUserStmt = $mysqli->prepare($checkUserQuery);
    $checkUserStmt->bind_param("s", $login_id);
    $checkUserStmt->execute();
    $result = $checkUserStmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode("Restaurant does not exist");
    } else {
        // User exists, verify password
        $user = $result->fetch_assoc();
        $restaurant_id = $uiEncry->useridEencrypt($user['restaurant_id']);

        if (password_verify($password, $user['password'])) {
            // Password is correct
            setcookie('rid', $restaurant_id , time() + (86400 * 30), '/');
            echo json_encode("Restaurant login successful");
        } else {
            // Password is incorrect
            echo json_encode("Restaurant login not successful");
        }
    }
  }


    



    public function LogUserOutRes() {
      setcookie('rid', "", time() + (86400 * 30), '/');
      echo json_encode("Logout successful");
    }
  
  
    public function insertCoordinatesRes($mysqli, $user_id, $lat, $long){
  
        $query = "UPDATE users SET longitude = ?, latitude = ?  WHERE user_id = ?";
      
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssi", $long, $lat, $user_id);
        
  
          if ($stmt->execute()) {
            echo json_encode("Coordinates have been set");
        } else {
            echo json_encode("Coordinates have been set");
        }
  
    }



  

  

    
    
    public function AddDish($mysqli, $restaurant_id, $dish_name, $dish_pic, $price, $description){

      $insertQuery = "INSERT INTO dishes (restaurant_id, dish_name, dish_pic, dish_price, description) VALUES (?, ?, ?, ?, ?)";
      $insertStmt = $mysqli->prepare($insertQuery);


      // Bind parameters
      $insertStmt->bind_param("sssss", $restaurant_id, $dish_name, $dish_pic, $price, $description);

      // Execute the query
      if ($insertStmt->execute()) {
        echo json_encode("Dish addition successful");
      } else {
          echo json_encode("Dish addition failed");
      }

}

   



public function LoginIntoRiders($mysqli, $login_id, $password) {
  $uiEncry  = new IdEncrypt();

  // Check if the user exists
  $checkUserQuery = "SELECT * FROM riders WHERE login_id = ?";
  $checkUserStmt = $mysqli->prepare($checkUserQuery);
  $checkUserStmt->bind_param("s", $login_id);
  $checkUserStmt->execute();
  $result = $checkUserStmt->get_result();

  if ($result->num_rows === 0) {
      echo json_encode("Rider does not exist");
  }
  else{
    
    // User exists, verify password
    $user = $result->fetch_assoc();
    $rider_id = $uiEncry->useridEencrypt($user['rider_id']);

    if (password_verify($password, $user['password'])) {
        // Password is correct
        setcookie('rider_id', $rider_id , time() + (86400 * 30), '/');
        echo json_encode("Rider login successful");
    } else {
        // Password is incorrect, handle accordingly (e.g., return an error message)
        echo json_encode("Rider login not successful");
    }
  }

}

  


public function LogRiderOut() {
  setcookie('rider_id', "", time() + (86400 * 30), '/');
  echo json_encode("Logout successful");
}


public function insertCoordinatesRiders($mysqli, $rider_id, $lat, $long){

    $query = "UPDATE riders SET longitude = ?, latitude = ?  WHERE rider_id = ?";
  
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssi", $long, $lat, $rider_id);
    

      if ($stmt->execute()) {
        echo json_encode("Coordinates have been set");
    } else {
        echo json_encode("Coordinates have been set");
    }

}



}






















class RegisterRestaurantAndRiders{

  public function RegisterRestaurant($mysqli, $restaurant_name, $restaurant_pic,$restaurant_owner, 
  $restaurant_contact, $restaurant_email, $workers, $restaurant_type, $work_hours, $restaurant_location, $pass)
  {
    // Check if the restaurant already exists
    $checkUserQuery = "SELECT * FROM restaurants WHERE contact = ?";
    $checkUserStmt = $mysqli->prepare($checkUserQuery);
    $checkUserStmt->bind_param("s", $restaurant_contact);
    $checkUserStmt->execute();
    $result = $checkUserStmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode("Restaurant already exists");
    }
    else{
           $login_id = rand(111111,999999);
            // Restaurant doesn't exist, proceed with registration
            $insertQuery = "INSERT INTO restaurants (login_id, restaurant_name, restaurant_picture, owner, contact, email, 
            number_of_workers, restaurant_type, working_hours, location, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $mysqli->prepare($insertQuery);

            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            // Bind parameters
            $insertStmt->bind_param("sssssssssss", $login_id, $restaurant_name, $restaurant_pic,$restaurant_owner, 
            $restaurant_contact, $restaurant_email, $workers, $restaurant_type, $work_hours, $restaurant_location, $hashed_password);

            // Execute the query
            if ($insertStmt->execute()) {
              echo json_encode('Restaurant registration successful');
            } else {
                echo json_encode("Restaurant registration failed");
            }
    }
  }


  public function RegisterRider($mysqli, $rider_name, $rider_pic, $rider_contact, $rider_location, $rider_email, $rider_password){

      // Check if the rider already exists
      $checkUserQuery = "SELECT * FROM riders WHERE rider_contact = ?";
      $checkUserStmt = $mysqli->prepare($checkUserQuery);
      $checkUserStmt->bind_param("s", $rider_contact);
      $checkUserStmt->execute();
      $result = $checkUserStmt->get_result();

      if ($result->num_rows > 0) {
          echo json_encode("Rider already exists");
      }
      else{
             $login_id = rand(111111,999999);
              // Rider doesn't exist, proceed with registration
              $insertQuery = "INSERT INTO riders (login_id, rider_name, rider_pic, rider_contact, rider_location, rider_email, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
              $insertStmt = $mysqli->prepare($insertQuery);

              $hashedPassword = password_hash($rider_password, PASSWORD_DEFAULT);

              // Bind parameters
              $insertStmt->bind_param("sssssss", $login_id, $rider_name, $rider_pic, $rider_contact, $rider_location, $rider_email, $hashedPassword);

              // Execute the query
              if ($insertStmt->execute()) {
                echo json_encode("Rider registration successful");
              } else {
                  echo json_encode("Rider registration failed");
              }
      }
  }


}

?>   