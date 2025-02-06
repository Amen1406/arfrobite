<style>
*{
    color: #fff;
    list-style: none;
    text-decoration: none;
}    

ul {
    margin: 0;
    padding: 0;
}

.sidebar-container{
    width: 98%;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.sidebar-list{
    height: 50%;
}

.sidebar-list a li{
    height: 30px;
    border-radius: 10px;
    padding: 12px 8px;
    font-size: 20px;
    display: flex;
    align-items: center;
    margin: 0 10px;
    cursor: pointer;
}

.sidebar-list a li svg{
    margin-right: 15px;
}

.sidebar-list a li:hover{
    background: #999;
}

.bottom a, .bottom hr{
    position: relative;
    top: 40%;
}
</style>



<div class="sidebar-container">
    <ul class="sidebar-list">
        <a><li onclick="window.location.href='homepage.php'"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="22" viewBox="0 0 576 512"><path fill="#FFFFFF80" d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>Home</li></a>
        <a><li onclick="window.location.href='cart-items.php'"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="22" viewBox="0 0 576 512"><path fill="#FFFFFF80" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>Cart</li></a>
        <a><li onclick="window.location.href='favorite.php'"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><path fill="#FFFFFF80" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>Favorite</li></a>
        <a><li onclick="window.location.href='payment-process.php'"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="16" viewBox="0 0 384 512"><path fill="#FFFFFF80" d="M192 0c-41.8 0-77.4 26.7-90.5 64H64C28.7 64 0 92.7 0 128V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H282.5C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM112 192H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>Payment history</li></a>
        <a><li onclick="window.location.href='orders.php'"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="24" viewBox="0 0 640 512"><path fill="#FFFFFF80" d="M48 0C21.5 0 0 21.5 0 48V368c0 26.5 21.5 48 48 48H64c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H48zM416 160h50.7L544 237.3V256H416V160zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>Orders</li></a>
    </ul>


    <ul  class="sidebar-list bottom">
    <a><li onclick="loadContent('tab.html')"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><path fill="#FFFFFF80" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM169.8 165.3c7.9-22.3 29.1-37.3 52.8-37.3h58.3c34.9 0 63.1 28.3 63.1 63.1c0 22.6-12.1 43.5-31.7 54.8L280 264.4c-.2 13-10.9 23.6-24 23.6c-13.3 0-24-10.7-24-24V250.5c0-8.6 4.6-16.5 12.1-20.8l44.3-25.4c4.7-2.7 7.6-7.7 7.6-13.1c0-8.4-6.8-15.1-15.1-15.1H222.6c-3.4 0-6.4 2.1-7.5 5.3l-.4 1.2c-4.4 12.5-18.2 19-30.6 14.6s-19-18.2-14.6-30.6l.4-1.2zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>Help</li></a><hr>   
    <a id="logout"><li><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><path fill="#FFFFFF80" d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg>Logout</li></a>
    </ul>
</div>


<script>
    function loadContent(url) {
        fetch (url)
        .then(response => response.text())
        .then(content => {
            document.getElementById("homebody").innerHTML = content;
            document.getElementById("body").innerHTML = content;
        })
        .catch(error => console.error('Error loading content: ', error));
    }

    $("#logout").click(function(){
        $.ajax({
                url: '../arfrobite_includes/SqlDataCrud.php',
                type: 'post',
                data: { 'action': 'callRequest', callRequest: 'logout' },
                success: function (data) {
                    let res = JSON.parse(data);
                    
                    if(res == "Logout successful") {
                        window.location.href = "../signup_signin/signin.php";
                    }

                }
            })
    })
</script>