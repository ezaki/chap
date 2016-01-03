<?php

namespace keika299\ConohaAPI\Common\DataStore;


use keika299\ConohaAPI\Conoha;

/**
 * Class Token
 *
 * This class manage token.
 *
 * @package keika299\ConohaAPI\Common\DataStore
 */
class Token
{
    /**
     * @var Conoha
     */
    private $client;

    /**
     * Token constructor.
     * @param Conoha $client
     */
    public function __construct(Conoha $client)
    {
        $this->client = $client;
    }

    /**
     * @return  null
     * @throws \Exception
     */
    public function initToken()
    {
        $token = $this->getToken();

        if ($token === null) {
            $cookie = new Cookies($this->client);
            if ($cookie->loadToken() !== null){
                $token = $cookie->loadToken();
            }
            else {
                $token = $this->generateToken();
            }
        }

        $this->setToken($token);
    }

    /**
     * Refresh token.
     *
     * @return null
     * @throws \Exception
     */
    public function refreshToken()
    {
        $newToken = $this->generateToken();
        $this->setToken($newToken);
    }

    /**
     * Generate token.
     *
     * @return string
     * @throws \Exception
     */
    private function generateToken()
    {
        $username = $this->client->getUsername();
        $password = $this->client->getUserPassword();

        if ($username === null || $password === null) {
            throw new \Exception('Cannot refresh token.');
        }

        return $this->client->identityService()->getToken()->access->token->id;
    }

    /**
     * Get token.
     *
     * @return null|string
     */
    public function getToken()
    {
        return $this->client->getToken();
    }

    /**
     * Set token.
     *
     * @param string $token
     * @return null
     */
    public function setToken($token)
    {
        $cookie = new Cookies($this->client);
        $cookie->saveToken($token);
        $this->client->setToken($token);
    }
}
