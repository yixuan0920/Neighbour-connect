<?php 
	session_start();
	require_once '../connection.php';

	$comments = htmlspecialchars($_POST['comments']);
	$users_id = $_SESSION['user_details']['users_id'];

	$has_details = false;
	echo "string";

foreach($_POST as $key => $value) {
	if(empty($value)) {
		echo "Please fill out all fields";
		echo "<br>";
		die("<a href='../../views/forms/post.php'>Go back Your post</a>");
	} else {
		$has_details = true;
	}
} 

	if($has_details > 0){
		$query = "INSERT INTO post(comments, users_id) VALUES (?,?)";
			echo "string1";
		$stmt = $cn->prepare($query);
		$stmt->bind_param("si", $comments, $users_id);
		$stmt->execute();
		$stmt->close();
		$cn->close();

		header("Location: ../../views/forms/post.php");

	}