<?php
require("../connection/connection.php");

$query = "
    ALTER TABLE users
        ADD COLUMN communication_preference VARCHAR(50) NULL,
        ADD COLUMN payment_method VARCHAR(50) NULL
";

$mysqli->query($query);

echo "users table updated";
?>
