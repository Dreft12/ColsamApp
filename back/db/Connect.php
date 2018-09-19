<?php
require $_SERVER['DOCUMENT_ROOT']."/ColsamApp/plugins/php-rql/rdb/rdb.php";
class Connect{
    private static $host = "localhost";
    private static $port = 28015;
    private static $db = "notas";

    public static function conectar(){
        $connect = r\connect(self::$host, self::$port);
        try {
            $connect->useDb(self::$db);
        } catch (\r\Exceptions\RqlDriverError $e) {
            echo $e;
        }
        return $connect;
    }
}



