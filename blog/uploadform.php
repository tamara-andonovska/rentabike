<?php include '../view/header.php'; ?>
<html>

    <head>
        <title>Rent a Bike</title>
		<style>
			table {
				border-collapse: collapse;
				width: 100%;
			}

			td,th {
				padding: .2em .5em .2em .5em;
				vertical-align: top;
				border: 1px solid white;
			}
		</style>
    </head>

    <div>
		<body>

		<header>
			<h1>Mini Ride Blog</h1>
		</header>
		<main>
			<h2>Show us how your ride went :)</h2>
			<form id="upload_form"
				action="." method="POST"
				enctype="multipart/form-data">
				<input type="hidden" name="action" value="upload">
				<input type="file" name="file1"><br>
				<input style=" background-color: #2f5f30; color: white; padding: 14px 20px; margin: 8px 0; border-radius: 4px; border: none; cursor: pointer; text-align: center;"
    			id="upload_button" type="submit" value="Upload"><br>
			</form>
			<h2>Rides:</h2>
				<?php if (count($files) == 0) : ?>
				<p>No images uploaded.</p>
				<?php else: ?>
				<table class="center" style="background-color: white; padding: 20px">
					<?php foreach($files as $filename) :
						$file_url = $image_dir . '/' .
								$filename;
						$delete_url = '.?action=delete&amp;filename=' .
                              urlencode($filename);
					?>
					<tr>
						<td>
							<img  width= "auto" height="auto" src="<?php echo $file_url; ?>" align="center"
								alt="<?php echo $filename; ?>" />
						</td>
						<td>
							<a href="<?php echo $delete_url;?>">
							<img src="delete.png" alt="Delete"></a>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
			<?php endif; ?>
		</main>
		</body>
	</div>
</html>
<?php include '../view/footer.php'; ?>