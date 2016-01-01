<?php

namespace keika299\ConohaAPI\Common;


use keika299\ConohaAPI\Conoha;

/**
 * Class Cookies
 *
 * This class manage cookies.
 *
 * @package keika299\ConohaAPI\Common
 */
class Cookies
{
    /**
     * @var Conoha
     */
    private $client;
    private $cookiesData;

    /**
     * Cookies constructor.
     *
     * @param Conoha $client
     */
    public function __construct(Conoha $client)
    {
        $this->client = $client;
        $this->cookiesData = $client->getCookiesData();
    }

    /**
     * Set generated token.
     */
    public function setCurrentToken()
    {
        if ($this->isStoreTokenCookie()) {
            setcookie($this->getStoreTokenCookieName(), $this->client->getToken());
        }
    }

    /**
     * Get stored token.
     *
     * If not set token cookie, this function will return null.
     *
     * @return string|null
     */
    public function getStoredToken()
    {
        return filter_input(INPUT_COOKIE, $this->getStoreTokenCookieName()) !== null ? filter_input(INPUT_COOKIE, $this->getStoreTokenCookieName()) : null;
    }

    /**
     * Get allow store token cookie.
     *
     * @return bool
     */
    public function isStoreTokenCookie()
    {
        return (isset($this->cookiesData['isStoreTokenCookie']) && $this->cookiesData['isStoreTokenCookie']);
    }

    /**
     * Get store token cookie name.
     *
     * Default value is 'ConohaAPIToken'.
     *
     * @return string
     */
    public function getStoreTokenCookieName()
    {
        return isset($this->cookiesData['storeTokenCookieName']) ? $this->cookiesData['storeTokenCookieName'] : 'ConohaAPIToken';
    }
}
