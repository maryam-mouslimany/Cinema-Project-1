<?php 
require("../models/User.php");
require("../connection/connection.php");


if (isset($_GET["id"])) {
    $id = ($_GET["id"]);  
    $user = User::find($mysqli, $id);
    
    if ($user) {
         $genres = $user -> getGenres($mysqli, $id);
        $response["success"] = true;

        $response["user"] = $user->toArray();
         $response["genres"] = $genres;
    } else {
        $response["success"] = false;

        $response["error"] = "User not found";
    }
} else {
    $response["success"] = false;
    $response["error"] = "Missing user ID";
}

echo json_encode($response);