<?php 
require('../model/database.php');
require('../model/product_db.php');
require('../model/category_db.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'rent';
}

if ($action == 'rent'){
	$bikes = get_bikes();
	
    $bike_id = $_POST['bike_id'];
	$date_from = $_POST['date_from'];
    $date_to = $_POST['date_to'];
	
	$bike = get_bike($bike_id);
	$barcode = $bike['barcode'];
	$category_id = $bike['categoryID'];

    if (empty($bike_id) || empty($date_from) || empty($date_to)) {
        $error = "Invalid data. Check all fields and try again.";
        //include('../errors/error.php');
    } else {
        rent_bike($date_from, $date_to, $barcode);
	}

    include('rent.php');
	
} 
/*
if ($action == 'list_bikes'){
	$category_id = $_GET['category_id'];
    if (!isset($category_id)) {
        $category_id = 1;
	}
	
	$categories = get_categories();
	$category_name = get_category_name($category_id);
    $bikes = get_bikes_by_category($category_id);
	
	include('../product_catalog/product_list.php');

}else if ($action == 'view_product') {
    $categories = get_categories();

    $bike_id = $_GET['product_id'];
    $bike = get_bike($bike_id);

    $barcode = $bike['barcode'];
    $model = $bike['model'];
    $price = $bike['price'];
  
    $image_filename = '../images/' . $barcode . '.png';
    $image_alt = 'Image: ' . $barcode . '.png';

 	include('../product_catalog/product_view.php');
}
*/
?>
