<?php

use GuzzleHttp\Client;
use Kent\PhpPro\DB\DataBaseAR;
use Kent\PhpPro\Shortener\Helpers\Filelog;
use Kent\PhpPro\Shortener\Helpers\UrlValidator;
use Kent\PhpPro\Shortener\UrlEncode;


require_once __DIR__ . '/../vendor/autoload.php';



$url = '';
$code = '';
if(isset($_GET["url"])){

    $url = $_GET["url"];
}
if(isset($_GET["code"])){

    $code = $_GET["code"];
}











$fileLog= new Filelog('file.json');

$validatorUrl= new UrlValidator(new Client());




$convert = new UrlEncode(
    $fileLog,
    $validatorUrl,
    7,

);


try{

    $database = 'php_pro';
    $user ='kent' ;
    $pass = '1111' ;
    $host ='localhost';
    $port =3306 ;

    $newConnection= new DataBaseAR(
        database: $database,
        user: $user,
        pass: $pass,
        port: $port);

    echo $convert->encodeWithDB($url);
    echo PHP_EOL;




//    echo $convert->decodeWithDb($code);
//    echo PHP_EOL;
} catch (\PDOException $e) {
    echo "Нет подключения к базе данных: " . $e->getMessage();


}




