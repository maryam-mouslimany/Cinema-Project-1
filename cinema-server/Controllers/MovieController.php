<?php
require __DIR__ . '/../models/Movie.php';
require __DIR__ . '/BaseController.php';

class MovieController extends BaseController
{
    public function getMovies() 
    {
        $response = [];
        $response["status"] = 200;

        if (!isset($_GET["id"])) {
            $movies = Movie::all($this->mysqli);

            $response["movies"] = [];
            foreach ($movies as $a) {
                $response["movies"][] = $a->toArray();
            }
            echo json_encode($response);
            return;
        }

        $id = $_GET["id"];
        $movie = Movie::find($this->mysqli, $id);
        $response["movie"] = $movie->toArray();

        echo json_encode($response);
        return;
    }
}
