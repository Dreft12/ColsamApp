<?php
require $_SERVER['DOCUMENT_ROOT'] . "/ColsamApp/class/LoginController.php";
class TeacherController
{
    public function updateTeacher($user, $nombre, $apellido, $email, $telAcu, $fechaN, $passNew){
        $teacher = array();
        if($passNew == ''){
            $datos=r\table('users')->getAll($user, array('index' => 'User'))->update(array('Nombre' => $nombre,
                'Apellido' => $apellido, 'Email'=>$email, 'TelAcudiente' => $telAcu, 'Edad'=>$fechaN))->run(Connect::conectar());
        }else{
            $datos=r\table('users')->getAll($user, array('index' => 'User'))->update(array('Nombre' => $nombre,
                'Apellido' => $apellido, 'Email'=>$email, 'TelAcudiente' => $telAcu, 'Edad'=>$fechaN,'Pass' => $passNew))->run(Connect::conectar());
        }
        if($datos['replaced'] == 1){
            $res = "si";
            $teacher = LoginController::login($user);
        }else{
            $res = "no";
        }
        array_push($teacher, $res);
        return $teacher;
    }
}