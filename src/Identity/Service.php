<?php

namespace keika299\ConohaAPI\Identity;

use keika299\ConohaAPI\Common\Service\AbstractService;
use keika299\ConohaAPI\Common\Network\Request;

/**
 * Class Service
 *
 * This class connect to ConoHa identity service.
 *
 * @package keika299\ConohaAPI\Identity
 */
class Service extends AbstractService
{
    /**
     * Get version detail.
     *
     * See https://www.conoha.jp/docs/identity-get_version_detail.html
     *
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getVersionDetail()
    {
        $request = new Request();
        $request
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v2.0')
            ->setAccept('application/json');

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Request token.
     *
     * You don't have to run this function for use other service.
     * When create \keika299\ConohaAPI\Conoha object without token, try this and get token automatically.
     * See https://www.conoha.jp/docs/identity-post_tokens.html
     *
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getToken()
    {
        $request = new Request();
        $request
            ->setMethod('POST')
            ->setBaseURI($this->baseURI)
            ->setURI('/v2.0/tokens')
            ->setAccept('application/json')
            ->setJson($this->getTokenRequestArray());
        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * @return array
     */
    private function getTokenRequestArray()
    {
        $requestArray = array(
            'auth' => [
                'passwordCredentials' => [
                    'username' => $this->client->getUsername(),
                    'password' => $this->client->getUserPassword()
                ]
            ]
        );

        if ($this->client->getTenantID() !== null) {
            $requestArray["auth"]["tenantId"] = $this->client->getTenantID();
        }

        return $requestArray;
    }
}
