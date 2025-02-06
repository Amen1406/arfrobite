<!DOCTYPE html>
<html lang="en">
<head>
	<title>Arfrobite - Orders</title>
    <?php include "../../arfrobite_includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../arfrobite_css/orders.css">
</head>
<body>

   <div class="navbar">
      <?php include "panels/navbar.php"; ?>
    </div>

    <div class="sidebar">
      <?php include "panels/sidepanel.php"; ?>
    </div>


	
<div id="homebody" class="container">
    <header class="top-container">
      <?php include "panels/header.php"; ?>
    </header>

    <header class="top-container">
      <?php include "panels/header.php"; ?>
    </header>

    <div class="tabs">
        <li class="active">All Orders</li>
        <li>Pending</li>
        <li>Completed</li>
    </div>

	<div class="date-filter">
	<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#fff" d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192H400V448c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192z"/></svg>
	30th December, 2023
	</div>
	
	<div class="table">
		<div class="table-header">
			<div class="header__item"><a id="id" class="filter__link" href="#"></a></div>
			<div class="header__item"><a id="id" class="filter__link" href="#">Id</a></div>
			<div class="header__item"><a id="name" class="filter__link filter__link--number" href="#">Name</a></div>
			<div class="header__item"><a id="price" class="filter__link filter__link--number" href="#">Phone</a></div>
			<div class="header__item"><a id="quantity" class="filter__link filter__link--number" href="#">Address</a></div>
			<div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Amount</a></div>
			<div class="header__item"><a id="date" class="filter__link filter__link--number" href="#">Date</a></div>
			<div class="header__item"><a id="status" class="filter__link filter__link--number" href="#">Status</a></div>
		</div>

		<div class="table-content"></div>

	</div>


	<div class="showing">
		<p>Showing 1 to 10 of 1000</p>
	</div>

	<div class="next-btns">
		<button><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#fff" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg> Previous</button>
		<button>1</button>
		<button>2</button>
		<button>....</button>
		<button>100</button>
		<button>Next <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#fff" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg></button>
	</div>

	<div id="notificationPopup"></div>

</div>
</body>
<script src="../../arfrobite_javascript/orders.js"></script>
</html>