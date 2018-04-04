<?php

require '../vendor/autoload.php';

$config = new \Mobly\LinxMicrovix\Reader\Configuration([
    'user' => 'linx_export',
    'password' => 'linx_export',
    'cnpj' => '25557193000107',
    'keyPortal' => '51509428-ba56-4f83-aa65-0023aa4ac507',
    'url' => 'http://189.36.2.107:8728/1.0/api/integracao'
]);

$reader = new \Mobly\LinxMicrovix\Reader($config);

try {
    $response = $reader->get('LinxVendedores');
    print_r($response->getData());
    echo 'OK' . PHP_EOL;

} catch (\SoapFault $s) {
    echo($s->getMessage());

} catch (\Exception $e) {
    echo($e->getMessage());
}