getUseraddress(user_id);
getRestaurants();
getDishes();
checkAddress(user_id);



async function getRestaurants() {
  const RestaurantRequest = new FormData();
  RestaurantRequest.append("action", "homeRequest");
  RestaurantRequest.append("homeRequest", "restaurants");

  const LoadRestaurants = await fetch("../includes/SqlDataCrud.php", {
    method: "POST",
    body: RestaurantRequest,
  });

  const Restaurants = await LoadRestaurants.json();

  if (Restaurants === "empty") {
    console.log("...................................");
  } else {
    let outputres = "";

    for (const restaurant of Restaurants) {
      let res_id = restaurant.restaurant_id;
      let res_name = restaurant.restaurant_name;
      let res_pic = restaurant.restaurant_picture;
      let res_type = restaurant.restaurant_type;
      let work_hours = restaurant.working_hours;
      let rating = restaurant.ratings;

      if (typeof res_id != "undefined") {
        outputres += '<section class="restaurant-options-box" data-restaurant_id=' + res_id + ">";
        outputres += "<div>";
        outputres += '<div class="restaurant-ratings">';
        outputres += '<span class="rating">' + rating + '<svg xmlns="http://www.w3.org/2000/svg" height="16" width="18.5" viewBox="0 0 576 512"><path fill="#ffc800" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg></span>';
        outputres += '<svg class="like" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path fill="#ffffff" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>';
        outputres += "</div>";
        outputres += '<img src="' + res_pic + '">';
        outputres += "</div>";
        outputres += '<div style="padding: 0 15px; display: flex; flex-direction: column;">';
        outputres += '<span class="restaurant-name">' + res_name + "</span>";
        outputres += '<span class="working-hours"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path fill="#FCA892" d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>' + work_hours + "</span>";
        outputres += '<div class="restaurant-category"><span>' + res_type + "</span></div>";
        outputres += "</div>";
        outputres += "</section>";
      }
    }

    $(".restaurant-options").html(outputres);

    $(".restaurant-options-box").click(function () {
      var restaurant_id = $(this).data("restaurant_id");
      window.location.href = "restaurant-details.php?restaurant_id=" + restaurant_id;
    });
  }
}


async function getDishes() {
  const DishRequest = new FormData();
  DishRequest.append("action", "homeRequest");
  DishRequest.append("homeRequest", "dishes");

  const LoadDishes = await fetch("../includes/SqlDataCrud.php", {
    method: "POST",
    body: DishRequest,
  });

  const Dishes = await LoadDishes.json();

  if (Dishes === "empty") {
    console.log("...................................");
  } else {
    let outputdish = "";

    for (const dish of Dishes) {
      let dish_id = dish.dish_id;
      let dish_name = dish.dish_name;
      let dish_pic = dish.dish_pic;
      let dish_price = dish.dish_price;
      let description = dish.description;

      if (typeof dish_id != "undefined") {
        // outputdish += '<section class="dishes-options-box" data-dish_id=' + dish_id + ">";
        // outputdish += '<div class="dishes-options-up">';
        // outputdish += '<svg class="love" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path fill="#ffffff" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>';
        // outputdish += "</div>";
        // outputdish += '<div class="dish-img"><img src='+ dish_pic +' alt=""></div>';
        // outputdish += '<div class="dish-details">';
        // outputdish += '<span class="dish-name">' + dish_name + "</span>";
        // outputdish +=  '<span class="dish-items">'+ description +'</span>'
        // outputdish += '<span class="dish-amount">₵' + dish_price + "</span>";
        // outputdish += "</div>";
        // outputdish += "</section>";

       outputdish += '<div class="dishes-options-box" data-dish_id=' + dish_id + '>'
       outputdish += '<div>';
       outputdish += '<svg class="love" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path fill="#ffffff" d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>';
       outputdish += "</div>";
       outputdish += '<img class="dishes-options-image" src="'+ dish_pic +'" alt="Dish Image">'
       outputdish += '<div class="dishes-options-details">'
       outputdish += '<div class="dishes-options-title">'+ dish_name +'</div>'
       //outputdish += '<div class="dishes-options-description">'+ description +'</div>'
       outputdish += '<div class="dishes-options-price">₵'+ dish_price +'</div>'
       outputdish += '</div>'
       outputdish += '</div>'
      }
    }
    $(".dishes-options").html(outputdish);
  }
}



async function checkAddress(user_id) {
  const AddressRequest = new FormData();
  AddressRequest.append("action", "homeRequest");
  AddressRequest.append("homeRequest", "checkaddress");
  AddressRequest.append("user_id", user_id);

  const LoadAddress = await fetch("../includes/SqlDataCrud.php", {
    method: "POST",
    body: AddressRequest,
  });

  const Address = await LoadAddress.json();

  if (Address == "User has no address") {
    document.getElementById("addressbody").style.display = "block";
    document.getElementById("homebody").style.display = "none";

    if (window.innerWidth > 768){
      document.querySelector(".navbar").style.display = "none";
    document.querySelector(".sidebar").style.display = "none";
    document.querySelector(".right-sidebar").style.display = "none";
    }



  } else if (Address == "User has address") {
    document.getElementById("addressbody").style.display = "none";
    document.getElementById("homebody").style.display = "block";

    if (window.innerWidth > 768){
      document.querySelector(".navbar").style.display = "block";
    document.querySelector(".sidebar").style.display = "block";
    document.querySelector(".right-sidebar").style.display = "block";
   }

    

  }
}

async function getUseraddress(user_id) {
  const UserAddressRequest = new FormData();
  UserAddressRequest.append("action", "profileRequest");
  UserAddressRequest.append("profileRequest", "useraddress");
  UserAddressRequest.append("user_id", user_id);

  const LoadUserAddress = await fetch("../includes/SqlDataCrud.php", {
    method: "POST",
    body: UserAddressRequest,
  });

  const UserAddress = await LoadUserAddress.json();

  if (UserAddress === "empty") {
    console.log("...................................");
  } else {
    $(".location-index").html(
      UserAddress[0].city +
      ", " +
      UserAddress[0].town +
      " - " +
      UserAddress[0].street
    );
  }
}

$(".location").click(function () {
  window.location.href = "address-screen.php";
});








const carouselWrapper = document.getElementById("carousel-wrapper");

const interval = 9000;

startCarousel();

function startCarousel() {
  setInterval(() => {
    const firstItem = carouselWrapper.firstElementChild;
    carouselWrapper.style.transition = "transform 0.5s ease-in-out";
    carouselWrapper.style.transform = "translateX(-100%)";
    setTimeout(() => {
      carouselWrapper.appendChild(firstItem);
      carouselWrapper.style.transition = "none";
      carouselWrapper.style.transform = "translateX(0)";
    }, 500);
  }, interval);
}


const tabs = document.querySelectorAll('.tabs .tab');
const restaurantOptions = document.querySelector('.restaurant-options');
const dishesOptions = document.querySelector('.dishes-options');
const restaurantHeader = document.querySelector(".resh");
const dishHeader = document.querySelector(".dishh");

tabs.forEach(tab => {
  tab.addEventListener('click', function () {
    tabs.forEach(t => {
      t.classList.remove('active-tab');
    });

    this.classList.add('active-tab');

    if (this.classList.contains('all-tab')) {
      restaurantOptions.style.display = 'block';
      dishesOptions.style.display = 'block';
      restaurantHeader.style.display = 'block';
      dishHeader.style.display = 'block';
    } else if (this.classList.contains('restaurants-tab')) {
      restaurantOptions.style.display = 'block';
      restaurantHeader.style.display = 'block';
      dishesOptions.style.display = 'none';
      dishHeader.style.display = 'none';
    } else if (this.classList.contains('dishes-tab')) {
      restaurantOptions.style.display = 'none';
      restaurantHeader.style.display = 'none';
      dishesOptions.style.display = 'block';
      dishHeader.style.display = 'block';
    }
  });
});