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
			<input style="width: 80%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid rgb(133, 129, 129); border-radius: 4px; background-color: rgb(199, 225, 243); box-sizing: border-box"  
			 type="text" name = "model">
			<input style=" background-color: #2f5f30; color: white; padding: 14px 20px; margin: 8px 0; border-radius: 4px; border: none; cursor: pointer; text-align: center;"
    		type="submit" name="find" value="Search">
			<button style=" background-color: #2f5f30; color: white; padding: 14px 20px; margin: 8px 0; border-radius: 4px; border: none; cursor: pointer; text-align: center;"><a style="color:white; text-decoration: none;" href="search_by_date.php">Search by date</a></button>
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
		$model = $_POST['model'];
		$query = "SELECT * FROM bike WHERE model LIKE '%$model%'";
		$res = $db->query($query);
		$res = $res->fetchAll();
	
	

	if ($res){
		echo "<div style='background-color: white; padding: 30px'>";
		foreach($res as $row){
			$bike_id = $row['ID'];
			$category_id = $row['categoryID'];
			$barcode = $row['barcode'];
			$model = $row['model'];
			$price = $row['price'];
			
			$image_filename = '../images/' . $barcode . '.png';
			$image_alt = 'Image: ' . $barcode . '.png';
			
			echo '<p><img src="'. $image_filename . '"
                    alt="'. $image_alt . '" /></p>';
			
			echo '<h2>' . $model . '</h2><p>Price: ' . $price . '</p>';
			echo '<button><a href="../rent">Rent</a></button>';
		}
		echo "</div>";
	}
	else{
		echo '<p>0 results.</p>';
		
	}
	}
	include '../view/footer.php'; 
?>
</div>