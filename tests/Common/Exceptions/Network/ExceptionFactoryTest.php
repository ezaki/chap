<?php

namespace keika299\ConohaAPI\Tests\Common\Exceptions\Network;


use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;
use keika299\ConohaAPI\Common\Exceptions\Network\ExceptionFactory;

class ExceptionFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $request = new Request('GET','/');
        $this->assertInstanceOf(
            '\keika299\ConohaAPI\Common\Exceptions\Network\Client\BadRequestException',
            ExceptionFactory::build(RequestException::create($request, new Response('400'))));

        $this->assertInstanceOf(
            '\keika299\ConohaAPI\Common\Exceptions\Network\Client\UnauthorizedException',
            ExceptionFactory::build(RequestException::create($request, new Response('401'))));

        $this->assertInstanceOf(
            '\keika299\ConohaAPI\Common\Exceptions\Network\Client\ForbiddenException',
            ExceptionFactory::build(RequestException::create($request, new Response('403'))));

        $this->assertInstanceOf(
            '\keika299\ConohaAPI\Common\Exceptions\Network\Client\NotFoundException',
            ExceptionFactory::build(RequestException::create($request, new Response('404'))));

        $this->assertInstanceOf(
            '\keika299\ConohaAPI\Common\Exceptions\Network\Client\MethodNotAllowedException',
            ExceptionFactory::build(RequestException::create($request, new Response('405'))));

        $this->assertInstanceOf(
            '\keika299\ConohaAPI\Common\Exceptions\Network\Client\NotAcceptableException',
            ExceptionFactory::build(RequestException::create($request, new Response('406'))));

        $this->assertInstanceOf(
            '\keika299\ConohaAPI\Common\Exceptions\Network\RequestException',
            ExceptionFactory::build(RequestException::create($request, new Response('499'))));
    }
}
