
     <style>
        .location{
            display: flex;
            flex-direction: column;
            margin-left: 100px;
            margin-right: 50px;
        }

        .location span{
            font-size: 17px;
        }

        .location-name{
            display: flex;
            align-items: center;
        }

        .location-name span{
            font-size: 22px;
            font-style: 900;
        }

        #sidebarMenu {
            height: 100%;
            position: fixed;
            left: 0;
            width: 250px;
            transform: translateX(-250px);
            transition: transform 250ms ease-in-out;
            background: linear-gradient(180deg, #000 0%, #888 100%);
            z-index: 1000;
            bottom: 0;
            top: 100px;
        }


        .sidebarMenuInner{
            margin:0;
            padding:0;
            border-top: 1px solid rgba(255, 255, 255, 0.10);
        }


        .sidebarMenuInner li{
            list-style: none;
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
            padding: 20px;
            cursor: pointer;
            border-bottom: 1px solid rgba(255, 255, 255, 0.10);
        }

        .sidebarMenuInner a {
            display: flex;
            border-bottom: 1px solid rgba(255, 255, 255, 0.10);
        }


        .sidebarMenuInner li svg{
            font-size: 14px;
            margin-right: 20px;
        }


        .sidebarMenuInner li a{
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }


        input[type="checkbox"]:checked ~ #sidebarMenu {
            transform: translateX(0);
        }


        input[type=checkbox] {
            transition: all 0.3s;
            box-sizing: border-box;
            display: none;
        }


        .sidebarIconToggle {
            transition: all 0.3s;
            box-sizing: border-box;
            cursor: pointer;
            position: absolute;
            z-index: 99;
            height: 100%;
            width: 100%;
            top: 40px;
            left: 20px;
            height: 23px;
            width: 30px;
        }


        .spinner {
            transition: all 0.3s;
            box-sizing: border-box;
            position: absolute;
            height: 5px;
            width: 100%;
            background-color: #fff;
        }


        .horizontal {
            transition: all 0.3s;
            box-sizing: border-box;
            position: relative;
            float: left;
            margin-top: 5px;
        }


        .diagonal.part-1 {
            position: relative;
            transition: all 0.3s;
            box-sizing: border-box;
            float: left;
        }


        .diagonal.part-2 {
            transition: all 0.3s;
            box-sizing: border-box;
            position: relative;
            float: left;
            margin-top: 5px;
        }


        input[type=checkbox]:checked ~ .sidebarIconToggle > .horizontal {
            transition: all 0.3s;
            box-sizing: border-box;
            opacity: 0;
        }


        input[type=checkbox]:checked ~ .sidebarIconToggle > .diagonal.part-1 {
            transition: all 0.3s;
            box-sizing: border-box;
            transform: rotate(135deg);
            margin-top: 8px;
        }


        input[type=checkbox]:checked ~ .sidebarIconToggle > .diagonal.part-2 {
            transition: all 0.3s;
            box-sizing: border-box;
            transform: rotate(-135deg);
            margin-top: -15px;
        }


        @media (min-width: 1200px) {

            .top-container{
                display: none;
            }


        }


     </style>
     <!-- Show user location and profile image -->
      <div style="display: flex; align-items: center;">
     
      <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
      <label for="openSidebarMenu" class="sidebarIconToggle">
        <div class="spinner diagonal part-1"></div>
        <div class="spinner horizontal"></div>
        <div class="spinner diagonal part-2"></div>
      </label>

      <div id="sidebarMenu">
      <ul class="sidebarMenuInner">
          <li>Welcome <br> <span>Harrison Wells</span></li>
          <a><li onclick="window.location.href='dashboard.php'"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="22" viewBox="0 0 576 512"><path fill="#FFFFFF80" d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>Dashboard</li></a>
          <a><li onclick="window.location.href='delivery.php'"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="24" viewBox="0 0 640 512"><path fill="#FFFFFF80" d="M280 32c-13.3 0-24 10.7-24 24s10.7 24 24 24h57.7l16.4 30.3L256 192l-45.3-45.3c-12-12-28.3-18.7-45.3-18.7H64c-17.7 0-32 14.3-32 32v32h96c88.4 0 160 71.6 160 160c0 11-1.1 21.7-3.2 32h70.4c-2.1-10.3-3.2-21-3.2-32c0-52.2 25-98.6 63.7-127.8l15.4 28.6C402.4 276.3 384 312 384 352c0 70.7 57.3 128 128 128s128-57.3 128-128s-57.3-128-128-128c-13.5 0-26.5 2.1-38.7 6L418.2 128H480c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32H459.6c-7.5 0-14.7 2.6-20.5 7.4L391.7 78.9l-14-26c-7-12.9-20.5-21-35.2-21H280zM462.7 311.2l28.2 52.2c6.3 11.7 20.9 16 32.5 9.7s16-20.9 9.7-32.5l-28.2-52.2c2.3-.3 4.7-.4 7.1-.4c35.3 0 64 28.7 64 64s-28.7 64-64 64s-64-28.7-64-64c0-15.5 5.5-29.7 14.7-40.8zM187.3 376c-9.5 23.5-32.5 40-59.3 40c-35.3 0-64-28.7-64-64s28.7-64 64-64c26.9 0 49.9 16.5 59.3 40h66.4C242.5 268.8 190.5 224 128 224C57.3 224 0 281.3 0 352s57.3 128 128 128c62.5 0 114.5-44.8 125.8-104H187.3zM128 384a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/></svg>Delivery Mangement</li></a>
          <a><li onclick="window.location.href='orders.php'"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="22" viewBox="0 0 576 512"><path fill="#FFFFFF80" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>Orders</li></a>
          <a><li onclick="window.location.href='payment-process.php'"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="16" viewBox="0 0 384 512"><path fill="#FFFFFF80" d="M192 0c-41.8 0-77.4 26.7-90.5 64H64C28.7 64 0 92.7 0 128V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H282.5C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM112 192H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>Payment</li></a>
          <a><li onclick="window.location.href='notification.php'"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="16" viewBox="0 0 448 512"><path fill="#FFFFFF80" d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/></svg>Notifications</li></a>
          <a><li onclick="window.location.href='settings.php'"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><path fill="#FFFFFF80" d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/></svg>Settings</li></a>  
         <a id="logout"><li><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><path fill="#FFFFFF80" d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg>Logout</li></a>
        </ul>
      </div>

      <div class="location">
        <div class="location-name">
          <svg xmlns="http://www.w3.org/2000/svg" height="28" width="26" viewBox="0 0 448 512">
            <path
              d="M429.6 92.1c4.9-11.9 2.1-25.6-7-34.7s-22.8-11.9-34.7-7l-352 144c-14.2 5.8-22.2 20.8-19.3 35.8s16.1 25.8 31.4 25.8H224V432c0 15.3 10.8 28.4 25.8 31.4s30-5.1 35.8-19.3l144-352z"
              fill="#fff" />
          </svg>
          <span>Your Location</span>
        </div>
        <span class="location-index">Taifa - Elephant street</span>
      </div>

        <!-- <div><svg xmlns="http://www.w3.org/2000/svg" height="26" width="23" viewBox="0 0 448 512"><path fill="#ffffff" d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112v25.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V208c0-61.9 50.1-112 112-112zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"/></svg></div> -->
        <div><svg id="notification" xmlns="http://www.w3.org/2000/svg" height="26" width="23" viewBox="0 0 448 512"><path fill="#ebf2ff" d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/></svg></div>
      </div>