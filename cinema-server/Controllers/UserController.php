<?php
global $mysqli;
require __DIR__ . '/../connection/connection.php';
require __DIR__ . '/../models/User.php';

class userController
{
    public function viewProfile()
    {
        global $mysqli;
        if (isset($_GET["id"])) {
            $id = ($_GET["id"]);
            $user = User::find($mysqli, $id);

            if ($user) {
                $genres = $user->getGenres($mysqli, $id);
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
    }
    public function deleteUser()
    {
        global $mysqli;
        $id = $_GET['id'];
        if ($id) {
            User::delete($mysqli, $id);
        } else {
            echo 'user not found';
        }
    }

    public function updateUser()
    {
        global $mysqli;
        $data = $_POST;

        if (
            isset($data["id"]) && isset($data["email"]) && isset($data["phone"]) &&  isset($data["first_name"]) &&
            isset($data["last_name"]) && isset($data["communication_preference"]) && isset($data["payment_method"])
        ) {

            $id = $data["id"];
            $email = $data["email"];
            $first_name = $data["first_name"];
            $last_name = $data["last_name"];
            $phone = $data["phone"];
            $communication_preference = $data["communication_preference"];
            $payment_method = $data["payment_method"];

            $userData = [
                "email" => $email,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "phone" => $phone,
                "communication_preference" => $communication_preference,
                "payment_method" => $payment_method
            ];

            if (isset($data["password"]) && $data["password"] !== "") {
                $password = $data["password"];

                if (strlen($password) < 6) {
                    echo json_encode(["success" => false, "message" => "Password must be at least 6 characters"]);
                    exit;
                }

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $userData["password"] = $hashed_password;
            }
            $user = User::find($mysqli, $id);

            if (!$user) {
                echo json_encode(["success" => false, "message" => "User not found"]);
                exit;
            }

            $user->update($mysqli, $userData);

            echo json_encode(["success" => true, "message" => "User updated successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => "Missing required fields"]);
        }
    }
}
