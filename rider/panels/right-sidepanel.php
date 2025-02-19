<style>


    .panel-location {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #111;
        border-radius: 8px;
        margin: 14px 7px 14px 7px;
        padding: 5px 0;
        cursor: pointer;
    }

    .panel-location span {
        font-size: 17px;
    }

    .panel-location-name {
        display: flex;
        align-items: center;
    }

    .panel-location-name span {
        font-size: 22px;
        font-style: 900;
        margin-left: 6px;
    }

    .cart-items{
        width: 90%;
        margin-left: 17px;
    }
    
    .cart-header{
        color: #fff;
        width: 100%;
    }

    .header{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .header p{
        font-size: 28px;
    }

</style>

<div>
    <div class="panel-location">
        <div class="panel-location-name">
            <svg xmlns="http://www.w3.org/2000/svg" height="28" width="26" viewBox="0 0 448 512">
                <path d="M429.6 92.1c4.9-11.9 2.1-25.6-7-34.7s-22.8-11.9-34.7-7l-352 144c-14.2 5.8-22.2 20.8-19.3 35.8s16.1 25.8 31.4 25.8H224V432c0 15.3 10.8 28.4 25.8 31.4s30-5.1 35.8-19.3l144-352z" fill="#fff" />
            </svg>
            <span>Your Location</span>
        </div>
        <span class="location-index"></span>
    </div>



    <div class="cart-items">
        
    <header class="cart-header">
        <div class="header">
            <p>Todays Orders</p>
        </div>
    
    </header>

    <?php include "cart.php"; ?>
    </div>


    <!-- <hr> -->


    <?php //include "promotions.php"; ?>
</div>

<script>
  $(".panel-location").click(function () {
  window.location.href = "address-screen.php";
});
</script>