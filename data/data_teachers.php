<?php
require $_SERVER['DOCUMENT_ROOT']."/ColsamApp/class/TeacherController.php";
session_start();
if(!isset($_SESSION['TeacherController'])){
    $_SESSION['TeacherController'] = new TeacherController();
}
$request = json_decode(file_get_contents('php://input'));
echo json_encode($_SESSION['TeacherController']->updateTeacher($request->user, $request->nombre, $request->apellido,
    $request->email, $request->tel, $request->edad, $request->passNew));