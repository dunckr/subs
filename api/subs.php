<?php

// config: $host, $database, $user, $pass
require_once('config.php');

if (isset($_POST['email'])) {
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
}

try {
	$conn = new PDO("mysql:host=$host;dbname=$database",$user,$pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $sql = "INSERT INTO users (email,time) VALUES (:email,CURRENT_TIMESTAMP)";
  $q = $conn->prepare($sql);
  $q->execute(array(':email'=>$email));

} catch (PDOException $e) {
	echo $e->getMessage();
}

?>
