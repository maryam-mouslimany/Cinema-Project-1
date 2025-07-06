<?php
require __DIR__ . '/../connection/connection.php';
require __DIR__ . '/../services/AuthService.php';

class BaseController
{
    protected $mysqli;

    public function __construct(mysqli $mysqli){
        $this->mysqli = $mysqli;
    }
}
