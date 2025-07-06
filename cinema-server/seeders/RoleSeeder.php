<?php
require("../connection/connection.php");

$query = "INSERT INTO roles (name) VALUES ('customer'), ('admin')";

if ($mysqli->query($query) === TRUE) {
    echo "Inserted successfully.";
} else {
    echo "Error: " . $mysqli->error;
}
