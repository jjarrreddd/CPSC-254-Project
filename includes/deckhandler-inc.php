<?php 

//Makes sure user utilizes deckhandler-inc.php to access this file!
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$deckName = $_POST["deckName"];
	$InWord = $_POST["InWord"];
	$InDef = $_POST["InDef"];
	try{
		require_once "dbh-inc.php";
		$query = "INSERT INTO decks (deckName,InWord,InDef) VALUES(?,?,?);";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$deckName,$InWord,$InDef]);
		$pdo = null;
		$stmt = null;
		die();
	} catch(PDOException $e){
		die("Query failed:".$e->getMessage());
	}
}

else{
}
