<?php

require dirname(__DIR__) . '/../vendor/autoload.php';

use keika299\ConohaAPI\Conoha;

$client = new Conoha(array(
    'username'=>'ConoHa',
    'password'=>'paSSword123456#$%',
    'tenantId'=>'487727e3921d44e3bfe7ebb337bf085e'
));

$dnsService = $client->dnsService();

echo json_encode($dnsService->getDomainRecords('Domain UUID'));
