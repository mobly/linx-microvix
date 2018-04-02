<?php

namespace Mobly\LinxMicrovix;

use Mobly\LinxMicrovix\Writer\Configuration;
use Mobly\LinxMicrovix\Writer\Entities\Import;
use Mobly\LinxMicrovix\Writer\Factories\RequestFactory;
use Mobly\LinxMicrovix\Writer\Services\Importer;
use Mobly\LinxMicrovix\Writer\Services\ImporterResponse;

/**
 * Class Writer
 * @package Mobly\LinxMicrovix
 */
class Writer
{
    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var RequestFactory
     */
    protected $requestFactory;

    /**
     * @var Importer
     */
    protected $importer;

    /**
     * Writer constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        $this->requestFactory = new RequestFactory($configuration);
        $this->importer = new Importer($configuration->getWsdlPath());
    }

    /**
     * @param array $data
     * @return ImporterResponse
     */
    public function send(array $data)
    {
        $request = $this->requestFactory->build($this->getTable(), $data);
        $importRequest = new Import($request);

        return $this->importer->import($importRequest);
    }

    /**
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param Configuration $configuration
     * @return Writer
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
        return $this;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     * @return Writer
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }
}

/**
 *
$t = new \Importador();

$requestParameters = [];
$portal = new \CommandParameter();
$portal->Name = 'IdPortal';
$portal->Value = '964';

$key = new \CommandParameter();
$key->Name = 'chave';
$key->Value = 'CC59D806-A447-45EB-A1CD-E3B4CAE21BCF';

$cnpj = new \CommandParameter();
$cnpj->Name = 'cnpjEmp';
$cnpj->Value = '';

$requestParameters[] = $portal;
$requestParameters[] = $key;
$requestParameters[] = $cnpj;

$authenticate = new \UserAuthentication();
$authenticate->Pass = 'linx_import';
$authenticate->User = 'linx_import';

$tabela = new \Tabela();
$tabela->Comando = 'LinxCadastraSetores';

$valores = new \Registros();
$codigo = new \CommandParameter();
$codigo->Name = 'codigo';
$codigo->Value = '2';

$nomeSetor = new \CommandParameter();
$codigo->Name = 'nome_setor';
$codigo->Value = 'Rodrigo';
$valores->Colunas = $nomeSetor;
$tabela->Registros = $valores;

$r = new \Request();
$r->UserAuth = $authenticate;
$r->ParamsSeletorDestino = $requestParameters;
$r->Tabela = $tabela;
 */
