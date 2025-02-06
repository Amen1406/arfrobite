<?php
include "db-conn.php";
include "../images.php";

error_reporting(E_ALL); // Error/Exception engine, always use E_ALL

ini_set('ignore_repeated_errors', TRUE); // always use TRUE

ini_set('display_errors', FALSE); // Error/Exception display, use FALSE only in production environment or real server. Use TRUE in development environment

ini_set('log_errors', TRUE); // Error/Exception file logging engine.
ini_set('error_log', '../system_logs/errorlogs.txt'); // Logging file path

$allowed_actions = array(
    'callRequest',
    'homeRequest',
    'cartRequest',
    'profileRequest',
    'paymentRequest',
    'orderRequest',
    'notifyRequest',
    'resRequest',
    'deliveryRequest',
);

$file_path = 'http://localhost/arfrobite/assets/small/';

if (isset($_POST['action']) && in_array($_POST['action'], $allowed_actions)) {
    $action = $_POST['action'];


    if ($action == 'callRequest') {

        if ($_POST['callRequest'] == 'sign_up') {
            $req_dump = print_r($_REQUEST, TRUE);
            $fp = fopen('../system_logs/signup_signin.txt', 'a');
            fwrite($fp, $req_dump);
            fclose($fp);

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $phone    = $_POST['number'];
            $email    = $_POST['email'];
            $password = $_POST['pass'];
            $generated_user_id = '#'. rand(111111,999999);

            $res = $DBCrud->RegisterNewUser($mysqli, $fname, $lname, $phone, $email, $password, $generated_user_id);
        } 
        
        
        
        else if ($_POST['callRequest'] == 'sign_in') {

            $phone    = $_POST['number'];
            $password = $_POST['pass'];
            $res = $DBCrud->LoginInto($mysqli, $phone, $password);
        } 
        
        
        
        else if ($_POST['callRequest'] == 'verifyUserLogin') {

            $requestSource           = $_POST['requestSource'];
            $otpCode                 = $_POST['otpCode'];
            $identityToken           = $_POST['tokenIdentityId'];

            $res = $DBCrud->VerifyAndSetUpUser($mysqli, $requestSource, $otpCode, $identityToken);
        } 
        
        
        else if ($_POST['callRequest'] == 'register_res') {
            $restaurant_name     = $_POST['restaurant_name'];
            $restaurant_pic      = @$_FILES['restaurant_pic']['name'];

            if ($restaurant_pic !== null) {
                $imagePath = '../assets/';
                $imagePath = $imagePath . basename($_FILES['restaurant_pic']['name']);
                move_uploaded_file($_FILES['restaurant_pic']['tmp_name'], $imagePath);


                ///////////////////////////////////////////////////////////////////
                //////////////////////Image Resize usage///////////////////////////

                $img = new ImageUtil($imagePath);
                // set width, height and image resize option

                $img->resize(180, 100)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/small/'. $restaurant_pic);

                $img->resize(450, 300)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/medium/'. $restaurant_pic);

                $img->resize(750, 500)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/minimedium/'. $restaurant_pic);

                $img->resize(1000, 800)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/large/'. $restaurant_pic);

            } else if ($restaurant_pic['error'] !== UPLOAD_ERR_OK) {
                echo 'File upload failed with error code ' . $restaurant_pic['error'];
            }


            $restaurant_owner    = $_POST['restaurant_owner'];
            $restaurant_contact  = $_POST['restaurant_contact'];
            $restaurant_email    = $_POST['restaurant_email'];
            $workers             = $_POST['workers'];
            $restaurant_type     = $_POST['restaurant_type'];
            $work_hours          = $_POST['work_hours'];
            $restaurant_location = $_POST['restaurant_location'];
            $pass                = $_POST['pass'];
            $restaurant_pic = $file_path . $restaurant_pic;

            $res = $RegisterResAndRider->RegisterRestaurant($mysqli, $restaurant_name, $restaurant_pic, $restaurant_owner, $restaurant_contact, $restaurant_email, $workers, $restaurant_type, $work_hours, $restaurant_location, $pass );
        } 
        
        
        else if ($_POST['callRequest'] == 'register_rider') {
            $rider_name   = $_POST['rider_name'];
            $rider_pic    = @$_FILES['rider_pic']['name'];

            if ($rider_pic !== null) {
                $imagePath = '../assets/';
                $imagePath = $imagePath . basename($_FILES['rider_pic']['name']);
                move_uploaded_file($_FILES['rider_pic']['tmp_name'], $imagePath);

                ///////////////////////////////////////////////////////////////////
                //////////////////////Image Resize usage///////////////////////////

                $img = new ImageUtil($imagePath);
                // set width, height and image resize option

                $img->resize(180, 100)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/small/'. $rider_pic);

                $img->resize(450, 300)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/medium/'. $rider_pic);

                $img->resize(750, 500)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/minimedium/'. $rider_pic);

                $img->resize(1000, 800)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/large/'. $rider_pic);

            } else if ($rider_pic['error'] !== UPLOAD_ERR_OK) {
                echo 'File upload failed with error code ' . $rider_pic['error'];
            }

            $rider_contact = $_POST['rider_contact'];
            $rider_email  = $_POST['rider_email'];
            $rider_location  = $_POST['rider_location'];
            $rider_password  = $_POST['password'];
            $rider_pic = $file_path . $rider_pic;

            $res = $RegisterResAndRider->RegisterRider( $mysqli, $rider_name, $rider_pic, $rider_contact, $rider_location, $rider_email, $rider_password);
        } 
        

        
        
        else if ($_POST['callRequest'] == 'editprofile') {

            $user_id  = $uiEncry->useridDecrypt($_POST['user_id']);
            $profileImage = @$_FILES['profile_img']['name'];

            if ($profileImage !== null) {
                $imagePath = '../assets/';
                $profileImage = $imagePath . basename($_FILES['profile_img']['name']);
                move_uploaded_file($_FILES['profile_img']['name'], $profileImage);

                ///////////////////////////////////////////////////////////////////
                //////////////////////Image Resize usage///////////////////////////

                $img = new ImageUtil($imagePath);
                // set width, height and image resize option

                $img->resize(180, 100)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/small/'. $profileImage);

                $img->resize(450, 300)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/medium/'. $profileImage);

                $img->resize(750, 500)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/minimedium/'. $profileImage);

                $img->resize(1000, 800)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/large/'. $profileImage);

            } else if ($profileImage['error'] !== UPLOAD_ERR_OK) {
                echo 'File upload failed with error code ' . $profileImage['error'];
            }

            $fname   = $_POST['fname'];
            $lname   = $_POST['lname'];
            $number    = $_POST['number'];
            $email       = $_POST['email'];
            $profileImage = $file_path . $profileImage;

            $res = $DBCrud->EditUserProfile($mysqli, $user_id, $profile_img, $fname, $lname, $number, $email);
        } 
        
        
        else if ($_POST['callRequest'] == 'editaddress') {
            $user_id  = $uiEncry->useridDecrypt($_POST['user_id']);
            $city   = $_POST['city'];
            $town   = $_POST['town'];
            $street   = $_POST['street'];
            $res = $DBCrud->EditUserAddress($mysqli, $user_id, $city, $town, $street);
        } 
        
        
        
        else if ($_POST['callRequest'] == 'logout') {
            $res = $DBCrud->LogUserOut();
        } 
        
        
        else if ($_POST['callRequest'] == 'coordinates') {
            $user_id  = $uiEncry->useridDecrypt($_POST['user_id']);
            $lat   = $_POST['latitude'];
            $long   = $_POST['longitude'];
            $res = $DBCrud->insertCoordinates($mysqli, $user_id, $lat, $long);
        } 


        else if ($_POST['callRequest'] == 'res_coordinates') {
            $restaurant_id  = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $lat   = $_POST['latitude'];
            $long   = $_POST['longitude'];
            $res = $DBCrud->insertResCoordinates($mysqli, $restaurant_id, $lat, $long);
        } 




        else if ($_POST['callRequest'] == 'rider_coordinates') {
            $rider_id  = $uiEncry->useridDecrypt($_POST['rider_id']);
            $lat   = $_POST['latitude'];
            $long   = $_POST['longitude'];
            $res = $DBCrud->insertRiderCoordinates($mysqli, $rider_id, $lat, $long);
        } 
        

        
        else if ($_POST['callRequest'] == 'get-coordinates') {
            $user_id  = $uiEncry->useridDecrypt($_POST['user_id']);
            $res = $DBCrud->getUserCoordinates($mysqli, $user_id);
           
        }
        
        else if ($_POST['callRequest'] == 'get-rider-coordinates') {
            $rider_id  = $uiEncry->useridDecrypt($_POST['rider_id']);
            $res = $DBCrud->getRiderCoordinates($mysqli, $rider_id);
           
        }
        
        else if ($_POST['callRequest'] == 'get-res-coordinates') {
            $restaurant_id  = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $DBCrud->getResCoordinates($mysqli, $restaurant_id);
           
        }

        else if ($_POST['callRequest'] == 'sign_res_in') {
          
            $login_id    = $_POST['number'];
            $password = $_POST['pass'];
            $res = $DBCrud->LoginIntoRes($mysqli, $login_id, $password);
        } 
        
        
        
        else if ($_POST['callRequest'] == 'register_dish') {

            $restaurant_id  = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $dish_name   = $_POST['dish_name'];
            $dish_pic    = @$_FILES['dish_pic']['name'];


            if ($dish_pic != null) {
                $imagePath = '../assets/';
                $imagePath = $imagePath . basename($_FILES['dish_pic']['name']);
                move_uploaded_file($_FILES['dish_pic']['tmp_name'], $imagePath);

                ///////////////////////////////////////////////////////////////////
                //////////////////////Image Resize usage///////////////////////////

                // $fp = fopen('../system_logs/images.txt', 'a');
                // fwrite($fp, $imagePath);
                // fclose($fp);
    

                $img = new ImageUtil($imagePath);
                // set width, height and image resize option

                $img->resize(180, 100)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/small/'. $dish_pic);

                $img->resize(450, 300)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/medium/'. $dish_pic);

                $img->resize(750, 500)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/minimedium/'. $dish_pic);

                $img->resize(1000, 800)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/large/'. $dish_pic);

            } else if ($dish_pic['error'] !== UPLOAD_ERR_OK) {
                echo 'File upload failed with error code ' . $dish_pic['error'];
            }

            $price       = $_POST['price'];
            $description = $_POST['description'];
            $dish_pic = $file_path . $dish_pic;

            $res = $DBCrud->AddDish($mysqli, $restaurant_id, $dish_name, $dish_pic, $price, $description);
        } 
        
        
        
        
        else if ($_POST['callRequest'] == 'res_coordinates') {
            $restaurant_id  = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $lat   = $_POST['latitude'];
            $long   = $_POST['longitude'];
            $res = $DBCrud->insertCoordinates($mysqli, $restaurant_id, $lat, $long);
        } 
        
        
        else if ($_POST['callRequest'] == 'get-res-coordinates') {
            $restaurant_id  = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $DBCrud->getResCoordinates($mysqli, $restaurant_id);
        }



        else if ($_POST['callRequest'] == 'sign_in_rider') {
          
            $login_id    = $_POST['number'];
            $password = $_POST['pass'];
            $res = $DBCrud->LoginIntoRiders($mysqli, $login_id, $password);
        } 
        
        
        
        else if ($_POST['callRequest'] == 'logout_rider') {
            $res = $DBCrud->LogRiderOut();
        } 
        
        
        else if ($_POST['callRequest'] == 'rider_coordinates') {
            $rider_id  = $uiEncry->useridDecrypt($_POST['rider_id']);
            $lat   = $_POST['latitude'];
            $long   = $_POST['longitude'];
            $res = $DBCrud->insertCoordinatesRiders($mysqli, $rider_id, $lat, $long);
        } 
        
        
        else if ($_POST['callRequest'] == 'get-rider-coordinates') {
            $rider_id  = $uiEncry->useridDecrypt($_POST['rider_id']);
            $res = $DBCrud->getRiderCoordinates($mysqli, $rider_id);
        }
    } 
    
    
    











    
    
    
    else if ($action == 'homeRequest') {
        if ($_POST['homeRequest'] == 'restaurants') {
            $res = $HomeData->GetAllRestaurants($mysqli);
           
        } 
            
        
        else if ($_POST['homeRequest'] == 'riders') {
            $res = $HomeData->GetAllRiders($mysqli);
           
        } 
        
        
        else if ($_POST['homeRequest'] == 'dishes') {
            $res = $HomeData->GetAllDishes($mysqli);
        } 
        
        
        
        else if ($_POST['homeRequest'] == 'specificrestaurant') {
            $restaurant_id   =  $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $HomeData->GetRestaurantId($mysqli, $restaurant_id);
        } 
        
        
        else if ($_POST['homeRequest'] == 'restaurantdish') {
            $restaurant_id   =  $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $HomeData->GetRestaurantDishes($mysqli, $restaurant_id);
        } 
        
        
        else if ($_POST['homeRequest'] == 'checkaddress') {
            $user_id   =  $uiEncry->useridDecrypt($_POST['user_id']);
            $HomeData->CheckUserAddress($mysqli, $user_id);
        }
    } 
    
    
    
    
    
    
    else if ($action == 'cartRequest') {
        if ($_POST['cartRequest'] == 'save_cart') {
            $restarant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $user_id     = $uiEncry->useridDecrypt($_POST['user_id']);
            $dish_id     = $uiEncry->useridDecrypt($_POST['dish_id']);
            $dish_name   = $_POST['dish_name'];
            $dish_pic    = $_POST['dish_pic'];
            $item_count  = $_POST['item_count'];
            $dish_price  = $_POST['dish_price'];

            $res = $cartItems->SaveToCart($mysqli, $restarant_id, $user_id, $dish_id, $dish_name, $dish_pic, $item_count, $dish_price);
        } 
        
        
        
        else if ($_POST['cartRequest'] == 'cartList') {
            $u_user_id   =  $uiEncry->useridDecrypt($_POST['user_id']);
            $res = $cartItems->GetCartList($mysqli, $u_user_id);
           


        } 
        
        
        else if ($_POST['cartRequest'] == 'update') {
            $user_id   =  $uiEncry->useridDecrypt($_POST['user_id']);
            $dish_id   =  $uiEncry->useridDecrypt($_POST['dish_id']);
            $item      = $_POST['item'];
            $dish_price = $_POST['dish_price'];
            $res = $cartItems->itemPriceUpdate($mysqli, $user_id, $dish_id, $item, $dish_price);


        } 
        
        
        
        else if ($_POST['cartRequest'] == 'updatecart') {
            $user_id   =  $uiEncry->useridDecrypt($_POST['user_id']);
            $cart_id   =  $uiEncry->useridDecrypt($_POST['cart_id']);
            $item      = $_POST['item'];
            $dish_price = $_POST['dish_price'];
            $res = $cartItems->itemPriceCartUpdate($mysqli, $user_id, $cart_id, $item, $dish_price);
        } 
        
        
        else if ($_POST['cartRequest'] == 'deletecart') {
            $cart_id   =  $uiEncry->useridDecrypt($_POST['cart_id']);
            $res = $cartItems->DeleteFromCart($mysqli, $cart_id);
        } 

        
        else if ($_POST['cartRequest'] == 'get_cart_details') {
            $res = $cartItems->GetCartDetails($mysqli);
        } 
        
        
        else if ($_POST['cartRequest'] == 'save_order') {

            $cart_id    = $uiEncry->useridDecrypt($_POST['cart_id']);
            $subtotal   = $_POST['subtotal'];
            $total      = $_POST['total_amount'];
            $delivery_status = 0;
            $res = $cartItems->SaveOrder($mysqli, $cart_id, $delivery_status, $subtotal, $total);
        }


        else if ($_POST['cartRequest'] == 'update_order') {
            $order_id    = $uiEncry->useridDecrypt($_POST['order_id']);
            $user_id    = $uiEncry->useridDecrypt($_POST['user_id']);
            $dish_id    = $uiEncry->useridDecrypt($_POST['dish_id']);
            $restaurant_id    = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $item_name  = $_POST['item_name'];
            $item_pic   = $_POST['item_pic'];
            $quantity   = $_POST['quantity'];
            $generated_order_id = '#'. rand(111111,999999);
            $res = $cartItems->UpdateOrder($mysqli, $order_id, $user_id, $dish_id, $restaurant_id, $generated_order_id, $item_name, $item_pic, $quantity);
        }
        
        

    } 
    
    
    
    
    

    
    else if ($action == 'profileRequest') {
        if ($_POST['profileRequest'] == 'userprofile') {
            $user_id     = $uiEncry->useridDecrypt($_POST['user_id']);
            $res = $profile->GetUserProfile($mysqli, $user_id);
        } 
        
        
        else if ($_POST['profileRequest'] == 'useraddress') {
            $user_id     = $uiEncry->useridDecrypt($_POST['user_id']);
            $res = $payment->GetAddress($mysqli, $user_id);
        }

        else if ($_POST['profileRequest'] == 'restaurantprofile') {
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $profile->GetResProfile($mysqli, $restaurant_id);
        } 
    } 
    

    
    
    
    
    else if ($action == 'paymentRequest') {
        if ($_POST['paymentRequest'] == 'orderinfo') {
            $res = $payment->GetOrderInfo($mysqli);
        }
    } 
    
    
    
    
    else if ($action == 'orderRequest') {

        if ($_POST['orderRequest'] == 'myorder') {
            $user_id     = $uiEncry->useridDecrypt($_POST['user_id']);
            $res = $order->getOrderDetails($mysqli, $user_id);
        }

        else if($_POST['orderRequest'] == 'orders') {
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $order->GetOrders($mysqli, $restaurant_id);
        }


        else if($_POST['orderRequest'] == 'users_order') {
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $order->UsersOrder($mysqli, $restaurant_id);
        }


        else if($_POST['orderRequest'] == 'user_order_details') {
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $order->getUserAndOrderDetails($mysqli, $restaurant_id);
        }


        else if($_POST['orderRequest'] == 'get_location_name') {
            $lat   = $_POST['latitude'];
            $long   = $_POST['longitude'];
            $res = $order->GetLocationName($mysqli, $lat, $long);
        }


        else if($_POST['orderRequest'] == 'order_status') {
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $user_id           = $uiEncry->useridDecrypt($_POST['user_id']);
            $cart_id           = $uiEncry->useridDecrypt($_POST['cart_id']);
            $dish_id           = $uiEncry->useridDecrypt($_POST['dish_id']);
            $delivery_status   = 1;
            $res = $order->changeOrderStatus($mysqli, $delivery_status, $restaurant_id, $user_id, $cart_id, $dish_id);
        }


        else if($_POST['orderRequest'] == 'dev_status') {
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $user_id           = $uiEncry->useridDecrypt($_POST['user_id']);
            $cart_id           = $uiEncry->useridDecrypt($_POST['cart_id']);
            $dish_id           = $uiEncry->useridDecrypt($_POST['dish_id']);
            $delivery_status   = 2;
            $res = $order->changeDeliveryOrderStatus($mysqli, $delivery_status, $restaurant_id, $user_id, $cart_id, $dish_id);
        }

        else if ($_POST['orderRequest'] == 'get_accepted_order') {
            $rider_id    = $uiEncry->useridDecrypt($_POST['rider_id']);

            $res = $order->getOrderForRider($mysqli,  $rider_id);
        }

        else if ($_POST['orderRequest'] == 'get-order-info') {
            $order_id    = $uiEncry->useridDecrypt($_POST['order_id']);

            $res = $order->GetTrackOrderInfo($mysqli, $order_id);
        }
    } 
    
    
    
    
    
    
    
    else if ($action == 'searchRequest') {
        if ($_POST['searchRequest'] == 'search') {
            $query = $_POST['query'];
            $res = $HomeData->searchResults($mysqli, $query);
        }
    }






    
    else if($action == 'notifyRequest') {
        if($_POST['notifyRequest'] == 'notification') {
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $notification->GetNotifications($mysqli, $restaurant_id);
        }


        else if($_POST['notifyRequest'] == 'rider_notification') {
            $res = $notification->GetRiderNotifications($mysqli);
        }


        else if($_POST['notifyRequest'] == 'read_notification') {
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $notification->GetReadNotifications($mysqli, $restaurant_id);
        }


        else if($_POST['notifyRequest'] == 'check_res_notification') {
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $notification->CheckForNotifications($mysqli, $restaurant_id);
        }


        else if($_POST['notifyRequest'] == 'check_rider') {
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $notification->checkRiderAcceptedOrder($mysqli, $restaurant_id);
        }


        else if($_POST['notifyRequest'] == 'pickup') {
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $notification->RiderPickUp($mysqli, $restaurant_id);
        }


        else if($_POST['notifyRequest'] == 'check_rider_notification') {
            $res = $notification->CheckForRiderNotifications($mysqli);
        }


        else if($_POST['notifyRequest'] == 'check_user_notification') {
            $user_id     = $uiEncry->useridDecrypt($_POST['user_id']);
            $res = $notification->CheckForNotifications($mysqli, $user_id);
        }


        else if($_POST['notifyRequest'] == 'change_res_status') {
            $notification_id     = $uiEncry->useridDecrypt($_POST['notification_id']);
            $res = $notification->changeNotificationStatus($mysqli, $notification_id);
        }

        else if($_POST['notifyRequest'] == 'change_rider_status') {
            $notification_id     = $uiEncry->useridDecrypt($_POST['notification_id']);
            $res = $notification->changeRiderNotificationStatus($mysqli, $notification_id);
        }

        else if($_POST['notifyRequest'] == 'change_user_status') {
            $notification_id     = $uiEncry->useridDecrypt($_POST['notification_id']);
            $res = $notification->changeNotificationStatus($mysqli, $notification_id);
        }


        else if($_POST['notifyRequest'] == 'read_status') {
            $notification_id     = $uiEncry->useridDecrypt($_POST['notification_id']);
            $res = $notification->changeReadNotificationStatus($mysqli, $notification_id);
        }

        
        else if ($_POST['notifyRequest'] == 'notify') {
            $user_id    = $uiEncry->useridDecrypt($_POST['user_id']);
            $restaurant_id    = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $message  = $_POST['message'];
            $status   = '0';

            $res = $notification->NotifyRestaurant($mysqli, $user_id, $restaurant_id, $message, $status);
        }

        else if ($_POST['notifyRequest'] == 'notify_riders') {
            $user_id    = $uiEncry->useridDecrypt($_POST['user_id']);
            $restaurant_id    = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $message  = $_POST['message'];
            $status   = '2';

            $res = $notification->NotifyRiders($mysqli, $user_id, $restaurant_id, $message, $status);
        }

        else if ($_POST['notifyRequest'] == 'rider_order') {
            $notification_id    = $uiEncry->useridDecrypt($_POST['notification_id']);
            $rider_id    = $uiEncry->useridDecrypt($_POST['rider_id']);
            $message  = $_POST['message'];
            $status   = '4';
            $read_status = 1;

            $res = $notification->riderAcceptedOrder($mysqli, $notification_id, $rider_id, $message, $status, $read_status);
        }

        else if ($_POST['notifyRequest'] == 'rider_request') {
            $restaurant_id = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $notification->getRiderInfo($mysqli, $restaurant_id);
        }

        else if ($_POST['notifyRequest'] == 'track-order') {
            $user_id = $uiEncry->useridDecrypt($_POST['user_id']);
            $res = $notification->TrackOrder($mysqli, $user_id);
        }

        
    }










    

    
    else if($action == 'resRequest') {
        if($_POST['resRequest'] == 'dishes') {
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $menu->GetDishes($mysqli, $restaurant_id);
        }

        else if($_POST['resRequest'] == 'edit-page') {
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $dish_id           = $uiEncry->useridDecrypt($_POST['dish_id']);
            $res = $menu->GetDishForEdit($mysqli, $restaurant_id, $dish_id);
        }


        else if($_POST['resRequest'] == 'delete') {
            $dish_id           = $uiEncry->useridDecrypt($_POST['dish_id']);
            $res = $menu->DeleteDish($mysqli, $dish_id);
        }


        else if($_POST['resRequest'] == 'edit') {
            $dish_id           = $uiEncry->useridDecrypt($_POST['dish_id']);
            $dish_name   = $_POST['dish_name'];
          $dish_pic    = @$_FILES['dish_pic']['name'];


            if ($dish_pic != null) {
                $imagePath = '../assets/';
                $imagePath = $imagePath . basename($_FILES['dish_pic']['name']);
                move_uploaded_file($_FILES['dish_pic']['tmp_name'], $imagePath);

                ///////////////////////////////////////////////////////////////////
                //////////////////////Image Resize usage///////////////////////////

                $img = new ImageUtil($imagePath);
                // set width, height and image resize option

                $img->resize(180, 100)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/small/'. $dish_pic);

                $img->resize(450, 300)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/medium/'. $dish_pic);

                $img->resize(750, 500)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/minimedium/'. $dish_pic);

                $img->resize(1000, 800)
                // save path to file. Can be .jpg, .jpeg, .gif or .png
                ->save('../assets/large/'. $dish_pic);

            } else if ($dish_pic['error'] !== UPLOAD_ERR_OK) {
                echo 'File upload failed with error code ' . $dish_pic['error'];
            }
            $price       = $_POST['price'];
            $description = $_POST['description'];
            $dish_pic = $file_path . $dish_pic;

            $res = $menu->EditDish($mysqli, $dish_id, $dish_name, $dish_pic, $price, $description);
        }
    }















    else if ($action == 'deliveryRequest'){
        if($_POST['deliveryRequest'] == 'food_pickup'){
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $delivery->foodPickUp($mysqli, $restaurant_id);
        }

        else if($_POST['deliveryRequest'] == 'delivered'){
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $res = $delivery->DisplayDeliverySuccess($mysqli, $restaurant_id);
        }

        else if($_POST['deliveryRequest'] == 'arrived'){
            $restaurant_id     = $uiEncry->useridDecrypt($_POST['restaurant_id']);
            $user_id           = $uiEncry->useridDecrypt($_POST['user_id']);
            $res = $delivery->RiderArrived($mysqli, $restaurant_id, $user_id);
        }
    }




}