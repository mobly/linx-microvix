<?php

namespace Mobly\LinxMicrovix\Reader\Factories;

use Mobly\LinxMicrovix\Reader\Configuration;

/**
 * Class RequestFactory
 * @package Mobly\LinxMicrovix\Reader\Factories
 */
class RequestFactory
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
    protected function setParametersCommand(\SimpleXMLElement $commandNode)
    {
        $parametersNode = $commandNode->addChild('Parameters');
        $keyParameter = $parametersNode->addChild('Parameter', $this->configuration->getKeyPortal());
        $keyParameter->addAttribute('id', 'chave');

        $cnpjEmpParameter = $parametersNode->addChild('Parameter', $this->configuration->getCnpj());
        $cnpjEmpParameter->addAttribute('id', 'cnpjEmp');
    }

    /**
     * @param $command
     * @return mixed
     */
    public function build($command)
    {
        $commandNode = $this->requestXML->addChild('Command');
        $commandNode->addChild('Name', $command);

        $this->setParametersCommand($commandNode);

        return $this->requestXML->asXML();
    }


}