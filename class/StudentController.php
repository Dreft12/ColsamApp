<?php
require $_SERVER['DOCUMENT_ROOT'] . "/ColsamApp/class/LoginController.php";
class StudentController
{
    public function updateStudent($user, $nombre, $apellido, $email, $telAcu, $fechaN, $passNew, $passNew2 ){
        $datos=r\table('users')->getAll($user, array('index' => 'User'))->update(array('Nombre' => $nombre,
            'Apellido' => $apellido, 'Email'=>$email, 'TelAcudiente' => $telAcu, 'Edad'=>$fechaN, 'Pass' => $passNew))->run(Connect::conectar());
        if($datos['replaced'] == 1){
            $res = "si";
            $student = LoginController::login($user);
        }else{
            $res = "no";
        }
        $temp = array_push($student, $res);
        return $temp;
    }
}