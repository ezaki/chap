<?php
/**
 * Created by IntelliJ IDEA.
 * User: gekkeika
 * Date: 2015/12/31
 * Time: 21:56
 */

namespace keika299\ConohaAPI\Common\Exceptions;


class ConohaAPIException extends \Exception implements IConohaAPIException
{
    public function __construct($message, $code, \Exception $previous)
    {
        parent::__construct($message, $code, $previous);
    }
}
