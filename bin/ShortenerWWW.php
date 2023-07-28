<?php
//use GuzzleHttp\Client;
//use Kent\PhpPro\DB\DataBaseAR;
//use Kent\PhpPro\Shortener\Helpers\Filelog;
//use Kent\PhpPro\Shortener\Helpers\UrlValidator;
//use Kent\PhpPro\Shortener\UrlEncode;
//
//
//require_once __DIR__ . '/../vendor/autoload.php';
//
//
//
//
//
//
//
//
//
//$fileLog= new Filelog('file.json');
//
//$validatorUrl= new UrlValidator(new Client());
////
////$url="https://www.google.com/";
////$url="https://www.twitch.tv/";
////$url="1";
//$code="1sgRQ9d";
//
//$convert = new UrlEncode(
//    $fileLog,
//    $validatorUrl,
//    7,
//
//);
//
//
//try{
//
//    $database = 'php_pro';
//    $user ='kent' ;
//    $pass = '1111' ;
//    $host ='localhost';
//    $port =3306 ;
//
//    $newConnection= new DataBaseAR(
//        database: $database,
//        user: $user,
//        pass: $pass,
//        port: $port);
//
//    echo $convert->encodeWithDB($url);
////    echo $convert->decodeWithDb($code);
//
//} catch (\PDOException $e) {
//    echo "Нет подключения к базе данных: " . $e->getMessage();
//    echo $convert->encode($url);
////echo $convert->decode($code);
//
//
//    echo PHP_EOL;
//}




