<?php

require '../vendor/autoload.php';

$config = new \Mobly\LinxMicrovix\Writer\Configuration([
    'user' => 'linx_import',
    'password' => 'linx_import',
    'idPortal' => 964,
    'keyPortal' => 'CC59D806-A447-45EB-A1CD-E3B4CAE21BCF',
    'wsdlUrl' => 'http://aceitacao.microvix.com.br:8728/1.0/Importador.svc?wsdl'
]);

$writer = new \Mobly\LinxMicrovix\Writer($config);
$writer->setTable('LinxCadastraSetores');

$registros =[
    [
        'nome_setor' => 'legal',
        'codigo' => 10
    ],
    [
        'nome_setor' => 'Outro setor',
        'codigo' => 11
    ]
];


try {
    $t = $writer->send($registros);
    print_r($t);
    echo 'OK' . PHP_EOL;

} catch (\SoapFault $s) {
    echo($s->getMessage());

} catch (\Exception $e) {
    echo($e->getMessage());
}