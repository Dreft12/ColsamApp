<?php
require  $_SERVER['DOCUMENT_ROOT']."/ColsamApp/back/db/Connect.php";

class Controller
{

    public function __construct()
    {

    }

    public function create(){
        r\table("users")->insert(array(
            'id' => 4,
            'nombre' => "FUNCIONAAAAAAAAAAAAAA",
            'apellido' => "XDXDXD"
        ))->run(Connect::conectar());
    }
}