<?php
require $_SERVER['DOCUMENT_ROOT']."/ColsamApp/class/Controller.php";
session_start();
if(!isset($_SESSION['Controller'])){
    $_SESSION['Controller'] = new Controller();
}
$request = json_decode(file_get_contents('php://input'));
//echo $request->user;
echo json_encode($_SESSION['Controller']->login($request->user));

//$_SESSION['Controller']->create();