<?php
require $_SERVER['DOCUMENT_ROOT']."/ColsamApp/class/StudentController.php";
session_start();
if(!isset($_SESSION['StudentController'])){
    $_SESSION['StudentController'] = new StudentController();
}
$request = json_decode(file_get_contents('php://input'));
echo json_encode($_SESSION['StudentController']->updateStudent($request->user, $request->nombre, $request->apellido,
    $request->email, $request->telAcudiente, $request->edad, $request->passNew, $request->passNew2));