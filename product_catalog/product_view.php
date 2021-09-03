<?php include '../view/header.php'; ?>
<div id="main">
    <div id="sidebar">
        <h1>Categories</h1>
        <ul class="nav">
        <?php foreach($categories as $category) : ?>
            <li>
                <a href="?category_id=<?php echo $category['ID']; ?>">
                    <?php echo $category['name']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div id="content">
        <h1><?php echo $model; ?></h1>
        <div style="background-color: white; border: 15px solid darkgrey; padding: 30px; margin: 20px">
			<div>
				<p>
					<div>
						<img src="<?php echo $image_filename; ?>"
							alt="<?php echo $image_alt; ?>" />
					</div>
				</p>
			
			</div>
			<div>
					<p>Barcode:
						<?php echo $barcode; ?>
					</p>
					<p>Price/hr: 
						<?php echo $price; ?>den.
					</p>
			</div>
		</div>
    </div>
</div>
<?php include '../view/footer.php'; ?>