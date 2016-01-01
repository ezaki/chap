<?php

require dirname(__DIR__) . '/../vendor/autoload.php';

use keika299\ConohaAPI\Conoha;

$client = new Conoha();

$identityService = $client->identityService();

echo json_encode($identityService->getVersionInfo());
