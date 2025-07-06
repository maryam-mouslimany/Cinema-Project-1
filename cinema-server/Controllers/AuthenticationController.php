<?php
global $mysqli;

require __DIR__ . '/../connection/connection.php';
require __DIR__ . '/../models/User.php';

class AuthenticationController
{

  public function login()
  {
    global $mysqli;

    $response = [];
    $response['message'] = 'Please provide both email and password';
    if (isset($_GET["email"]) && isset($_GET["password"])) {
      $email = $_GET["email"];
      $password = $_GET["password"];
      $user = User::findByEmail($mysqli, $email);
      if ($user) { 
        if ($user->verifyPassword($password)) {
          $response['message'] = 'Login successful';
          $response['user'] = $user->toArray();
        } else
          $response['message'] = 'Wrong password';
      } else
        $response['message'] = 'User not found';
    }
    echo json_encode($response);
  }

  public function register()
  {
    global $mysqli;
    $data = $_POST;
    if (
      isset($data["email"]) &&
      isset($data["password"]) &&
      isset($data["phone"]) &&
      isset($data["first_name"]) &&
      isset($data["last_name"]) &&
      isset($data["birth_date"])
    ) {
      $email = $data["email"];
      $password = $data["password"];
      $first_name = $data["first_name"];
      $last_name = $data["last_name"];
      $phone = $data["phone"];
      $birth_date = $data["birth_date"];

      $sql = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
      $sql->bind_param("s", $email);
      $sql->execute();
      $sql->store_result();
      if ($sql->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Email already exists"]);
        exit;
      }

      if (strlen($password) < 6) {
        echo json_encode(["success" => false, "message" => "Password must be at least 6 characters"]);
        exit;
      }

      $dob = new DateTime($birth_date);
      $today = new DateTime();
      $age = $today->diff($dob)->y;

      if ($age < 18) {
        echo json_encode(["success" => false, "message" => "You must be at least 18 years old to register"]);
        exit;
      }

      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      $userData = [
        "email" => $email,
        "password" => $hashed_password,
        "first_name" => $first_name,
        "last_name" => $last_name,
        "phone" => $phone,
        "birth_date" => $birth_date,
        "role_id" => 1
      ];

      User::create($mysqli, $userData);

      echo json_encode(["success" => true, "message" => "User created successfully"]);
    } else {
      echo json_encode(["success" => false, "message" => "Missing required fields"]);
    }
  }
}
