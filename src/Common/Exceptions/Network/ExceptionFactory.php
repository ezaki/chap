<?php

namespace keika299\ConohaAPI\Common\Exceptions\Network;


use keika299\ConohaAPI\Common\Exceptions\ConohaAPIException;
use GuzzleHttp\Exception\RequestException as GuzzleHttpReqquestException;
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
    public static function build(\Exception $exception = null)
    {
        if ($exception instanceof GuzzleHttpReqquestException) {
            switch ($exception->getCode()) {
                case 400:
                    return new Client\BadRequestException($exception);
                case 401:
                    return new Client\UnauthorizedException($exception);
                case 403:
                    return new Client\ForbiddenException($exception);
                case 404:
                    return new Client\NotFoundException($exception);
                case 405:
                    return new Client\MethodNotAllowedException($exception);
                case 406:
                    return new Client\NotAcceptableException($exception);
                default:
                    return new RequestException($exception);
            }
        }

        return $exception !== null ? $exception : new ConohaAPIException();
    }
}
