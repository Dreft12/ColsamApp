<?php
require $_SERVER['DOCUMENT_ROOT'] . "/ColsamApp/db/Connect.php";

class LoginController
{

    public function __construct()
    {

    }

    public function login($user)
    {
        $temp = array();
        $datos = r\table('users')->getAll($user, array('index' => 'User'))->eqJoin('idValor', r\table('valorParametro'), array('index' => 'idValor'))->zip()->run(Connect::conectar())->toArray();
        $estMora = r\table('users')->getAll($user, array('index' => 'User'))->eqJoin('idUser', r\table('estMora'), array('index' => 'idEst'))->zip()->run(Connect::conectar())->toArray();
        if(empty($estMora)){
            $temp = $datos;
        }else{
            $temp = $estMora;
        }
        return $temp;
    }
}