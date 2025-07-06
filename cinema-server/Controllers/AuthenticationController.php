<?php
require __DIR__ . '/BaseController.php';
require __DIR__ . '/../models/User.php';

class AuthenticationController extends BaseController
{

  public function login()
  {
    $helper = new AuthService();
   $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data["email"]) && isset($data["password"])) {
      $user = User::findByEmail($this->mysqli, $data["email"]);
      if ($user) {
        if ($user->verifyPassword($data["password"])) {
          $helper->respondSuccess("message", $user);
        } else
          $helper->respondError("Wrong Password");
      } else
        $helper->respondError("User not found");
    }
    $helper->echoResponse();
  }

  public function register()
  {
    $helper = new AuthService();
   $data = json_decode(file_get_contents('php://input'), true);

    if (
      isset($data["email"]) &&
      isset($data["password"]) &&
      isset($data["phone"]) &&
      isset($data["first_name"]) &&
      isset($data["last_name"]) &&
      isset($data["birth_date"])
    ) {

      if (User::findByEmail($this->mysqli, $data["email"])) {
        $helper->respondError("Email already exists");
        $helper->echoResponse();
      }

      if (!AuthService::validatePassword($data["password"])) {
        $helper->respondError("Password should be at least six characters");
        $helper->echoResponse();
      }

      if (!AuthService::validateAge($data["birth_date"])) {
        $helper->respondError("You must be at least 18 years old to register");
        $helper->echoResponse();
      }

      $hashed_password = password_hash($data["password"], PASSWORD_DEFAULT);

      $userData = [
        "email" => $data["email"],
        "password" => $hashed_password,
        "first_name" => $data["first_name"],
        "last_name" => $data["last_name"],
        "phone" => $data["phone"],
        "birth_date" => $data["birth_date"],
        "role_id" => 1
      ];

      User::create($this->mysqli, $userData);
      $helper->respondSuccess("Registration successful");
    } else {
      $helper->respondError("Missing required fields");
    }
    $helper->echoResponse();
  }
}
