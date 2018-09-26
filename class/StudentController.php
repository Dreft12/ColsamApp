<?php

require $_SERVER['DOCUMENT_ROOT'] . "/ColsamApp/db/Connect.php";
class StudentController
{
    public function updateStudent($user, $nombre, $apellido, $email, $telAcu, $fechaN, $passNew, $passNew2 ){
        $datos=r\table('users')->getAll($user, array('index' => 'User'))->update(array('Nombre' => $nombre,
            'Apellido' => $apellido, 'Email'=>$email, 'TelAcudiente' => $telAcu, 'Edad'=>$fechaN, 'Pass' => $passNew))->run(Connect::conectar());
        if($datos['replaced'] == 1){
            $res = "ok";
        }else{
            $res = "no";
        }
        return $res;
    }
}