<?php
namespace Kent\PhpPro\Shortener;







use http\Exception\InvalidArgumentException;
use Kent\PhpPro\DB\Models\Shortener;
use Kent\PhpPro\DB\Models\ShortenerModel;
use Kent\PhpPro\Shortener\Interfaces\IUrlEncoder;
use Kent\PhpPro\Shortener\Helpers\Filelog;
use Kent\PhpPro\Shortener\Helpers\UrlValidator;
use Kent\PhpPro\Shortener\Helpers\MyExeption;



class UrlEncode  implements IUrlEncoder
{
    const CODE_LENGTH = 8;

    const CODE_CHAIRS = '1234567890qwertyuiopasdfghjklzxcvbnm';

    protected int $codeLength;




    public function __construct(
        protected  Filelog $filelog,
        protected UrlValidator $validator,
        int    $codeLength = self::CODE_LENGTH


    )
    {
        $this->codeLength=$codeLength;





    }


 public function encode(string $url): string
{
    $this->validator->validateUrl($url);

    try {(
        $code= $this->filelog->checkCode($url));
    } catch (MyExeption $e){

        $code= $this->createCodeAndSave($url);

    }
return $code;
}


public function encodeWithDB(string $url): string
{
    $this->validator->validateUrl($url);
        $requestModel = new Shortener();
        if  ( !empty($code = Shortener::where('url', $url)->pluck('code')->first())){

            return $code;

        }
        $code = $this->createCodeAndSaveToDB($url);


    return $code;


//    $this->validator->validateUrl($url);
//
//
//
//
//    if (!($shortener=Shortener::all())) {
//
//        $code = $this->generateUniqueCode();
//        $shortener =Shortener::create([
//            'code' => $code,
//            'url' => $url
//        ]);
//    }
//
//    return $shortener->code;

}

    protected function createCodeAndSave(string $url):string
    {
        $code = $this->generateUniqueCode();

        $this->filelog->saveEntity($url, $code);
        return $code ;

    }

    protected function createCodeAndSaveToDB(string $url):string
    {
        $code = $this->generateUniqueCode();

$this->filelog->saveInDB( $url, $code );
        return $code ;

    }

    protected function generateUniqueCode(): string
    {
        $date = new \DateTime();
        $str = static::CODE_CHAIRS . mb_strtoupper(static::CODE_CHAIRS) . $date->getTimestamp();
        return $code = substr(str_shuffle($str), 0, $this->codeLength);
    }




    public function decode(string $code):string
    {
        try { $url = $this->filelog->getUrl($code);

        }catch (MyExeption $e){
            throw new  InvalidArgumentException( "We dont have your Url ");
        }

        return $url;

    }


    public function decodeWithDb(string $code):string
    {
        try { $url = Shortener::where('code', $code)->pluck('url')->first();

        }catch (MyExeption $e){
            throw new  InvalidArgumentException( "We dont have your Url ");
        }

        return $url;

    }










}