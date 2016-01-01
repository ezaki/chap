<?php

namespace keika299\ConohaAPI\Common\Exceptions\Network;


use keika299\ConohaAPI\Common\Exceptions\IConohaAPIException;

class RequestException extends \GuzzleHttp\Exception\RequestException implements IConohaAPIException
{
    public function __construct(\GuzzleHttp\Exception\RequestException $exception)
    {
        parent::__construct(
            $exception->getMessage(),
            $exception->getRequest(),
            $exception->getResponse(),
            $exception->getPrevious(),
            $exception->getHandlerContext());
    }
}
