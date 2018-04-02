<?php

require '../vendor/autoload.php';

$config = new \Mobly\LinxMicrovix\Reader\Configuration([
    'user' => 'linx_import',
    'password' => 'linx_import',
    'cnpj' => '25557193000107',
    'keyPortal' => 'CC59D806-A447-45EB-A1CD-E3B4CAE21BCF',
    'url' => 'http://webapi.microvix.com.br/1.0/api/integracao'
]);

$reader = new \Mobly\LinxMicrovix\Reader($config);

try {
    $response = $reader->get('LinxProdutos');
    print_r($response); die;
    echo 'OK' . PHP_EOL;

} catch (\SoapFault $s) {
    echo($s->getMessage());

} catch (\Exception $e) {
    echo($e->getMessage());
}