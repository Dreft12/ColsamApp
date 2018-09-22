<?php
require $_SERVER['DOCUMENT_ROOT']."/ColsamApp/class/LoginController.php";
session_start();
if(!isset($_SESSION['LoginController'])){
    $_SESSION['LoginController'] = new LoginController();
}
$request = json_decode(file_get_contents('php://input'));
//echo $request->user;
echo json_encode($_SESSION['LoginController']->login($request->user));

//$_SESSION['LoginController']->create();