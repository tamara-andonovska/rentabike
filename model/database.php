<?php
    $dsn = 'mysql:host=localhost;dbname=rentabike';
    $username = 'bikeusr';
    $password = 'usrUsr1!';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>