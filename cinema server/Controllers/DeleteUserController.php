<?php
require("../models/User.php");
require("../connection/connection.php");

$id=$_GET['id'];
if ($id) {
    User::delete($mysqli,$id);
}
else{
    echo'user not found';
}