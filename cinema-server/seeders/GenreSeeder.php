<?php
require("../connection/connection.php");

$query = "INSERT INTO genres (name) VALUES 
('Action'),
('Adventure'),
('Animation'),
('Comedy'),
('Crime'),
('Documentary'),
('Drama'),
('Family'),
('Fantasy'),
('History'),
('Horror'),
('Music'),
('Mystery'),
('Romance'),
('Science Fiction'),
('TV Movie'),
('Thriller'),
('War'),
('Western'),
('Biography'),
('Superhero'),
('Sports');
";

if ($mysqli->query($query) === TRUE) {
    echo "Inserted successfully.";
} else {
    echo "Error: " . $mysqli->error;
}
