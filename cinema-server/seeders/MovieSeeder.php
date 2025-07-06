<?php
require("../models/Movie.php");
require("../connection/connection.php");
$img = '../../cinema client/assets/Inception.jfif';
$imgTo64 = base64_encode(file_get_contents($img));

$movie1 = [
    'name' => 'The Dark Knight',
    'description' => 'When the Joker wreaks havoc, Batman faces one of his toughest psychological and moral tests.',
    'duration' => '152 min',
    'image' => $imgTo64,
    'cast' => 'Christian Bale, Heath Ledger, Aaron Eckhart'
];

$movie2 = [
    'name' => 'Interstellar',
    'description' => 'A team of explorers travel through a wormhole in space in an attempt to save humanity.',
    'duration' => '169 min',
    'image' => null,
    'cast' => 'Matthew McConaughey, Anne Hathaway, Jessica Chastain'
];

$movie3 = [
    'name' => 'The Matrix',
    'description' => 'A hacker discovers the shocking truth about his reality and joins a rebellion against the machines.',
    'duration' => '136 min',
    'image' => null,
    'cast' => 'Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss'
];

$movie4 = [
    'name' => 'Avatar',
    'description' => 'A marine on an alien planet becomes torn between following orders and protecting the world he feels is his new home.',
    'duration' => '162 min',
    'image' => null,
    'cast' => 'Sam Worthington, Zoe Saldana, Sigourney Weaver'
];

$movie5 = [
    'name' => 'Inception',
    'description' => 'A skilled thief is given a chance at redemption if he can successfully plant an idea in someone’s mind.',
    'duration' => '148 min',
    'image' => null,
    'cast' => 'Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page'
];

$movie6 = [
    'name' => 'Gladiator',
    'description' => 'A betrayed Roman general fights his way back to revenge through the gladiator arena.',
    'duration' => '155 min',
    'image' => null,
    'cast' => 'Russell Crowe, Joaquin Phoenix, Connie Nielsen'
];

$movie7 = [
    'name' => 'Titanic',
    'description' => 'A young couple from different social classes fall in love aboard the ill-fated Titanic.',
    'duration' => '195 min',
    'image' => null,
    'cast' => 'Leonardo DiCaprio, Kate Winslet, Billy Zane'
];

$movie8 = [
    'name' => 'Avengers: Endgame',
    'description' => 'The Avengers come together for one final stand against Thanos to save the universe.',
    'duration' => '181 min',
    'image' => null,
    'cast' => 'Robert Downey Jr., Chris Evans, Scarlett Johansson'
];

$movie9 = [
    'name' => 'Joker',
    'description' => 'A mentally troubled man’s descent into madness sparks a revolution in Gotham City.',
    'duration' => '122 min',
    'image' => null,
    'cast' => 'Joaquin Phoenix, Robert De Niro, Zazie Beetz'
];

$movie10 = [
    'name' => 'The Lion King',
    'description' => 'A young lion prince flees his kingdom after the death of his father but returns to reclaim his throne.',
    'duration' => '118 min',
    'image' => null,
    'cast' => 'Matthew Broderick, Jeremy Irons, James Earl Jones'
];

Movie::create($mysqli,$movie1);
Movie::create($mysqli,$movie2);
Movie::create($mysqli,$movie3);
Movie::create($mysqli,$movie4);
Movie::create($mysqli,$movie5);
Movie::create($mysqli,$movie6);
Movie::create($mysqli,$movie7);
Movie::create($mysqli,$movie8);
Movie::create($mysqli,$movie9);
Movie::create($mysqli,$movie10);