<?php
require("../connection/connection.php");

// Hash and use a unified password
$hashedPassword = password_hash("password123", PASSWORD_DEFAULT);

$query1 = "INSERT INTO users (first_name, last_name, email, password, phone, role_id, birth_date)
           VALUES ('Jawad', 'Abbas', 'jawad@gmail.com', ?, '81305963', 1, '1996-06-19')";
$insertUser1 = $mysqli->prepare($query1);
$insertUser1->bind_param("s", $hashedPassword);
$insertUser1->execute();

$query2 = "INSERT INTO users (first_name, last_name, email, password, phone, role_id, birth_date)
           VALUES ('Lea', 'Khoury', 'lea@example.com', ?, '71654321', 1, '1998-04-10')";
$insertUser2 = $mysqli->prepare($query2);
$insertUser2->bind_param("s", $hashedPassword);
$insertUser2->execute();

echo "inserted successfully";

