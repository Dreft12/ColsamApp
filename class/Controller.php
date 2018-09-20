<?php
require  $_SERVER['DOCUMENT_ROOT']."/ColsamApp/db/Connect.php";

class Controller
{

    public function __construct()
    {

    }

    public function create(){
        r\table("users")->insert(array(
            'idUser' => 2,
            'Nombre' => "Juancho",
            'Apellido' => "Perez",
            'User' => "Juanxd",
            'Pass' => "12345"
        ))->run(Connect::conectar());
    }

    public function login($user){
        $datos = r\table("users")->getAll($user,array('index'=>'User'))->run(Connect::conectar())->toArray();
        return $datos;
    }
}