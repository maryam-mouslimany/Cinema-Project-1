<?php
require __DIR__ . '/../models/User.php';
require __DIR__ . '/BaseController.php';

class userController extends BaseController
{
    public function viewProfile()
    {
        $helper = new AuthService();

        if (isset($_GET["id"])) {
            $id = ($_GET["id"]);
            $user = User::find($this->mysqli, $id);

            if ($user) {
                $genres = $user->getGenres($this->mysqli, $id);
                $helper->respondSuccess("profile lead successfully", $user, $genres);
            } else {
                $helper->respondError("User not found");
                $helper->echoResponse();
            }
        } else {
            $helper->respondError("Missing user id");
            $helper->echoResponse();
        }

        $helper->echoResponse();
    }
    public function deleteUser()
    {
        $id = $_GET['id'];
        $helper = new AuthService();

        if ($id) {
            User::delete($this->mysqli, $id);
            $helper->respondSuccess("Deleted sucessfully");
            $helper->echoResponse();
        } else {
            $helper->respondError("user not found");
            $helper->echoResponse();
        }
    }

    public function updateUser()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $helper = new AuthService();

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
                if (!AuthService::validatePassword($data["password"])) {
                    $helper->respondError("Password should be at least six characters");
                    $helper->echoResponse();
                }

                $hashed_password = password_hash($data["password"], PASSWORD_DEFAULT);
                $userData["password"] = $hashed_password;
            }
            $user = User::find($this->mysqli, $id);

            if (!$user) {
                $helper->respondError("user not found");
                $helper->echoResponse();
            }

            $user->update($this->mysqli, $userData);

            $helper->respondSuccess("User updated successfully");
        } else {
            $helper->respondSuccess("Missing Required Fields");
        }
        $helper->echoResponse();
    }
}
