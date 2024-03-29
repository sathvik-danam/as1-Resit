<?php

session_start();

require_once("logout.php");
require_once("theconnection.php");

if (isset($_POST['addcategory'])) {
    $stmt = $Conn->prepare('INSERT INTO categories (category_name, description)
    VALUES (:category_name, :description)');
    //print_r($_POST);
    $values = array('category_name' => $_POST['category_name'], 'description' => $_POST['description']);
    $msg = "Category created successfully.";
    try {
        if (!$stmt->execute($values)) {
            $msg = "Category might already exist.";
        }
    } catch (Exception $ex) {
        $msg = "Category might already exist.";
    }
    header("location: adminCategories.php?msg=" . $msg);
}
