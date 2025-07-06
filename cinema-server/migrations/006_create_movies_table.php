<?php
require("../connection/connection.php");

$sql = "CREATE TABLE  movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name TEXT NOT NULL,
    description TEXT ,
    cast TEXT NOT NULL,
    duration TEXT NOT NULL,
    image TEXT )";

if ($mysqli->query($sql) === TRUE) {
    echo "Table created successfully.";
} else {
    echo "Error creating table: " . $mysqli->error;
}
?>
