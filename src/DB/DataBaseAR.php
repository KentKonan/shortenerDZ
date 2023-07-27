<?php

namespace Kent\PhpPro\DB;

use Illuminate\Database\Capsule\Manager;

class DataBaseAR
{
    const DRIVER = 'mysql';
    const HOST = 'db_mysql';
    const PREFIX = '';
    const CHARSET = 'utf8';
    const COLLATION = 'utf8_unicode_ci';

    public function __construct(
        string $database,
        string $user,
        string $pass,
        int $port,
        string $host = self::HOST,
        string $dbDriver = self::DRIVER,
        string $prefix = self::PREFIX,
        string $charset = self::CHARSET,
        string $collation = self::COLLATION
    ) {
        $dbManager = new Manager();
        $dbManager->addConnection([
            "driver" => $dbDriver,
            "host" => $host,
            "database" => $database,
            "username" => $user,
            "password" => $pass,
            "charset" => $charset,
            "collation" => $collation,
            "prefix" => $prefix,
            "port" => $port,

        ]);

        $dbManager->bootEloquent();
    }
}
