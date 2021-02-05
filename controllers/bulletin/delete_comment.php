<?php  
require_once '../connection.php';
$id = intval($_GET['id']);

$query = "DELETE FROM post WHERE post_id = $id";
$cn->query($query);

header("Location: ../../views/forms/post.php");