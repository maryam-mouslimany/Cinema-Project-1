<?php
require("../connection/connection.php");

$query = "CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    role_id INT(11),
    birth_date DATE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE SET NULL
)";

if ($mysqli->query($query) === TRUE) {
    echo "Table created successfully.";
} else {
    echo "Error creating table: " . $mysqli->error;
}
?>
