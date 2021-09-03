<?php
function get_bikes() {
    global $db;
    $query = 'SELECT * FROM bike
              ORDER BY id';
    $bikes = $db->query($query);
    return $bikes;
}

function get_bikes_by_category($category_id) {
    global $db;
    $query = "SELECT * FROM bike
              WHERE bike.categoryID = '$category_id'
              ORDER BY ID";
    $bikes = $db->query($query);
    return $bikes;
}

function get_bike($bike_id) {
    global $db;
    $query = "SELECT * FROM bike
              WHERE ID = '$bike_id'";
    $bike = $db->query($query);
    $bike = $bike->fetch();
    return $bike;
}

function rent_price($barcode){
	global $db;
	$query = "SELECT * FROM bike
              WHERE barcode = '$barcode'";
	$bike = $db->query($query);
    $bike = $bike->fetch();	
	$price = $bike['price'];
	
	return $price;
}

function rent_bike($date_from, $date_to, $barcode) {
    global $db;
	
	if (is_rented($date_from, $date_to, $barcode) == 1){
		$error = "Bike is rented.";
        include('../errors/error.php');
	}
	else{
		
	$price = rent_price($barcode);
	
	$start_date = strtotime($date_from);
	$end_date = strtotime($date_to);
	
		if ($start_date > $end_date){
			$error = "End date cannot be before start date.";
			include('../errors/error.php');
		}
		
		$start_date = strtotime($date_from);
		$end_date = strtotime($date_to);
		$current_date = date('Y-m-d H:i:s');
		$current_date = strtotime($current_date);
		
		if ($start_date < $current_date || $end_date < $current_date){
			$error = "Date is in the past.";
			include('../errors/error.php');
		}
		
		else {
			$hours = ($end_date - $start_date)/60/60;

			$daily_discount = 15;
			$weekly_discount = 20;
			$monthly_discount = 30;
			$yearly_discount = 50;
	
			if ($hours > 0 && $hours < 24){
				$discount_amount = 0;
			}
			else if ($hours >= 24 && $hours < 168){
				$discount_amount = round($price * ($daily_discount / 100.0),0);
			}
			else if ($hours >= 168 && $hours < 720){
				$discount_amount = round($price * ($weekly_discount / 100.0),0);
			}
			else if ($hours >= 720 && $hours < 8760){
				$discount_amount = round($price * ($monthly_discount / 100.0),0);
			}
			else if ($hours >= 8760){
				$discount_amount = round($price * ($yearly_discount / 100.0),0);
			}
			else {
				$error = "Invalid product data. Check all fields and try again.";
				include('../errors/error.php');
			}
			$total_price = $price - $discount_amount;

	
			$query = "INSERT INTO rent
					  (dateFrom, dateTo, barcode, totalPrice)
					  VALUES
					  ('$date_from', '$date_to', '$barcode', '$total_price')";
			$db->exec($query);
			include('../view/success.php');
		}
	}
}

function total_price($date_from, $date_to, $barcode){
	global $db;
	
	$price = rent_price($barcode);
	
	$start_date = strtotime($date_from);
	$end_date = strtotime($date_to);
 
    $hours = ($end_date - $start_date)/60/60;

	$daily_discount = 15;
	$weekly_discount = 20;
	$monthly_discount = 30;
	$yearly_discount = 50;
	
	if ($hours > 0 && $hours < 24){
		$discount_amount = 0;
	}
	if ($hours >= 24 && $hours < 168){
		$discount_amount = round($price * ($daily_discount / 100.0),0);
	}
	if ($hours >= 168 && $hours < 720){
		$discount_amount = round($price * ($weekly_discount / 100.0),0);
	}
	if ($hours >= 720 && $hours < 8760){
		$discount_amount = round($price * ($monthly_discount / 100.0),0);
	}
	if ($hours >= 8760){
		$discount_amount = round($price * ($yearly_discount / 100.0),0);
	}
	$total_price = $price - $discount_amount;
	return $total_price;
}

function is_rented($date_from, $date_to, $barcode){
	global $db;
	$query = "SELECT b.*, r.*
			  FROM rent as r
			  JOIN bike as b ON r.barcode=b.barcode 
			  WHERE EXISTS(
				SELECT * FROM rent
				WHERE 
				(DATE('$date_to') BETWEEN DATE(r.dateFrom) AND DATE(r.dateTo)
				OR DATE('$date_from') BETWEEN DATE(r.dateFrom) AND DATE(r.dateTo))
			  )";
	$row = $db->query($query);
	$row = $row->fetch();
	if ($row != 0){ //ako vrati barem eden red, odnosno razlicno od 0, znaci ima zapis za toj period i tocakot e zafaten
		return 1; //1 za zafaten
	}
	else return 0; //0 za sloboden
}

?>