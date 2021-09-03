<?php
function process_image($dir, $filename) {
    // Set up the variables
    $dir = $dir . DIRECTORY_SEPARATOR;
    $i = strrpos($filename, '.');
    $image_name = substr($filename, 0, $i);
    $ext = substr($filename, $i);

    // Set up the read path
    $image_path = $dir . DIRECTORY_SEPARATOR . $filename;

    // Set up the write paths
    $image_path_400 = $dir . $image_name . '_400' . $ext;
    $image_path_100 = $dir . $image_name . '_100' . $ext;

    // Create an image that's a maximum of 400x300 pixels
    resize_image($image_path, $image_path_400, 400, 300);

    // Create a thumbnail image that's a maximum of 100x100 pixels
    resize_image($image_path, $image_path_100, 100, 100);
}

/*******************************************
 * Resize image to 400x300 max
 ********************************************/
function resize_image($old_image_path, $new_image_path,
        $max_width, $max_height) {

    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // Set up the function names
    switch($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            echo 'File must be a JPEG, GIF, or PNG image.';
            exit;
    }
}
?>

