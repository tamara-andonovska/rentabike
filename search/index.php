<?php 
include '../view/header.php';
require('../model/database.php');
require('../model/product_db.php');
require('../model/category_db.php');
?>

<html>
<div id="main">
	<body>
	<button style=" background-color: #2f5f30; color: white; padding: 14px 20px; margin: 8px 0; border-radius: 4px; border: none; cursor: pointer; text-align: center;"><a style="color:white; text-decoration: none;" href="search_by_model.php">Search by model</a></button>
	<button style=" background-color: #2f5f30; color: white; padding: 14px 20px; margin: 8px 0; border-radius: 4px; border: none; cursor: pointer; text-align: center;"><a style="color:white; text-decoration: none;" href="search_by_date.php">Search by date</a></button>
	</body>
</div>
</html>
<?php include '../view/footer.php'; ?>