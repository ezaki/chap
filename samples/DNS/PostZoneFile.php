<?php

require dirname(__DIR__) . '/../vendor/autoload.php';

use keika299\ConohaAPI\Conoha;

$client = new Conoha(array(
    'username'=>'ConoHa',
    'password'=>'paSSword123456#$%',
    'tenantId'=>'487727e3921d44e3bfe7ebb337bf085e'
));

$dnsService = $client->dnsService();

echo json_encode($dnsService->postZoneFile('$ORIGIN example.com.
$TTL 3600
example.com. IN SOA ns.example.com. postmaster.example.com. 1234567890 10800 1800 604800 86400
example.com. IN NS ns.example.com.
example.com. IN MX 10 mail.example.com.
ns.example.com. IN A 1.2.3.4
mail.example.com. IN A 1.2.3.4'));