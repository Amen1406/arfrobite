<script>

   getUserProfile(user_id)
 
</script>

<style>

.top{
    color: #fff;
    padding: 32px 10px 0 10px;
    height: 45px;
    background: #000;
}



#profile-pic{
    width: 50px; 
    height:50px; 
    border-radius: 50%;
}

.search-bar{
    position: relative;
    margin-top: 15px;
    width: 50%;
}

.search-bar input{
    position: relative;
    height: 45px;
    width: 100%;
    border: 1px solid black;
    border-radius: 10px;
    font-size: 18px;
    padding: 0 8px;
    color: #000;
}

.search-bar svg{
    position: absolute;
    top: 9px;
    right: 10px;
}

#profile-container{
    position: absolute;
    right: 10px;
    top: 60px;
    background: #252525;
    box-shadow: 0 10px 16px rgba(0, 0, 0, 0.7);
    padding: 15px;
    z-index: 1;
    width: 350px;
    height: 230px;
    border-radius: 10px;
}

.hprofile{
    cursor: pointer;
}


.profile{
    height: 100px;
    width: 100px;
    border-radius: 50%;
    object-fit: cover;
}

.account-info{
    height: 60px;
    margin-top: 10px;
}

.name{
    display: flex;
    justify-content: space-between;
    padding: 3px 15px;
}

.name span{
    font-size: 18px;
}

.name a{
    text-decoration: none;
    color: #E5091480;
    font-weight: 900;
}

.contact{
    display: flex;
    justify-content: space-between;
    padding: 7px 15px;
}




</style>


<body>
  
<header class="top">

<!-- Show user location and profile image -->
<div style="display: flex; justify-content:space-around; align-items: center; height: 10px;">
   <div class="logo"><h1>Afrobite Logo</h1></div>


    <!-- Search -->
<div class="search-bar">
    <input type="search" name="search" id="search" placeholder="Search for restaurants and more">
    <ul id="results"></ul>
    <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 512 512">
        <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
    </svg>
</div>

    <div class="hprofile"></div>
</div>

<div style="display: none;" class="profile-container" id="profile-container">
</div>

</header>  

</body>
