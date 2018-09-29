<?php
require $_SERVER['DOCUMENT_ROOT'] . "/ColsamApp/class/LoginController.php";
class StudentController
{
    public function updateStudent($user, $nombre, $apellido, $email, $telAcu, $fechaN, $passNew, $passNew2 ){
        $student = array();
        $datos=r\table('users')->getAll($user, array('index' => 'User'))->update(array('Nombre' => $nombre,
            'Apellido' => $apellido, 'Email'=>$email, 'TelAcudiente' => $telAcu, 'Edad'=>$fechaN, 'Pass' => $passNew))->run(Connect::conectar());
        if($datos['replaced'] == 1){
            $res = "si";
            $student = LoginController::login($user);
           //array_push($student, $res);
        }else{
            $res = "no";
        }
        array_push($student, $res);
         return $student;
    }
}