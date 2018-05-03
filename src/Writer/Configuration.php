<?php

namespace Mobly\LinxMicrovix\Writer;

/**
 * Class Configuration
 * @package Mobly\LinxMicrovix\Writer
 */
class Configuration
{

    /**
     * @var string
     */
    protected $user;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var integer
     */
    protected $idPortal;

    /**
     * @var string
     */
    protected $keyPortal;

    /**
     * @var string
     */
    protected $wsdlUrl;

    /**
     * @var array
     */
    protected $required = [
        'idPortal',
        'keyPortal'
    ];

    /**
     * Configuration constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->validateRequired($options);
        $this->setData($options);
    }

    /**
     * @param array $options
     */
    protected function setData(array $options)
    {
        foreach ($options as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @param array|object $data
     *
     * @throws \Exception
     */
    protected function validateRequired($data)
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        foreach ($this->required as $attribute) {
            if (!isset($data[$attribute])) {
                throw new \Exception('Required param "' . $attribute . '" missing');
            }
        }
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return Configuration
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Configuration
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeyPortal()
    {
        return $this->keyPortal;
    }

    /**
     * @param string $keyPortal
     * @return Configuration
     */
    public function setKeyPortal($keyPortal)
    {
        $this->keyPortal = $keyPortal;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdPortal()
    {
        return $this->idPortal;
    }

    /**
     * @param int $idPortal
     * @return Configuration
     */
    public function setIdPortal($idPortal)
    {
        $this->idPortal = $idPortal;
        return $this;
    }

    /**
     * @return string
     */
    public function getWsdlUrl()
    {
        return $this->wsdlUrl;
    }

    /**
     * @param string $wsdlUrl
     * @return Configuration
     */
    public function setWsdlUrl($wsdlUrl)
    {
        $this->wsdlUrl = $wsdlUrl;
        return $this;
    }
}