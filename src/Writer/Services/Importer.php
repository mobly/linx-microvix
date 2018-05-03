<?php

namespace Mobly\LinxMicrovix\Writer\Services;

use Mobly\LinxMicrovix\Writer\Entities\Import;

/**
 * Class Importer
 * @package Mobly\LinxMicrovix\Writer\Entities
 */
class Importer extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     * @access private
     */
    private static $classmap = array(
        'Importar' => '\Import',
        'ImportarResponse' => '\Mobly\LinxMicrovix\Writer\Entities\ImportResponse',
        'Request' => '\Request',
        'Registros' => '\Registros',
        'CommandParameter' => '\CommandParameter',
        'Tabela' => '\Table',
        'UserAuthentication' => '\UserAuthentication',
        'RetornoImportacao' => '\Mobly\LinxMicrovix\Writer\Services\ImporterResponse'
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     * @access public
     */
    public function __construct($wsdl, array $options = array())
    {
        foreach (self::$classmap as $key => $value) {
            if (!isset($options['classmap'][$key])) {
              $options['classmap'][$key] = $value;
            }
        }

        parent::__construct($wsdl, $options);
    }

    /**
     * @param Import $parameters
     * @return mixed
     */
    public function import(Import $parameters)
    {
        return $this->__soapCall('Importar', array($parameters));
    }
}
