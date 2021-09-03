<?php include '../view/header.php'; ?>
<div id="main">
    <h1>Rent</h1>
    <form action="index.php" method="post" id="add_product_form"> 
   <input type="hidden" name="action" value="rent" />
  
		<label>Bike:</label>
		<select style="width: 80%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid rgb(133, 129, 129); border-radius: 4px; background-color: rgb(199, 225, 243); box-sizing: border-box"  
        name="bike_id">
        <?php foreach ( $bikes as $bike ) : ?>
            <option value="<?php echo $bike['ID']; ?>">
                <?php echo $bike['model'] . " --- " . get_category_name($bike['categoryID']); ?>
            </option>
        <?php endforeach; ?>
        </select>
        <br />
		
		<label>Date From: </label>
		<input style="width: 80%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid rgb(133, 129, 129); border-radius: 4px; background-color: rgb(199, 225, 243); box-sizing: border-box"  
        type="datetime-local" name="date_from"></br>
		
		<label>Date To: </label>
		<input style="width: 80%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid rgb(133, 129, 129); border-radius: 4px; background-color: rgb(199, 225, 243); box-sizing: border-box"  
        type="datetime-local" name="date_to"></br>

        <label>&nbsp;</label>
        <input style=" width: 10%; background-color: #2f5f30; color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer;"
         type="submit" value="Rent" />
        <br />  <br />
		
        
    </form>
    <p><a style="color: #104411" href="../product_catalog/">View Bike List</a></p>
</div>
<?php include '../view/footer.php'; ?>