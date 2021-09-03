<?php 
include '../view/header.php';
require('../model/database.php');
require('../model/product_db.php');
require('../model/category_db.php');
?>

<html>
<div id="main">
	<body>
	<h2>Search available bikes</h2>
		<form method="POST">
			<div class="center">
			<input style="width: 80%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid rgb(133, 129, 129); border-radius: 4px; background-color: rgb(199, 225, 243); box-sizing: border-box"  type="text" name = "model" placeholder="Model">
			</div></br>
			<input style="width: 80%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid rgb(133, 129, 129); border-radius: 4px; background-color: rgb(199, 225, 243); box-sizing: border-box"  
			type="datetime-local" name = "dateFrom">
			<input style="width: 80%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid rgb(133, 129, 129); border-radius: 4px; background-color: rgb(199, 225, 243); box-sizing: border-box"  
            type="datetime-local" name = "dateTo">
			<input style=" background-color: #2f5f30; color: white; padding: 14px 20px; margin: 8px 0; border-radius: 4px; border: none; cursor: pointer; text-align: center;"
    		type="submit" name="find" value="Search">
			<button style=" background-color: #2f5f30; color: white; padding: 14px 20px; margin: 8px 0; border-radius: 4px; border: none; cursor: pointer; text-align: center;"><a style="color:white; text-decoration: none;"  href="search_by_model.php">Search by model</a></button>
		</form>
	</body>
</html>

<?php
	$model="";
	$barcode="";
	$price="";

	$date_from = "";
	$date_to = "";
	$total_price = "";

	if(isset($_POST['find'])){
		$date_from = $_POST['dateFrom'];
		$date_to = $_POST['dateTo'];
		$model = $_POST['model'];
		
		if ($date_from > $date_to){
			echo "<h1 class='top'>Error</h1><p>End date cannot be before start date.</p>";
			
		}
		
		$start_date = strtotime($date_from);
		$end_date = strtotime($date_to);
		$current_date = date('Y-m-d H:i:s');
		$current_date = strtotime($current_date);
		
		if ($start_date < $current_date || $end_date < $current_date){
			echo "<h1 class='top'>Error</h1><p>Date is in the past or date is not specified.</p>";
		}
		
		else {
		
			$query1 = "SELECT * FROM bike WHERE model LIKE '%$model%' AND barcode NOT IN (
					   SELECT b.barcode
				       FROM rent as r
				       JOIN bike as b ON r.barcode=b.barcode 
				       WHERE EXISTS(
						   SELECT * FROM rent
						   WHERE DATE('$date_to') BETWEEN DATE(r.dateFrom) AND DATE(r.dateTo)
						   OR DATE('$date_from') BETWEEN DATE(r.dateFrom) AND DATE(r.dateTo)
					   ))";

			$res1 = $db->query($query1);
			$res1 = $res1->fetchAll();
			
			if ($res1){
				echo '<table style="background-color: white" id="content"><tr><td>Picture</td><td>Model</td><td>Price/hr</td><td>Total price for renting for the chosen period: </td>';
				echo '<td>Date From:</td><td>Date to:</td>';
				echo '<td></td></tr>';
				foreach($res1 as $row){
					
					echo '<tr>';
					$barcode = $row['barcode'];
					$model = $row['model'];
					$price = $row['price'];
					$total_price = total_price($date_from, $date_to, $barcode);
		
					$image_filename= '../images/' . $barcode . '.png';
					$image_alt = 'Image: ' . $barcode . '.png';
				
				
					echo '<td><img src="'. $image_filename . '"
						alt="'. $image_alt . '" /></td>';
		
					echo '<td>' . $model . '</td><td>' . $price . '</td>';
					echo '<td>' . $total_price . '</td>';
					echo '<td>' . $date_from . '</td>';
					echo '<td>' . $date_to . '</td>';
					echo '<td><form method="post" action="">
							<input type="submit" name="submitted" value="rent">
							</form></td></tr>';
							
					if(isset($_POST['submitted'])) {
						rent_bike($date_from, $date_to, $barcode);
					}
				}
				echo '</table></br>';
			}
			else{
				echo '<p>0 results.</p>';
			}
		}
	}
	include '../view/footer.php'; 
?>
</div>