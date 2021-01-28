<?php  
session_start();
require_once '../connection.php';

//sanitize the inputs
$name = htmlspecialchars($_POST['product_name']);
$price = intval($_POST['price']);
$description = htmlspecialchars($_POST['description']);
$users_id = $_SESSION['user_details']['users_id'];


//image 
$img_name = $_FILES['image']['name'];
$img_size = $_FILES['image']['size'];
$img_tmpname = $_FILES['image']['tmp_name'];
$img_path = "/assets/img/$img_name";
$img_type = pathinfo($img_name, PATHINFO_EXTENSION);

$is_img = false;
$has_details = false;

//To check wether the admin upload an image file
if($img_type == 'jpg'||'JPG' || $img_type == 'jpeg'||'JPEG' || $img_type == 'png'||'PNG' || $img_type == "svg"||'SVG' || $img_type == "gif"||'GIF') {
    $is_img = true;
} else {
    echo "Please upload an image file";
}

//To check wether the admin fill out all fields.
foreach($_POST as $key => $value) {
	if(empty($value)) {
		echo "Please fill out all fields";
		echo "<br>";
		die("<a href='../../views/forms/myproducts.php'>Go back Register</a>");
	} else {
		$has_details = true;
	}
} 

//Store the product in the database.
if($has_details && $is_img && $img_size > 0) {
	move_uploaded_file($img_tmpname, $_SERVER["DOCUMENT_ROOT"].$img_path);
	$query = "INSERT INTO products (name, price, description, image, users_id) VALUES (?, ?, ?, ?, ?)";

	$stmt = $cn->prepare($query);
	$stmt->bind_param("ssssi", $name, $price, $description, $img_path, $users_id);
	$stmt->execute();
	$stmt->close();
	$cn->close();

	header("Location: ../../views/forms/myproducts.php");
}