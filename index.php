<?php

if (isset($_COOKIE['uid'])) {

    header("Location: src/homepage.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Arfrobite</title>
    <?php include "includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        border: 0;
        background: #000;
        height: 100%;
        width: 100%;
    }

    .image img {
        width: 100%;
        height: 50%;
    }

    .header {
        line-height: 10px;
        margin-top: -60px;
        margin-left: 20px;
    }

    .header h1 {
        color: #fff;
        font-weight: 700;
        font-size: 74px;
    }

    .header h2 {
        color: #E5091462;
        font-size: 30px;
        font-weight: 700;
    }

    .buttons {
        margin-top: 70px;
    }

    .buttons button {
        background: #E5091461;
        border-radius: 40px;
        height: 70px;
        width: 90%;
        border: none;
        color: #fff;
        font-size: 24px;
        margin: 20px 0 0 20px;
    }

    .signup button {
        background: none;
        border: 1px solid #E5091461;
    }

    @media (min-width: 1200px) {
        body {
            position: fixed;
        }

        .image {
            width: 520px;
            height: 100vh;
            position: relative;
            display: inline-block;
        }

        .image img {
            width: 100%;
            height: 100vh;
        }

        .header {
            float: right;
            position: absolute;
            margin: 0;
            top: 10%;
            left: 45%;
        }

        .header h1 {
            font-size: 110px;
        }

        .header h2 {
            font-size: 40px;
        }

        .buttons {
            float: right;
            position: absolute;
            margin: 0;
            top: 50%;
            left: 45%;
            width: 100%;
            display: flex;
            gap: 50px;
        }

        .buttons button {
            border-radius: 15px;
            width: 100%;
            margin: 20px 10px 10px 0;
        }

        .login {
            width: 20%;
        }

        .signup {
            width: 20%;
        }


        #typing-container {
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            margin-top: -20px;
        }

        #typing-text {
            display: inline-block;
            border-right: 1px solid #000;
        }


        #typing-cursor {
            display: inline-block;
            width: 10px;
            height: 27px;
            background-color: #E5091462;
            margin-left: 2px;
            animation: blinkCursor 0.7s infinte;
        }

        @keyframes blinkCursor {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }


        .gradient-overlay{
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            pointer-events: none;
            background: linear-gradient(to right, transparent, rgba(0, 0, 0, 0.9));
        }
    }


    @media (min-height: 950px) {
        .image {
            width: 630px;
        }

        

    }
</style>

<body>
    <div class="image">
        <img src="assets/burger.png" alt="page-image">
        <div class="gradient-overlay"></div>
    </div>

    <div class="header">
        <h1>ArfroBite</h1>
        <div id="typing-container">
            <h2 id="typing-text"></h2>
            <span id="typing-cursor"></span>
        </div>

    </div>

    <div class="buttons">
        <div class="login">
            <button id="login">Login</button>
        </div>

        <div class="signup">
            <button id="signup">Sign up</button>
        </div>
    </div>
</body>

<script>
    const textToType = "At your Door Step";
    const typeSpeed = 100;

    let i = 0;

    if (window.innerWidth > 1200) {
        function typeText() {
            if (i < textToType.length) {
                document.getElementById("typing-text").innerHTML += textToType.charAt(i);
                i++;
                setTimeout(typeText, typeSpeed);
            } else {
                document.getElementById("typing-cursor").style.display = "none";
            }
        }

        typeText();
    }

    else{
        document.getElementById("typing-text").innerHTML = textToType;
    }


    var login = document.getElementById("login");
    var signup = document.getElementById("signup");

    login.addEventListener("click", function() {
        window.location.href = 'src/signin.php';
    });

    signup.addEventListener("click", function() {
        window.location.href = 'src/signup.php';
    });


</script>

</html>