

$(function () {

    $("#fname_error_message").hide();
    $("#lname_error_message").hide();
    $("#phone_error_message").hide();
    $("#email_error_message").hide();
    $("#password_error_message").hide();

    var error_fname = false;
    var error_lname = false;
    var error_phone = false;
    var error_email = false;
    var error_password = false;

    $("#fname").focusout(function () {
        check_fname();
    });
    $("#lname").focusout(function () {
        check_lname();
    });
    $("#number").focusout(function () {
        check_phone();
    });
    $("#email").focusout(function () {
        check_email();
    });
    $("#pass").focusout(function () {
        check_password();
    });


    function check_fname() {
        var pattern = /^[a-zA-Z\s]*$/;
        var username = $("#fname").val();
        if (pattern.test(username) && username !== '') {
            $("#fname_error_message").hide();
        } else {
            $("#fname_error_message").html("Should contain only Characters");
            $("#fname_error_message").show();
            error_fname = true;
        }
    }

    function check_lname() {
        var pattern = /^[a-zA-Z\s]*$/;
        var username = $("#lname").val();
        if (pattern.test(username) && username !== '') {
            $("#lname_error_message").hide();
        } else {
            $("#lname_error_message").html("Should contain only Characters");
            $("#lname_error_message").show();
            error_lname = true;
        }
    }

    function check_phone() {
        var pattern = /^[0-9]*$/;
        var phone = $("#number").val()
        if (pattern.test(phone) && phone !== '') {
            $("#phone_error_message").hide();
        } else {
            $("#phone_error_message").html("Should contain only numbers");
            $("#phone_error_message").show();
            error_phone = true;
        }
    }

    function check_email() {
        var pattern = /^[a-zA-Z0-9.!#$%'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var email = $("#email").val()
        if (pattern.test(email) && email !== '') {
            $("#email_error_message").hide();
        } else {
            $("#email_error_message").html("Incorrect email format");
            $("#email_error_message").show();
            error_email = true;
        }
    }

    function check_password() {
        var password_length = $("#pass").val().length;
        if (password_length < 8) {
            $("#password_error_message").html("Should contain at least 8 Characters");
            $("#password_error_message").show();
            error_password = true;
        } else {
            $("#password_error_message").hide();
        }
    }



    $("#signupbutton").on('click', (function (e) {
        e.preventDefault();

        var error_fname = false;
        var error_lname = false;
        var error_phone = false;
        var error_email = false;
        var error_password = false;

        $('#error_message').hide();



        check_fname();
        check_lname();
        check_phone();
        check_email();
        check_password();

        if (error_fname === false && error_lname === false && error_phone === false && error_email === false && error_password === false) {
            var fname = $('#fname').val();
            var lname = $('#lname').val();
            var phone = $('#number').val();
            var email = $('#email').val();
            var pass = $('#pass').val();


            $("#loader").css("display", "inline-block");

            $("#signupbutton").hide();
            
            $.ajax({
                url: '../includes/SqlDataCrud.php',
                type: 'post',
                data: { 'action': 'callRequest', callRequest: 'sign_up', 'fname': fname, 'lname': lname, 'number': phone, 'email': email, 'pass': pass },
                success: function (data) {
                    let res = JSON.parse(data);

                    //console.log(res)
                    if (res == 'User already exists') {

                        $('#error_message').show();
                        $('#error_message').html('User already exist please login');
                    }
                    else if (res == 'Registration failed') {
                        $('#error_message').show();
                        $('#error_message').html('Registration failed please try again');
                    }
                    else if (res.response == 'success') {
                        VerifyUser(res.user_id)
                    }

                }
            })
            
            return true;
        } else {
            alert("Please fill the form Correctly");
            return false;
        }


    }))
});




$('#loginbutton').on('click', (function (e) {
    e.preventDefault();
    var phonenumber = $('#number').val();
    var pass = $('#pass').val();

    $("#loader").show();

    $("#loginbutton").hide();

    $.ajax({
        url: '../includes/SqlDataCrud.php',
        type: 'post',
        data: { 'action': 'callRequest', callRequest: 'sign_in', 'number': phonenumber, 'pass': pass },
        success: function (data) {
            let res = JSON.parse(data);

            //console.log(res)

            if (res == 'User does not exist') {

                $('#error_message').show();
                $('#error_message').html('User does not exist please create an account');
            }
            else if (res == 'Login not successfull') {
                $('#error_message').show();
                $('#error_message').html('Login not successfull please try again');
            }
            else if (res.response == 'success') {
                VerifyUser(res.user_id)
            }

        }
    })


}))



function VerifyUser(signup_user_data) {

    document.getElementById('verify_account_user').style.display = 'block'

    document.getElementById('loginbody').style.display = 'none'




    var otp_inputs = document.querySelectorAll(".otp__digit")
    var mykey = "0123456789".split("")
    otp_inputs.forEach((_) => {
        _.addEventListener("keyup", handle_next_input)
    })
    function handle_next_input(event) {
        let current = event.target
        let index = parseInt(current.classList[1].split("__")[2])
        current.value = event.key

        if (event.keyCode == 8 && index > 1) {
            current.previousElementSibling.focus()
        }
        if (index < 6 && mykey.indexOf("" + event.key + "") != -1) {
            var next = current.nextElementSibling;
            next.focus()
        }
        var _finalKey = ""
        for (let { value } of otp_inputs) {
            _finalKey += value
        }
        if (_finalKey.length == 6) {
            //document.querySelector("#_otp").classList.replace("_notok", "_ok")
            //document.querySelector("#_otp").innerText = _finalKey
            SendVerifyCode(_finalKey, signup_user_data);
        } else {
            // document.querySelector("#_otp").classList.replace("_ok", "_notok")
            // document.querySelector("#_otp").innerText = _finalKey
        }
    }

}




async function SendVerifyCode(_finalKey, tokentrack) {

    const VerifyRequest = new FormData();
    VerifyRequest.append('action', 'callRequest');
    VerifyRequest.append('callRequest', 'verifyUserLogin');
    VerifyRequest.append('otpCode', _finalKey);
    VerifyRequest.append('requestSource', "webResquest");
    VerifyRequest.append('tokenIdentityId', tokentrack);

    const rawResponse = await fetch('../includes/SqlDataCrud.php', {
        method: 'POST',
        body: VerifyRequest
    });

    const resCode = await rawResponse.json();


    if (resCode.response == 'success') {

        window.location.href = '../src/homepage.php';

        
    } else if (resCode.response == 'incorrect') {

        $('#error_message').show();
        $('#error_message').html('Incorrect code');

    }


    else {
        console.log(resCode)
    }




}


//Register Restaurant
$('#register_restaurant_button').on('click', function (e) {
    e.preventDefault();

    var restaurant_name = $('#res-name').val();
    var res_pic = document.getElementById('res-pic').files[0];
    var restaurant_owner = $('#owner').val();
    var restaurant_contact = $('#res-number').val();
    var restaurant_email = $('#res-email').val();
    var workers = $('#workers').val();
    var restaurant_type = $('#res-type').val();
    var work_hours = $('#work-hours').val();
    var restaurant_location = $('#res-location').val();
    var pass = $('#pass').val();

    if (!res_pic) {
        $('#error_message').show();
        $('#error_message').html('Please select a file.');
        return;
    }

    var formData = new FormData();
    formData.append('action', 'callRequest');
    formData.append('callRequest', 'register_res');
    formData.append('restaurant_name', restaurant_name);
    formData.append('restaurant_pic', res_pic); 
    formData.append('restaurant_owner', restaurant_owner);
    formData.append('restaurant_contact', restaurant_contact);
    formData.append('restaurant_email', restaurant_email);
    formData.append('workers', workers);
    formData.append('restaurant_type', restaurant_type);
    formData.append('work_hours', work_hours);
    formData.append('restaurant_location', restaurant_location);
    formData.append('pass', pass);

    $.ajax({
        url: '../includes/SqlDataCrud.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            let res = JSON.parse(data);

            if (res == 'Restaurant registration successful') {
                $('.registration-done').css("display", "flex")
                $("#loginbody").css("display", "none")

                $("#go").click(function () {

                    window.location.href = '../arfrobite/homepage.php';
                    
                })
             } else if (res == 'Restaurant registration failed') {
                $('#error_message').show();
                $('#error_message').html('Restaurant registration failed, please try again');
            }
        }
    });
});




//Register Rider
$('#register_rider_button').on('click', (function (e) {
    e.preventDefault();
    var rider_name = $('#rider-name').val();
    var rider_pic = document.getElementById('rider-pic').files[0];
    var rider_contact = $('#rider-number').val();
    var rider_email = $('#rider-email').val();
    var rider_location = $('#rider-location').val();
    var rider_password = $('#pass').val();


    if (!rider_pic) {
        $('#error_message').show();
        $('#error_message').html('Please select a file.');
        return;
    }

    var formData = new FormData();
    formData.append('action', 'callRequest');
    formData.append('callRequest', 'register_rider');
    formData.append('rider_name', rider_name);
    formData.append('rider_pic', rider_pic); 
    formData.append('rider_contact', rider_contact);
    formData.append('rider_email', rider_email);
    formData.append('rider_location', rider_location);
    formData.append('password', rider_password);


    $.ajax({
        url: '../includes/SqlDataCrud.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            let res = JSON.parse(data);

            if (res == 'Rider registration successful') {
                $('.registration-done').css("display", "flex")
                $("#loginbody").css("display", "none")

                $("#go").click(function () {

                    window.location.href = '../arfrobite/homepage.php';
                    
                })
            }
            else if (res == 'Rider registration failed') {
                $('#error_message').show();
                $('#error_message').html('Rider registration failed, please try again');
            }

        }
    })

}));




//Restaurant admin login
$('#res_loginbutton').on('click', (function (e) {
    e.preventDefault();
    var loginnumber = $('#number').val();
    var pass = $('#pass').val();

    $("#loader").show();

    $("#res_loginbutton").hide();

    $.ajax({
        url: '../includes/SqlDataCrud.php',
        type: 'post',
        data: { 'action': 'callRequest', callRequest: 'sign_res_in', 'number': loginnumber, 'pass': pass },
        success: function (data) {
            let res = JSON.parse(data);

            if (res == 'Restaurant does not exists') {
                $("#loader").hide();
                $("#res_loginbutton").show();
                $('#error_message').show();
                $('#error_message').html('Restaurant does not exist please create an account');
            }
            else if (res == 'Restaurant login not successful') {
                $("#loader").hide();
                $("#res_loginbutton").show();
                $('#error_message').show();
                $('#error_message').html('Restaurant login not successfull please try again');
            }
            else if ('Restaurant login successful') {
                window.location.href= "dashboard/dashboard.php"
            }

        }
    })


}))



//Add dish
$('#register_dish_button').on('click', (function (e) {
    e.preventDefault();
    var dish_name = $('#dish-name').val();
    var dish_pic = document.getElementById('dish-pic').files[0];
    var price = $('#price').val();
    var description = $('#description').val();

    if (!dish_pic) {
        $('#error_message').show();
        $('#error_message').html('Please select a file.');
        return;
    }

    var formData = new FormData();
    formData.append('action', 'callRequest');
    formData.append('callRequest', 'register_dish');
    formData.append('restaurant_id', res_id );
    formData.append('dish_name', dish_name);
    formData.append('dish_pic', dish_pic); 
    formData.append('price', price);
    formData.append('description', description);

    $.ajax({
        url: '../../includes/SqlDataCrud.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            let res = JSON.parse(data);

            if (res == 'Dish addition successful') {
                $('.registration-done').css("display", "flex")
                $("#loginbody").css("display", "none")

                $("#go").click(function () {

                    window.location.href = 'menu.php'; 

                })
            }
            else if (res == 'Dish addition failed') {
                $('#error_message').show();
                $('#error_message').html('Dish addition failed, please try again');
            }

        }
    })


}));



$('#rider_loginbutton').on('click', (function (e) {
    e.preventDefault();
    var loginnumber = $('#number').val();
    var pass = $('#pass').val();

    $("#loader").show();

    $("#rider_loginbutton").hide();

    $.ajax({
        url: '../includes/SqlDataCrud.php',
        type: 'post',
        data: { 'action': 'callRequest', callRequest: 'sign_in_rider', 'number': loginnumber, 'pass': pass },
        success: function (data) {
            let res = JSON.parse(data);

            if (res == 'Rider does not exist') {
                $("#loader").hide();
                $("#rider_loginbutton").show();
                $('#error_message').show();
                $('#error_message').html('Rider does not exist please create an account');
            }
            else if (res == 'Rider login not successful') {
                $("#loader").hide();
                $("#rider_loginbutton").show();
                $('#error_message').show();
                $('#error_message').html('Rider login not successfull please try again');
            }
            else if ('Rider login successful') {
                window.location.href= "dashboard/dashboard.php"
            }

        }
    });


}));


