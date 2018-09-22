<?php
require $_SERVER['DOCUMENT_ROOT'] . "/ColsamApp/db/Connect.php";

class LoginController
{

    public function __construct()
    {

    }

    public function create()
    {
        r\table("users")->insert(array(
            'idUser' => 2,
            'Nombre' => "Juancho",
            'Apellido' => "Perez",
            'User' => "Juanxd",
            'Pass' => "12345"
        ))->run(Connect::conectar());
    }

    public function login($user)
    {
        $temp = array();
        $datos = r\table("users")->getAll($user, array('index' => 'User'))->run(Connect::conectar())->toArray();
        $mora = r\table("users")->eqJoin('idUser', r\table('estMora'), array('index' => 'idEst'))->zip()->run(Connect::conectar())->toArray();
        $conteo = r\table('estMora')->count()->run(Connect::conectar());
        for ($i = 1; $i <= $conteo; $i++) {
            if ($datos[0]['idUser'] == $mora[0]['idEst']) {
                $temp = array('Mora' => 'Si');
            } else {
                $temp = $datos;
            }
        }
        return $temp;
    }
}