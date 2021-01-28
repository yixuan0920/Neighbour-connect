<?php  
require_once '../connection.php';	

//sanitize our inputs
$errors = 0;
$name1 = htmlspecialchars($_POST['name1']);
$username = htmlspecialchars($_POST['username']);
$address = htmlspecialchars($_POST['address']);
$password = htmlspecialchars($_POST['password']);
$password2 = htmlspecialchars($_POST['password2']);
// var_dump($posts_id);
// die();
//all inputs should not be empty
foreach($_POST as $key => $value) {
	if(strlen($value) == 0 && empty($value)) {
		$errors++;		
		echo "Please fill out all fields";
		echo "<br>";
		die("<a href='../../views/forms/register.php'>Go back Register</a>");
	}
}

//username should be greater than 8
if(strlen($username) < 8) {
	echo "Username must be greater than 8 characters";
	$errors++;
}

//password should be greater than 8 characters
if(strlen($password) < 8) {
	echo "Password must be greater than 8 characters";
	$errors++; 
}

//password and confirm password should match
if($password != $password2) {
	echo "Passwords do not match";
	$errors++;
}

//check if the username or email already exists
if($username || $email) {
	$query = "SELECT * FROM users WHERE username = ?";
	$stmt = $cn->prepare($query);
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_all(MYSQLI_ASSOC);
	
	if($user) {
		echo "Username or email already exists";
		$errors++;
		$cn->close();
		$stmt->close();
	}
}

echo "one"; 

//if $errors still at 0 then we can register
if($errors === 0) {
	echo "two";
	$pass = password_hash($password, PASSWORD_DEFAULT);
	$query = "INSERT INTO users (name, username, password, address) VALUES ( ?, ?, ?, ?)";
	$stmt = $cn->stmt_init();
	if(!$stmt->prepare($query)){
	echo "error";
	die();
	}
	$stmt->bind_param("ssss", $name1, $username, $pass, $address);
	$stmt->execute();
	$stmt->close();
	$cn->close();

	//send an email that says you have successfully registered.

	//Create the transport
	// $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
	// ->setUsername("")
	// ->setPassword("");

	//Create the Mailer using your created Transport
	// $mailer = new Swift_Mailer($transport);

	//Create a message
	// $message = (new Swift_Message("B2-ECOM Registration"))
	// ->setFrom(['emerson@forwardschool.co' => 'Emerson']) 
	// ->setTo([$email => $firstname])
	// ->setBody("Thank you for creating an account in B2-ECOM");

	// $mailer->send($message);
	
	header("Location: /");
}