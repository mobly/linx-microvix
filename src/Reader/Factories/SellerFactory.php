<?php

namespace Mobly\LinxMicrovix\Reader\Factories;

/**
 * Class SellerFactory
 * @package Mobly\LinxMicrovix\Reader\Factories
 */
class SellerFactory extends AbstractRequestFactory
{
    /**
     * @var array
     */
    protected $searchFields = [
        'data_upd_fim' => 'NULL',
        'data_upd_inicial' => 'NULL',
        'cod_vendedor' => 'NULL',
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