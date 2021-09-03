<?php
function get_categories() {
    global $db;
    $query = 'SELECT * FROM category
              ORDER BY ID';
    $result = $db->query($query);
    return $result;
}

function get_category_name($category_id) {
    global $db;
    $query = "SELECT * FROM category
              WHERE ID = $category_id";
    $category = $db->query($query);
    $category = $category->fetch();
    $category_name = $category['name'];
    return $category_name;
}

?>