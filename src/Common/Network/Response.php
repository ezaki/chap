<?php

namespace keika299\ConohaAPI\Common\Network;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Response
 *
 * This class is wrapper for \GuzzleHttp\Psr7\Response.
 *
 * @package keika299\ConohaAPI\Common\Network
 */
class Response
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * Response constructor
     *
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Get status code
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }

    /**
     * Get response body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->response->getBody();
    }

    /**
     * Get json object
     *
     * That object consists array.
     *
     * @return mixed
     */
    public function getJson()
    {
        return json_decode($this->response->getBody());
    }
}
