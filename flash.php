<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "flashcard";
$port = 3306;

$connect = new mysqli($server, $username, $password, $db, $port);

if ($connect->connect_error) {
	die("Connection failure: " . $connect->connect_error);
}

$input = $_POST['user_input'];

$sql = "INSERT INTO flashcard VALUES (?)");
$command->bind_param("s", $input);

if ($command->execute()) {
	echo "Record inserted successfully";
} else {
	echo "Error: " . $command->error;

$command->close();
