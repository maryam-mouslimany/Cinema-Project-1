<?php
class AuthService
{
    protected $response = [];

    public function respondSuccess($message, $user = null, $genres = null)
    {
        $this->response['success'] = true;
        $this->response['message'] = $message;
        if ($user) {
            $this->response['user'] = $user->toArray();
        }
        if ($genres) {
            $this->response['genres'] = $genres;
        }
    }
    public  function respondError($message)
    {
        $this->response['success'] = false;
        $this->response['message'] = $message;
    }
    public function echoResponse()
    {
        echo json_encode($this->response);
    }
    public static function validatePassword($password)
    {
        return strlen($password) >= 6;
    }
    public static function validateAge($birth_date)
    {
        $dob = new DateTime($birth_date);
        $today = new DateTime();
        $age = $today->diff($dob)->y;

        return $age >= 18;
    }
}