<?php
require("../connection/connection.php");

$query = "INSERT INTO genres (name) VALUES 
('Card'),
('Paypal'),
('WishMoney')
";

if ($mysqli->query($query) === TRUE) {
    echo "Inserted successfully.";
} else {
    echo "Error: " . $mysqli->error;
}
