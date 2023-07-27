<?php
namespace Kent\PhpPro\Shortener\Helpers;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use InvalidArgumentException;
use Kent\PhpPro\Shortener\Interfaces\IUrlValidator;

class UrlValidator implements IUrlValidator {

    protected ClientInterface $client;

    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */

    public function validateUrl(string $url): bool
    {
        if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)){
            throw new InvalidArgumentException('Url is Broken');

        }

        $this->checkRealUrl($url);
        return $url;
    }


    /**
     * @param string $url
     * @return bool
     */
    public function checkRealUrl(string $url): bool
    {
        $allowCodes = [
            200, 201, 301, 302
        ];
        try {
            $response = $this->client->request('GET', $url);
            return (!empty($response->getStatusCode()) && in_array($response->getStatusCode(), $allowCodes));
        } catch (ConnectException $exception) {
            throw new InvalidArgumentException($exception->getMessage(), $exception->getCode());
        }

    }
//        include('check_code.php');
//        $httpCode=get_http_response_code($url);
//        if((in_array($httpCode, $allowCodes) === true)){
//
//        return $url;
//        } else {
//            throw  new InvalidArgumentException('Not normal Url');
//
//        }
//    }

//        $handle = curl_init($url);
//        curl_setopt(handle: $handle, option: CURLOPT_RETURNTRANSFER, value: TRUE);
//
//
//         $response = (int)curl_exec($handle);
//
//
//        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
//
//
//        if(!(in_array($httpCode, $allowCodes) === true)) {
//
//            throw  new InvalidArgumentException('Not normal Url');
//            curl_close($handle);
//        }
//
//
//        curl_close($handle);
//        return true;
//
//
//    }












}