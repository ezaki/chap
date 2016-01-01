<?php

namespace keika299\ConohaAPI\Common\Service;


use keika299\ConohaAPI\Common\Network\Request;
use keika299\ConohaAPI\Common\Network\Response;
use keika299\ConohaAPI\Conoha;

/**
 * Class AbstractService
 *
 * This class defines cloud service base.
 * This contain basic functions for services.
 *
 * @package keika299\ConohaAPI\Common\Service
 */

abstract class AbstractService
{
    protected $client;
    protected $baseURI;

    /**
     * AbstractService constructor.
     * @param \keika299\ConohaAPI\Conoha $client
     * @param string $baseURI
     */
    public function __construct(Conoha $client, $baseURI)
    {
        $this->client = $client;
        $this->baseURI = $baseURI;
    }

    /**
     * Refresh token and retry request.
     *
     * @param Request $request
     * @return Response
     */
    public function requestWithUpdatedToken(Request $request)
    {
        $this->client->updateToken();
        $request->setToken($this->client->getToken());
        return $request->exec();
    }
}
