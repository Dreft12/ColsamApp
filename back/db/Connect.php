<?php
require "../../plugins/php-rql/rdb/rdb.php";
Class Connect{

    public function __construct($host, $port, $db = null){
        r\connect($host, $port, $db);
    }
}



