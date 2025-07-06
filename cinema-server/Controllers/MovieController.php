<?php
global $mysqli;
require __DIR__ . '/../models/Movie.php';
require __DIR__ . '/../connection/connection.php';

class MovieController
{
    public function getMovies()
    {
        global $mysqli;
        $response = [];
        $response["status"] = 200;

        if (!isset($_GET["id"])) {
            $movies = Movie::all($mysqli);

            $response["movies"] = [];
            foreach ($movies as $a) {
                $response["movies"][] = $a->toArray();
            }
            echo json_encode($response);
            return;
        }

        $id = $_GET["id"];
        $movie = Movie::find($mysqli, $id);
        $response["movie"] = $movie->toArray();

        echo json_encode($response);
        return;
    }
}
