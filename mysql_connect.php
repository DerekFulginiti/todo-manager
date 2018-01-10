<?php

$dbusername = "root";
$dbpass = "Soriam1000.";
try {
	$db = new PDO('mysql:host=localhost;dbname=todo_manager', $dbusername, $dbpass, array(
		PDO::ATTR_PERSISTENT => true
	));
	// print "success!!";
} catch (PDOException $e) {
	print "Error: " . $e->getMessage() . "<br/>";
	die();
}

?>
