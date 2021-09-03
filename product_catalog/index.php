<?php
require('../model/database.php');
require('../model/product_db.php');
require('../model/category_db.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list_products';
}

if ($action == 'list_products') {
    $category_id = $_GET['category_id'];
    if (empty($category_id)) {
        $category_id = 1;
    }

    $categories = get_categories();
    $category_name = get_category_name($category_id);
    $bikes = get_bikes_by_category($category_id);

    include('product_list.php');

} else if ($action == 'view_product') {
    $categories = get_categories();

    $bike_id = $_GET['product_id'];
    $bike = get_bike($bike_id);

    $barcode = $bike['barcode'];
    $model = $bike['model'];
    $price = $bike['price'];
  
    $image_filename = '../images/' . $barcode . '.png';
    $image_alt = 'Image: ' . $barcode . '.png';

    include('product_view.php');
}

?>