<?php

namespace Mobly\LinxMicrovix\Reader\Factories;

use Mobly\LinxMicrovix\Reader\Configuration;

/**
 * Class AbstractRequestFactory
 * @package Mobly\LinxMicrovix\Reader\Factories
 */
abstract class AbstractRequestFactory
{
    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @var \SimpleXMLElement
     */
    protected $requestXML;

    /**
     * RequestFactory constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;

        $this->requestXML = new \SimpleXMLElement("<LinxMicrovix></LinxMicrovix>");
        $this->setAuthentication();
    }

    protected function setAuthentication()
    {
        $authenticationNode = $this->requestXML->addChild('Authentication');
        $authenticationNode->addAttribute('user', $this->configuration->getUser());
        $authenticationNode->addAttribute('password', $this->configuration->getPassword());
    }

    /**
     * @param \SimpleXMLElement $commandNode
     * @return \SimpleXMLElement
     */
    protected function addDefaultParametersCommand(\SimpleXMLElement $commandNode)
    {
        $parametersNode = $commandNode->addChild('Parameters');
        $keyParameter = $parametersNode->addChild('Parameter', $this->configuration->getKeyPortal());
        $keyParameter->addAttribute('id', 'chave');

        $cnpjEmpParameter = $parametersNode->addChild('Parameter', $this->configuration->getCnpj());
        $cnpjEmpParameter->addAttribute('id', 'cnpjEmp');

        return $parametersNode;
    }

    /**
     * @param $command
     * @param array $arrayFilter
     * @return mixed
     */
    abstract public function build($command, $arrayFilter = []);

    /**
     * @param \SimpleXMLElement $commandNode
     * @param array $customFilters
     * @return mixed
     */
    abstract protected function addCustomFilters(\SimpleXMLElement $commandNode, array $customFilters);

}