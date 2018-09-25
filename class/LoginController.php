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
        $mora = r\table("users")->run(Connect::conectar())->toArray();
        $conteo = r\table('estMora')->count()->run(Connect::conectar());
        $panel = r\table('users')->eqJoin('idRol', r\table('valorParametro'))->zip()->run(Connect::conectar())->toArray();
    }
}