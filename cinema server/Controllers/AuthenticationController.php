<?php 
require("../models/User.php");
require("../connection/connection.php");

if (isset($_GET["email"]) && isset($_GET["password"])) {
    $email = $_GET["email"];
    $password = $_GET["password"];

    $user = User::findByEmail($mysqli, $email); 

    if ($user) {
        if ($user->verifyPassword($password)) {
            echo json_encode([
                "message" => "Login successful",
                "user" => $user->toArray()
            ]);
        } else {
            echo json_encode([
                "message" => "Wrong password"
            ]);
        }
    } else {
        echo json_encode([
            "message" => "User not found"
        ]);
    }
} else {
    echo json_encode([
        "message" => "Please provide both email and password"
    ]);
}