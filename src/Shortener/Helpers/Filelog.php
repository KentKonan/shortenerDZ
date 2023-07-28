<?php

namespace Kent\PhpPro\Shortener\Helpers;

use Kent\PhpPro\DB\Models\Shortener;
use Kent\PhpPro\DB\Models\ShortenerModel;
use Kent\PhpPro\Shortener\Helpers\MyExeption;

class Filelog
{


    public string $filename;
    private array $all = [];

    public function __construct(string $filename

    )
    {
        $this->filename = $filename;
        $this->getContentFromFile();


    }

    public function getContentFromFile()
    {
        if (file_exists($this->filename)) {
            $content = file_get_contents($this->filename);
            $this->all = (array)json_decode($content, true);
        }

    }


    public function saveEntity(string $url, string $code): array
    {
        $this->all[$code]=$url;
        return $this->all;
    }

    public function saveInDB(string $url, string $code)
    {

        $requestModel=Shortener::create([
            'code' => $code,
            'url' => $url
        ]);

    }

    public function checkCode(string $url): string
    {
        if ( !$code = array_search($url,$this->all)){
            throw new MyExeption('');
        }
return $code;


    }


    public function getUrl(string $code): string
    {

            if (!$url = $this->all[$code]){

                throw new MyExeption('');
            }
            return $url;



    }


    function WriteFile($content)

    {

        $file = fopen($this->filename, "w+");
        fwrite($file,$content);
        fclose($file);

    }

    public function __destruct()
    {
        $this->writeFile(json_encode($this->all));
    }


}