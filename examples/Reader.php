<?php

require '../vendor/autoload.php';

$config = new \Mobly\LinxMicrovix\Reader\Configuration([
    'user' => 'linx_export',
    'password' => 'linx_export',
    'cnpj' => '25557193000107',
    'keyPortal' => '51509428-ba56-4f83-aa65-0023aa4ac507',
    'url' => 'http://aceitacao.microvix.com.br:8728/1.0/api/integracao'
]);

$reader = new \Mobly\LinxMicrovix\Reader($config);

try {
    $responseOrders = $reader->get('LinxPedidosVenda', [
        'cnpjEmp' => '25557193000107',
        'data_fim' => '2018-05-30T11:40:30',
        'data_inicial' => '2018-05-17T11:22:30'
    ]);

    print_r($responseOrders->getData());

    $responseSellers = $reader->get('LinxVendedores');
    print_r($responseSellers->getData());


    $responseProducts = $reader->get('LinxProdutosDetalhes');
    print_r($responseProducts->getData());
    echo 'OK' . PHP_EOL;

} catch (\SoapFault $s) {
    echo($s->getMessage());

} catch (\Exception $e) {
    echo($e->getMessage());
}