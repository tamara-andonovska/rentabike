<?php include '../view/errorheader.php'; ?>
<html>
<style>
#error {
    background-color: rgba(255, 255, 255, 0.8);
    margin: 15px;
    border-bottom: 2px solid rgb(75, 77, 82);
    padding: .5em 2em;
}
</style>
<div id="error">
    <h1 class="top">Error</h1>
    <p><?php echo $error; ?></p>
</div>
<?php include '../view/footer.php'; ?>