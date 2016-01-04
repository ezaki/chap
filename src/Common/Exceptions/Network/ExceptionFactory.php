<?php

namespace keika299\ConohaAPI\Common\Exceptions\Network;


use keika299\ConohaAPI\Common\Exceptions\ConohaAPIException;
use GuzzleHttp\Exception\RequestException as GuzzleHttpRequestException;
use keika299\ConohaAPI\Common\Exceptions\Network\Client;

class ExceptionFactory
{
    /**
     * Class ExceptionFactory
     *
     * This class create ConohaAPIException.
     *
     * @param \Exception $exception
     * @return \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public static function build(\Exception $exception)
    {
        if ($exception instanceof GuzzleHttpRequestException) {
            return self::createClientException($exception);
        }

        return new ConohaAPIException('Conoha API Exception', 0, $exception);
    }

    /**
     * @param GuzzleHttpRequestException $exception
     * @return Client\ClientException
     */
    private static function createClientException(GuzzleHttpRequestException $exception)
    {
        $exceptionArray = array(
            400 => 'BadRequest',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'NotFound',
            405 => 'MethodNotAllowed',
            406 => 'NotAcceptable'
        );

        foreach ($exceptionArray as $item => $value) {
            if ($item === $exception->getCode()) {
                $exceptionName = __NAMESPACE__ . '\Client\\' . $value . 'Exception';
                return new $exceptionName($exception);
            }
        }

        return new RequestException($exception);
    }
}
