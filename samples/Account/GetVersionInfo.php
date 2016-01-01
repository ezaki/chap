<?php

require dirname(__DIR__) . '/../vendor/autoload.php';

use keika299\ConohaAPI\Conoha;

$client = new Conoha();

$accountService = $client->accountService();

echo json_encode($accountService->getVersionInfo());
