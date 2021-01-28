<?php  
require_once '../connection.php';
$id = intval($_GET['id']);

$query = "DELETE FROM products WHERE products_id = $id";
$cn->query($query);

header("Location: ../../views/forms/myproducts.php");

