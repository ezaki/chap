<?php

require dirname(__DIR__) . '/../vendor/autoload.php';

use keika299\ConohaAPI\Conoha;

$client = new Conoha(array(
    'username'=>'ConoHa',
    'password'=>'paSSword123456#$%',
    'tenantId'=>'487727e3921d44e3bfe7ebb337bf085e'
));

$mailService = $client->mailService();

echo json_encode($mailService->getEmailList(
    array(
        'domain_id' => 'b5bc0eba-a2d8-4b80-922c-25af72ac8c63'
    )
));
