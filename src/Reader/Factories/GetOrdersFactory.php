<?php

namespace Mobly\LinxMicrovix\Reader\Factories;

/**
 * Class GetOrdersFactory
 * @package Mobly\LinxMicrovix\Reader\Factories
 */
class GetOrdersFactory extends AbstractRequestFactory
{
    /**
     * @var array
     */
    protected $searchFields = [
        'cnpjEmp' => 'NULL',
        'data_alt_fim' => 'NULL',
        'data_alt_inicial' => 'NULL',
        'data_fim' => 'NULL',
        'data_inicial' => 'NULL',
        'hora_fim' => 'NULL',
        'hora_inicial' => 'NULL',
        'doc_cliente' => 'NULL',
    ];

    /**
     * @param $command
     * @param array $arrayFilter
     * @return mixed
     */
    public function build($command, $arrayFilter = [])
    {
        $commandNode = $this->requestXML->addChild('Command');
        $commandNode->addChild('Name', $command);

        $parametersNode = $commandNode->addChild('Parameters');
        $this->addIdParameter($parametersNode);
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