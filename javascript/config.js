
/**
 * Helper method to get the cookie value for the given key.
 *
 * @param cname
 */
function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1);
    if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
  }
  return "";
}


let user_id = getCookie('uid');
let res_id = getCookie('rid');
let riders_id = getCookie('rider_id');




function getParameterByName(name, url = window.location.href) {
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
}




async function getUserProfile(user_id) {


  const UserProfileRequest = new FormData();
  UserProfileRequest.append('action', 'profileRequest',);
  UserProfileRequest.append('profileRequest', 'userprofile');
  UserProfileRequest.append('user_id', user_id,);


  const LoadUserProfiles = await fetch('http://localhost/arfrobite/includes/SqlDataCrud.php', {
    method: 'POST',
    body: UserProfileRequest
  });

  const UserProfile = await LoadUserProfiles.json();

  if (UserProfile === 'empty') {
    console.log('...................................');
  } else {

    var img = $('<img>')
    img.attr("src", UserProfile[0].profile_picture);
    img.attr("id", "profile-pic")

    var clonedImg = img.clone()

    $('.hprofile').html(img);
    $('.mobile-hprofile').html(clonedImg);




    if (window.innerWidth > 768) {

      document.getElementById('profile-pic').addEventListener('click', function () {
        var profileContainer = document.getElementById('profile-container');
        if (profileContainer.style.display === 'block') {
          profileContainer.style.display = 'none';
        } else {
          profileContainer.style.display = 'block';
        }
      });

      document.addEventListener('click', function (event) {
        var profileContainer = document.getElementById('profile-container');
        var profileImage = document.getElementById('profile-pic');

        if (event.target !== profileImage && event.target !== profileContainer) {
          profileContainer.style.display = 'none';
        }
      });

    }
    else {
      $(".mobile-hprofile").click(function () {
        window.location.href = "account-profile.php";
      });

    }


    let outputpro = '';

    let user_id = UserProfile[0].user_id;
    let fname = UserProfile[0].first_name;
    let lname = UserProfile[0].last_name;
    let profile_pic = UserProfile[0].profile_picture;
    let phone_number = UserProfile[0].phone_number;
    let email = UserProfile[0].email;

    if (typeof user_id != 'undefined') {
      outputpro += '<header><h1><center><img class="profile" src="' + profile_pic + '" alt="profile pic"></center></h1></header>'
      outputpro += '<div class="account-info"><div class="name"><span>' + fname + ' ' + lname + '</span><a href="edit-profile.php">EDIT</a></div>'
      outputpro += '<div class="contact"><span>' + phone_number + '</span><span>' + email + '</span></div></div>'
    }

    $('.profile-container').html(outputpro);

    let name = fname + ' ' + lname;
    return name;

  }


}






async function getUseraddress(user_id) {
  const UserAddressRequest = new FormData();
  UserAddressRequest.append("action", "profileRequest");
  UserAddressRequest.append("profileRequest", "useraddress");
  UserAddressRequest.append("user_id", user_id);

  const LoadUserAddress = await fetch("http://localhost/arfrobite/includes/SqlDataCrud.php", {
    method: "POST",
    body: UserAddressRequest,
  });

  const UserAddress = await LoadUserAddress.json();

  if (UserAddress === "empty") {
    console.log("...................................");
  } else {
    $(".location-index").html(
      UserAddress[0].city + ", " + UserAddress[0].town + " - " + UserAddress[0].street
    );
  }
}






//Checking to see if the browser supports geolocation
function getUserLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.watchPosition(showUserPosition, showError);
  } else {
    alert("Geolocation is not supported by this browser");
  }
}


//Extract the latitude and longitude coordinates from the position of the user
function showUserPosition(position) {
  const latitude = position.coords.latitude;
  const longitude = position.coords.longitude;
  
  var formData = new FormData();
  formData.append('action', 'callRequest');
  formData.append('callRequest', 'coordinates');
  formData.append('user_id', user_id);
  formData.append('latitude', latitude);
  formData.append('longitude', longitude);

  $.ajax({
    url: 'http://localhost/arfrobite/includes/SqlDataCrud.php',
    type: 'post',
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      let res = JSON.parse(data);

    }
  })
}


function getResLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.watchPosition(showResPosition, showError);
  } else {
    alert("Geolocation is not supported by this browser");
  }
}


//Extract the latitude and longitude coordinates from the position of the restaurant
function showResPosition(position) {
  const latitude = position.coords.latitude;
  const longitude = position.coords.longitude;
  
  var formData = new FormData();
  formData.append('action', 'callRequest');
  formData.append('callRequest', 'res_coordinates');
  formData.append('restaurant_id', res_id);
  formData.append('latitude', latitude);
  formData.append('longitude', longitude);

  $.ajax({
    url: 'http://localhost/arfrobite/includes/SqlDataCrud.php',
    type: 'post',
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      let res = JSON.parse(data);

    }
  })
}



function getRiderLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.watchPosition(showRiderPosition, showError);
  } else {
    alert("Geolocation is not supported by this browser");
  }
}

//Extract the latitude and longitude coordinates from the position of the rider
function showRiderPosition(position) {
  const latitude = position.coords.latitude;
  const longitude = position.coords.longitude;
  
  var formData = new FormData();
  formData.append('action', 'callRequest');
  formData.append('callRequest', 'rider_coordinates');
  formData.append('rider_id', riders_id);
  formData.append('latitude', latitude);
  formData.append('longitude', longitude);

  $.ajax({
    url: 'http://localhost/arfrobite/includes/SqlDataCrud.php',
    type: 'post',
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      let res = JSON.parse(data);

    }
  })
}



//Error Handling
function showError(error) {
  switch (error.code) {
    case error.PERMISSION_DENIED:
      console.log("User denied the request for geolocation");
      break;

    case error.POSITION_UNAVAILABLE:
      console.log("Location information is unavailable.");
      break;

    case error.TIMEOUT:
      console.log("The request to get user location timed out.");
      break;

    case error.UNKNOWN_ERROR:
      console.log("An unknown error occurred.");
      break;
  }
}


//DISPLAY RESULTS ON THE MAP
// function showPosition(position) {
//     var latlon = position.coords.latitude + "," + position.coords.longitude;

//     var img_url = "http://maps.googleapis.com/maps/api/staticmap?center="+latlon+"&zoom=14&size=400x300&sensor=false";

//     document.getElementById("mapholder").innerHTML = "<img src='"+img_url+"'>";
// }














/////////////////////////////////////// Checking notifications //////////////////////////////////////


if (user_id !== '') {
//setInterval(checkUserNotifications, 10000);
} else if (riders_id !== '') {
  setInterval(checkRidersNotifications, 10000);
} else if (res_id !== '') {
  setInterval(checkResNotifications, 10000);
}




//////////// Checking notification for restaurant dashboard////////////////

function checkResNotifications() {


  const formData = new FormData();
  formData.append('action', 'notifyRequest',);
  formData.append('notifyRequest', 'check_res_notification',);
  formData.append('restaurant_id', res_id,);


  $.ajax({
    url: 'http://localhost/arfrobite/includes/SqlDataCrud.php',
    type: 'post',
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      let res = JSON.parse(data);


      if (res.length > 0 && res[0].status == 0) {
        let notification_id = res[0].notifications_id;

        showResNotification("Notification: " + res[0].message);
        changeResNotificationStatus(notification_id);
      }
  
    }

  })


}

// Function to display a pop-up notification
function showResNotification(message) {
  var notificationPopup = document.getElementById("notificationPopup");
  notificationPopup.innerHTML = message;

  notificationPopup.style.display = "block";

  setTimeout(function () {
      notificationPopup.style.display = "none";
  }, 5000);
}





function changeResNotificationStatus(notification_id) {
  $.ajax({
    url: 'http://localhost/arfrobite/includes/SqlDataCrud.php',
    type: 'post',
    data: {
      'action': 'notifyRequest',
      notifyRequest: 'change_res_status',
      'notification_id': notification_id,
    },
    success: function(data) {
      let res = JSON.parse(data);
    }
  })
}






////////////Checking notification for rider dashboard////////////////

function checkRidersNotifications() {


  const formData = new FormData();
  formData.append('action', 'notifyRequest',);
  formData.append('notifyRequest', 'check_rider_notification',);


  $.ajax({
    url: 'http://localhost/arfrobite/includes/SqlDataCrud.php',
    type: 'post',
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      let res = JSON.parse(data);

      if (res.length > 0 && res[0].status == 2) {
        let notification_id = res[0].notifications_id;

        showRidersNotification("Notification: " + res[0].message);
        changeRidersNotificationStatus(notification_id);
      }
  
    }

  })


}

// Function to display a pop-up notification
function showRidersNotification(message) {
  var rider_notificationPopup = document.getElementById("rider_notificationPopup");
  rider_notificationPopup.innerHTML = message;

  rider_notificationPopup.style.display = "block";

  setTimeout(function () {
      rider_notificationPopup.style.display = "none";
  }, 5000);
}





function changeRidersNotificationStatus(notification_id) {
  $.ajax({
    url: 'http://localhost/arfrobite/includes/SqlDataCrud.php',
    type: 'post',
    data: {
      'action': 'notifyRequest',
      notifyRequest: 'change_rider_status',
      'notification_id': notification_id,
    },
    success: function(data) {
      let res = JSON.parse(data);
    }
  })
}












//////////////////Checking notifications for User or customers/////////////////////////

function checkUserNotifications() {


  const formData = new FormData();
  formData.append('action', 'notifyRequest',);
  formData.append('notifyRequest', 'check_user_notification',);
  formData.append('user_id', user_id,);


  $.ajax({
    url: 'http://localhost/arfrobite/includes/SqlDataCrud.php',
    type: 'post',
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      let res = JSON.parse(data);


      if (res.length > 0 && res[0].status == 0) {
        let notification_id = res[0].notifications_id;

        showUserNotification("Notification: " + res[0].message);
        changeUserNotificationStatus(notification_id);
      }
  
    }

  })


}

// Function to display a pop-up notification
function showUserNotification(message) {
  var notificationPopup = document.getElementById("user_notificationPopup");
  notificationPopup.innerHTML = message;

  notificationPopup.style.display = "block";

  setTimeout(function () {
      notificationPopup.style.display = "none";
  }, 5000);
}





function changeUserNotificationStatus(notification_id) {
  $.ajax({
    url: 'http://localhost/arfrobite/includes/SqlDataCrud.php',
    type: 'post',
    data: {
      'action': 'notifyRequest',
      notifyRequest: 'change_user_status',
      'notification_id': notification_id,
    },
    success: function(data) {
      let res = JSON.parse(data);
    }
  })
}










// Function to get only the date from a timestamp in 'YYYY-MM-DD HH:mm:ss' format
function getDateFromTimestamp(timestamp) {
  const dateObject = new Date(timestamp);
  const year = dateObject.getFullYear();
  const month = ('0' + (dateObject.getMonth() + 1)).slice(-2);
  const day = ('0' + dateObject.getDate()).slice(-2);

  return `${year}-${month}-${day}`;
}

// Function to get only the time from a timestamp in 'YYYY-MM-DD HH:mm:ss' format
function getTimeFromTimestamp(timestamp) {
  const dateObject = new Date(timestamp);
  const hours = ('0' + dateObject.getHours()).slice(-2);
  const minutes = ('0' + dateObject.getMinutes()).slice(-2);
  const seconds = ('0' + dateObject.getSeconds()).slice(-2);

  return `${hours}:${minutes}:${seconds}`;
}

// const dateOnly = getDateFromTimestamp(timestampFromDatabase);
// const timeOnly = getTimeFromTimestamp(timestampFromDatabase);

