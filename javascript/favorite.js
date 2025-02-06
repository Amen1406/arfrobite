const tabs = document.querySelectorAll('.header-buttons button');
const dishesOptions = document.querySelector('.dishes-options');
const restaurantOptions = document.querySelector('.restaurant-options');

tabs.forEach(tab => {
    tab.addEventListener('click', function () {
        
    tabs.forEach(t => {
        t.classList.remove('active-tab');
    });

    this.classList.add('active-tab');

    if (this.id === 'food-items') {
        dishesOptions.style.display = 'block';
        restaurantOptions.style.display = 'none';
    } else if (this.id === 'restaurants') {
        dishesOptions.style.display = 'none';
        restaurantOptions.style.display = 'block';
    }
    });
});

