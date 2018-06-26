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
     * @var array
     */
    protected $searchFields = [];

    /**
     * RequestFactory constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;

        $this->requestXML = new \SimpleXMLElement("<LinxMicrovix></LinxMicrovix>");
        $this->setAuthentication();
        $this->setPortal();
    }

    protected function setAuthentication()
    {
        $authenticationNode = $this->requestXML->addChild('Authentication');
        $authenticationNode->addAttribute('user', $this->configuration->getUser());
        $authenticationNode->addAttribute('password', $this->configuration->getPassword());
    }

    protected function setPortal()
    {
        $this->requestXML->addChild('IdPortal', $this->configuration->getIdPortal());
    }

    /**
     * @param \SimpleXMLElement $commandNode
     * @return \SimpleXMLElement
     */
    protected function addDefaultParametersCommand(\SimpleXMLElement $commandNode)
    {
        $parametersNode = $commandNode->addChild('Parameters');
        $this->addIdParameter($parametersNode);

        $cnpjEmpParameter = $parametersNode->addChild('Parameter', $this->configuration->getCnpj());
        $cnpjEmpParameter->addAttribute('id', 'cnpjEmp');

        return $parametersNode;
    }

    /**
     * @param \SimpleXMLElement $parametersNode
     * @return bool
     */
    protected function addIdParameter(\SimpleXMLElement $parametersNode)
    {
        $keyParameter = $parametersNode->addChild('Parameter', $this->configuration->getKeyPortal());
        $keyParameter->addAttribute('id', 'chave');

        return true;
    }

    /**
     * @param $command
     * @param array $arrayFilter
     * @return mixed
     */
    public function build($command, $arrayFilter = [])
    {
        $commandNode = $this->requestXML->addChild('Command');
        $commandNode->addChild('Name', $command);

        $parametersNode = $this->addDefaultParametersCommand($commandNode);
        $this->addCustomFilters($parametersNode, $arrayFilter);

        return $this->requestXML->asXML();
    }

    /**
     * @param \SimpleXMLElement $parametersNode
     * @param array $customFilters
     * @return bool
     */
    protected function addCustomFilters(\SimpleXMLElement $parametersNode, array $customFilters)
    {
        $filters = array_merge($this->searchFields, $customFilters);
        foreach ($filters as $key => $value) {
            if (!array_key_exists($key, $this->searchFields)) {
                continue;
            }

            $parameter = $parametersNode->addChild('Parameter', $value);
            $parameter->addAttribute('id', $key);
        }

        return true;
    }

}