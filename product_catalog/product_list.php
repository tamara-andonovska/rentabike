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
        <h1><?php echo $category_name; ?></h1>
        <ul class="nav">
            <?php foreach ($bikes as $bike) : ?>
            <li>
                <a href="?action=view_product&product_id=
                    <?php echo $bike['ID']; ?>">
                    <?php echo $bike['model']; ?>
                </a>
            </li></br>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php include '../view/footer.php'; ?>