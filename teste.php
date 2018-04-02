<?php

require 'vendor/autoload.php';


$config = new \Mobly\LinxMicrovix\Writer\Configuration([
    'user' => 'linx_import',
    'password' => 'linx_import',
    'idPortal' => 964,
    'keyPortal' => 'CC59D806-A447-45EB-A1CD-E3B4CAE21BCF'
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



//
//
//);
//
//$t = new \Importador();
//
//$requestParameters = [];
//$portal = new \CommandParameter();
//$portal->Name = 'IdPortal';
//$portal->Value = '964';
//
//$key = new \CommandParameter();
//$key->Name = 'chave';
//$key->Value = 'CC59D806-A447-45EB-A1CD-E3B4CAE21BCF';
//
//$cnpj = new \CommandParameter();
//$cnpj->Name = 'cnpjEmp';
//$cnpj->Value = '';
//
//$requestParameters[] = $portal;
//$requestParameters[] = $key;
//$requestParameters[] = $cnpj;
//
//$authenticate = new \UserAuthentication();
//$authenticate->Pass = 'linx_import';
//$authenticate->User = 'linx_import';
//
//$tabela = new \Tabela();
//$tabela->Comando = 'LinxCadastraSetores';
//
//$valores = new \Registros();
//$codigo = new \CommandParameter();
//$codigo->Name = 'codigo';
//$codigo->Value = '2';
//
//$nomeSetor = new \CommandParameter();
//$codigo->Name = 'nome_setor';
//$codigo->Value = 'Rodrigo';
//$valores->Colunas = $nomeSetor;
//$tabela->Registros = $valores;
//
//$r = new \Request();
//$r->UserAuth = $authenticate;
//$r->ParamsSeletorDestino = $requestParameters;
//$r->Tabela = $tabela;
//
//try {
//    $importar = new \Importar($r);
//    $t->Importar($importar);
//    echo 'OK' . PHP_EOL;
//
//} catch (\SoapFault $s) {
//    echo($s->getMessage());
//
//} catch (\Exception $e) {
//    echo($e->getMessage());
//}
//
//echo 'fim';
//
//
//class teste {
//    public function __construct()
//    {
//
//    }
//}