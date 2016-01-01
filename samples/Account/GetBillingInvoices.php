<?php

require __DIR__ . '/../../vendor/autoload.php';

use keika299\ConohaAPI\Conoha;

$client = new Conoha(array(
    'username'=>'ConoHa',
    'password'=>'paSSword123456#$%',
    'tenantId'=>'487727e3921d44e3bfe7ebb337bf085e'
));

$accountService = $client->accountService();

echo json_encode($accountService->getBillingInvoices(array(
    'offset' => 5,
    'limit' => 3
)));
