<?php
require("../connection/connection.php");

$query = "INSERT INTO communication_preferences (name) VALUES 
('Email'),
('SMS'),
('Phone Call')
";

if ($mysqli->query($query) === TRUE) {
    echo "Inserted successfully.";
} else {
    echo "Error: " . $mysqli->error;
}
